<?php
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2023 Yurii Kuznietsov, Taras Machyshyn, Oleksii Avramenko
 * Website: https://www.espocrm.com
 *
 * EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

namespace Espo\Tools\App;

use Espo\Core\Authentication\Util\MethodProvider as AuthenticationMethodProvider;
use Espo\Core\Utils\SystemUser;
use Espo\Entities\DashboardTemplate;
use Espo\Entities\EmailAccount as EmailAccountEntity;
use Espo\Entities\InboundEmail as InboundEmailEntity;
use Espo\Entities\Settings;
use Espo\Tools\App\SettingsService as SettingsService;

use Espo\Core\Acl;
use Espo\Core\Authentication\Logins\Espo;
use Espo\Core\InjectableFactory;
use Espo\Core\Utils\Config;
use Espo\Core\Utils\FieldUtil;
use Espo\Core\Utils\Language;
use Espo\Core\Utils\Log;
use Espo\Core\Utils\Metadata;

use Espo\Entities\User;
use Espo\Entities\Preferences;

use Espo\ORM\Collection;
use Espo\ORM\EntityManager;

use stdClass;
use Throwable;

class AppService
{
    public function __construct(
        private Config $config,
        private EntityManager $entityManager,
        private Metadata $metadata,
        private Acl $acl,
        private InjectableFactory $injectableFactory,
        private SettingsService $settingsService,
        private User $user,
        private Preferences $preferences,
        private FieldUtil $fieldUtil,
        private Log $log,
        private AuthenticationMethodProvider $authenticationMethodProvider,
        private SystemUser $systemUser
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function getUserData(): array
    {
        $preferencesData = $this->preferences->getValueMap();

        $this->filterPreferencesData($preferencesData);

        $user = $this->user;

        if (!$user->has('teamsIds')) {
            $user->loadLinkMultipleField('teams');
        }

        if ($user->isPortal()) {
            $user->loadAccountField();
            $user->loadLinkMultipleField('accounts');
        }

        $settings = $this->settingsService->getConfigData();

        $dashboardTemplateId = $user->get('dashboardTemplateId');

        if ($dashboardTemplateId) {
            $dashboardTemplate = $this->entityManager
                ->getEntityById(DashboardTemplate::ENTITY_TYPE, $dashboardTemplateId);

            if ($dashboardTemplate) {
                $settings->forcedDashletsOptions = $dashboardTemplate->get('dashletsOptions') ?? (object) [];
                $settings->forcedDashboardLayout = $dashboardTemplate->get('layout') ?? [];
            }
        }

        $language = Language::detectLanguage($this->config, $this->preferences);

        return [
            'user' => $this->getUserDataForFrontend(),
            'acl' => $this->getAclDataForFrontend(),
            'preferences' => $preferencesData,
            'token' => $this->user->get('token'),
            'settings' => $settings,
            'language' => $language,
            'appParams' => $this->getAppParams(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function getAppParams(): array
    {
        $user = $this->user;

        $auth2FARequired =
            $user->isRegular() &&
            $this->config->get('auth2FA') &&
            $this->config->get('auth2FAForced') &&
            !$user->get('auth2FA');

        $authenticationMethod = $this->authenticationMethodProvider->get();

        $passwordChangeForNonAdminDisabled = $authenticationMethod !== Espo::NAME;
        $logoutWait = (bool) $this->metadata->get(['authenticationMethods', $authenticationMethod, 'logoutClassName']);

        $timeZoneList = $this->metadata
            ->get(['entityDefs', Settings::ENTITY_TYPE, 'fields', 'timeZone', 'options']) ?? [];

        $appParams = [
            'maxUploadSize' => $this->getMaxUploadSize() / 1024.0 / 1024.0,
            'isRestrictedMode' => $this->config->get('restrictedMode'),
            'passwordChangeForNonAdminDisabled' => $passwordChangeForNonAdminDisabled,
            'timeZoneList' => $timeZoneList,
            'auth2FARequired' => $auth2FARequired,
            'logoutWait' => $logoutWait,
            'systemUserId' => $this->systemUser->getId(),
        ];

        /** @var array<string, array<string, mixed>> $map */
        $map = $this->metadata->get(['app', 'appParams']) ?? [];

        foreach ($map as $paramKey => $item) {
            /** @var ?class-string<AppParam> $className */
            $className = $item['className'] ?? null;

            if (!$className) {
                continue;
            }

            try {
                /** @var AppParam $obj */
                $obj = $this->injectableFactory->create($className);

                $itemParams = $obj->get();
            }
            catch (Throwable $e) {
                $this->log->error("AppParam {$paramKey}: " . $e->getMessage());

                continue;
            }

            $appParams[$paramKey] = $itemParams;
        }

        return $appParams;
    }

    private function getUserDataForFrontend(): stdClass
    {
        $user = $this->user;

        $emailAddressData = $this->getEmailAddressData();

        $data = $user->getValueMap();

        $data->emailAddressList = $emailAddressData['emailAddressList'];
        $data->userEmailAddressList = $emailAddressData['userEmailAddressList'];

        unset($data->authTokenId);
        unset($data->password);

        $forbiddenAttributeList = $this->acl->getScopeForbiddenAttributeList('User');

        $isPortal = $user->isPortal();

        foreach ($forbiddenAttributeList as $attribute) {
            if ($attribute === 'type') {
                continue;
            }

            if ($isPortal) {
                if (in_array($attribute, ['contactId', 'contactName', 'accountId', 'accountsIds'])) {
                    continue;
                }
            }
            else {
                if (in_array($attribute, ['teamsIds', 'defaultTeamId', 'defaultTeamName'])) {
                    continue;
                }
            }

            unset($data->$attribute);
        }

        return $data;
    }

    private function getAclDataForFrontend(): stdClass
    {
        $data = $this->acl->getMapData();

        if (!$this->user->isAdmin()) {
            $data = unserialize(serialize($data));

            /** @var string[] $scopeList */
            $scopeList = array_keys($this->metadata->get(['scopes'], []));

            foreach ($scopeList as $scope) {
                if (!$this->acl->check($scope)) {
                    unset($data->table->$scope);
                    unset($data->fieldTable->$scope);
                    unset($data->fieldTableQuickAccess->$scope);
                }
            }
        }

        return $data;
    }

    /**
     * @return array{
     *     emailAddressList: string[],
     *     userEmailAddressList: string[],
     * }
     */
    private function getEmailAddressData(): array
    {
        $user = $this->user;

        $outboundEmailIsShared = $this->config->get('outboundEmailIsShared');
        $outboundEmailFromAddress = $this->config->get('outboundEmailFromAddress');

        $emailAddressList = [];
        $userEmailAddressList = [];

        /** @var Collection<\Espo\Entities\EmailAddress> $emailAddressCollection */
        $emailAddressCollection = $this->entityManager
            ->getRDBRepositoryByClass(User::class)
            ->getRelation($user, 'emailAddresses')
            ->find();

        foreach ($emailAddressCollection as $emailAddress) {
            if ($emailAddress->isInvalid()) {
                continue;
            }

            $userEmailAddressList[] = $emailAddress->getAddress();

            if ($user->getEmailAddress() === $emailAddress->getAddress()) {
                continue;
            }

            $emailAddressList[] = $emailAddress->getAddress();
        }

        if ($user->getEmailAddress()) {
            array_unshift($emailAddressList, $user->getEmailAddress());
        }

        if (!$outboundEmailIsShared) {
            $emailAddressList = $this->filterUserEmailAddressList($user, $emailAddressList);
        }

        $emailAddressList = array_merge(
            $emailAddressList,
            $this->getUserGroupEmailAddressList($user)
        );

        if ($outboundEmailIsShared && $outboundEmailFromAddress) {
            $emailAddressList[] = $outboundEmailFromAddress;
        }

        $emailAddressList = array_values(array_unique($emailAddressList));

        return [
            'emailAddressList' => $emailAddressList,
            'userEmailAddressList' => $userEmailAddressList,
        ];
    }

    /**
     * @param string[] $emailAddressList
     * @return string[]
     */
    private function filterUserEmailAddressList(User $user, array $emailAddressList): array
    {
        $emailAccountCollection = $this->entityManager
            ->getRDBRepositoryByClass(EmailAccountEntity::class)
            ->select(['id', 'emailAddress'])
            ->where([
                'assignedUserId' => $user->getId(),
                'useSmtp' => true,
                'status' => EmailAccountEntity::STATUS_ACTIVE,
            ])
            ->find();

        $inAccountList = array_map(
            fn (EmailAccountEntity $e) => $e->getEmailAddress(),
            [...$emailAccountCollection]
        );

        return array_values(array_filter(
            $emailAddressList,
            fn (string $item) => in_array($item, $inAccountList)
        ));
    }

    /**
     * @return string[]
     */
    private function getUserGroupEmailAddressList(User $user): array
    {
        $groupEmailAccountPermission = $this->acl->getPermissionLevel('groupEmailAccountPermission');

        if (!$groupEmailAccountPermission || $groupEmailAccountPermission === Acl\Table::LEVEL_NO) {
            return [];
        }

        if ($groupEmailAccountPermission === Acl\Table::LEVEL_TEAM) {
            $teamIdList = $user->getLinkMultipleIdList('teams');

            if (!count($teamIdList)) {
                return [];
            }

            $inboundEmailList = $this->entityManager
                ->getRDBRepositoryByClass(InboundEmailEntity::class)
                ->where([
                    'status' => InboundEmailEntity::STATUS_ACTIVE,
                    'useSmtp' => true,
                    'smtpIsShared' => true,
                    'teamsMiddle.teamId' => $teamIdList,
                ])
                ->join('teams')
                ->distinct()
                ->find();

            $list = [];

            foreach ($inboundEmailList as $inboundEmail) {
                if (!$inboundEmail->getEmailAddress()) {
                    continue;
                }

                $list[] = $inboundEmail->getEmailAddress();
            }

            return $list;
        }

        if ($groupEmailAccountPermission === Acl\Table::LEVEL_ALL) {
            $inboundEmailList = $this->entityManager
                ->getRDBRepositoryByClass(InboundEmailEntity::class)
                ->where([
                    'status' => InboundEmailEntity::STATUS_ACTIVE,
                    'useSmtp' => true,
                    'smtpIsShared' => true,
                ])
                ->find();

            $list = [];

            foreach ($inboundEmailList as $inboundEmail) {
                if (!$inboundEmail->getEmailAddress()) {
                    continue;
                }

                $list[] = $inboundEmail->getEmailAddress();
            }

            return $list;
        }

        return [];
    }

    /**
     * @return int
     */
    private function getMaxUploadSize()
    {
        $maxSize = 0;

        $postMaxSize = $this->convertPHPSizeToBytes(ini_get('post_max_size'));

        if ($postMaxSize > 0) {
            $maxSize = $postMaxSize;
        }

        return $maxSize;
    }

    /**
     * @param string|false $size
     * @return int
     */
    private function convertPHPSizeToBytes($size)
    {
        if (is_numeric($size)) {
            return (int) $size;
        }

        if ($size === false) {
            return 0;
        }

        $suffix = substr($size, -1);
        $value = (int) substr($size, 0, -1);

        switch (strtoupper($suffix)) {
            case 'P':
                $value *= 1024;
            case 'T':
                $value *= 1024;
            case 'G':
                $value *= 1024;
            case 'M':
                $value *= 1024;
            case 'K':
                $value *= 1024;

                break;
        }

        return $value;
    }

    private function filterPreferencesData(stdClass $data): void
    {
        $passwordFieldList = $this->fieldUtil->getFieldByTypeList(Preferences::ENTITY_TYPE, 'password');

        foreach ($passwordFieldList as $field) {
            unset($data->$field);
        }
    }
}

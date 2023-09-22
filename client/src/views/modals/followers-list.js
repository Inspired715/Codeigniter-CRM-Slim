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

import RelatedListModalView from 'views/modals/related-list';

class FollowersListModalView extends RelatedListModalView {

    massActionRemoveDisabled = true
    massActionMassUpdateDisabled = true
    mandatorySelectAttributeList = ['type']

    setup() {
        if (
            !this.getUser().isAdmin() &&
            this.getAcl().getPermissionLevel('followerManagementPermission') === 'no' &&
            this.getAcl().getPermissionLevel('portalPermission') === 'no'
        ) {
            this.unlinkDisabled = true;
        }

        super.setup();
    }

    actionSelectRelated() {
        let p = this.getParentView();

        let view = null;

        while (p) {
            // noinspection JSUnresolvedReference
            if (p.actionSelectRelated) {
                view = p;

                break;
            }

            p = p.getParentView();
        }

        let filter = 'active';

        if (
            !this.getUser().isAdmin() &&
            this.getAcl().getPermissionLevel('followerManagementPermission') === 'no' &&
            this.getAcl().getPermissionLevel('portalPermission') === 'yes'
        ) {
            filter = 'activePortal';
        }

        // noinspection JSUnresolvedReference
        p.actionSelectRelated({
            link: this.link,
            primaryFilterName: filter,
            massSelect: false,
            foreignEntityType: 'User',
            viewKey: 'selectFollowers',
        });
    }
}

export default FollowersListModalView;

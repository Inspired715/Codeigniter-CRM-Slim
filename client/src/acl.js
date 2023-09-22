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

/** @module acl */

import {View as BullView} from 'bullbone';

/**
 * Internal class for access checking. Can be extended to customize access checking
 * for a specific scope.
 */
class Acl {

    /**
     * @param {module:models/user} user A user.
     * @param {string} scope A scope.
     * @param {Object} params Parameters.
     */
    constructor(user, scope, params) {
        /**
         * A user.
         *
         * @type {module:models/user|null}
         * @protected
         */
        this.user = user || null;
        this.scope = scope;

        params = params || {};

        this.aclAllowDeleteCreated = params.aclAllowDeleteCreated;
        this.teamsFieldIsForbidden = params.teamsFieldIsForbidden;
        this.forbiddenFieldList = params.forbiddenFieldList;
    }

    /**
     * Get a user.
     *
     * @returns {module:models/user}
     * @protected
     */
    getUser() {
        return this.user;
    }

    /**
     * Check access to a scope.
     *
     * @param {string|boolean|Object.<string, string>} data Access data.
     * @param {module:acl-manager~action|null} [action=null] An action.
     * @param {boolean} [precise=false] To return `null` if `inTeam == null`.
     * @param {Object|null} [entityAccessData=null] Entity access data. `inTeam`, `isOwner`.
     * @returns {boolean|null} True if access allowed.
     */
    checkScope(data, action, precise, entityAccessData) {
        entityAccessData = entityAccessData || {};

        let inTeam = entityAccessData.inTeam;
        let isOwner = entityAccessData.isOwner;

        if (this.getUser().isAdmin()) {
            if (data === false) {
                return false;
            }

            return true;
        }

        if (data === false) {
            return false;
        }

        if (data === true) {
            return true;
        }

        if (typeof data === 'string') {
            return true;
        }

        if (data === null) {
            return false;
        }

        action = action || null;

        if (action === null) {
            return true;
        }
        if (!(action in data)) {
            return false;
        }

        var value = data[action];

        if (value === 'all') {
            return true;
        }

        if (value === 'yes') {
            return true;
        }

        if (value === 'no') {
            return false;
        }

        if (typeof isOwner === 'undefined') {
            return true;
        }

        if (isOwner) {
            if (value === 'own' || value === 'team') {
                return true;
            }
        }

        let result = false;

        if (value === 'team') {
            result = inTeam;

            if (inTeam === null) {
                if (precise) {
                    result = null;
                }
                else {
                    return true;
                }
            }
            else if (inTeam) {
                return true;
            }
        }

        if (isOwner === null) {
            if (precise) {
                result = null;
            }
            else {
                return true;
            }
        }

        return result;
    }

    /**
     * Check access to model (entity).
     *
     * @param {module:model} model A model.
     * @param {Object.<string, string>|string|null} data Access data.
     * @param {module:acl-manager~action|null} [action=null] Action to check.
     * @param {boolean} [precise=false] To return `null` if not enough data is set in a model.
     *   E.g. the `teams` field is not yet loaded.
     * @returns {boolean|null} True if access allowed, null if not enough data to determine.
     */
    checkModel(model, data, action, precise) {
        if (this.getUser().isAdmin()) {
            return true;
        }

        let entityAccessData = {
            isOwner: this.checkIsOwner(model),
            inTeam: this.checkInTeam(model),
        };

        return this.checkScope(data, action, precise, entityAccessData);
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * Check `delete` access to model.
     *
     * @param {module:model} model A model.
     * @param {Object.<string, string>|string|null} data Access data.
     * @param {boolean} [precise=false] To return `null` if not enough data is set in a model.
     *   E.g. the `teams` field is not yet loaded.
     * @returns {boolean} True if access allowed.
     */
    checkModelDelete(model, data, precise) {
        let result = this.checkModel(model, data, 'delete', precise);

        if (result) {
            return true;
        }

        if (data === false) {
            return false;
        }

        let d = data || {};

        if (d.read === 'no') {
            return false;
        }

        if (model.has('createdById')) {
            if (model.get('createdById') === this.getUser().id && this.aclAllowDeleteCreated) {
                if (!model.has('assignedUserId')) {
                    return true;
                }

                if (!model.get('assignedUserId')) {
                    return true;
                }

                if (model.get('assignedUserId') === this.getUser().id) {
                    return true;
                }

            }
        }

        return result;
    }

    /**
     * Check if a user is owner to a model.
     *
     * @param {module:model} model A model.
     * @returns {boolean|null} True if owner. Null if not clear.
     */
    checkIsOwner(model) {
        let result = false;

        if (model.hasField('assignedUser')) {
            if (this.getUser().id === model.get('assignedUserId')) {
                return true;
            }

            if (!model.has('assignedUserId')) {
                result = null;
            }
        }
        else {
            if (model.hasField('createdBy')) {
                if (this.getUser().id === model.get('createdById')) {
                    return true;
                }

                if (!model.has('createdById')) {
                    result = null;
                }
            }
        }

        if (model.hasField('assignedUsers')) {
            if (!model.has('assignedUsersIds')) {
                return null;
            }

            if (~(model.get('assignedUsersIds') || []).indexOf(this.getUser().id)) {
                return true;
            }

            result = false;
        }

        return result;
    }

    /**
     * Check if a user in a team of a model.
     *
     * @param {module:model} model A model.
     * @returns {boolean|null} True if in a team. Null if not enough data to determine.
     */
    checkInTeam(model) {
        var userTeamIdList = this.getUser().getTeamIdList();

        if (!model.has('teamsIds')) {
            if (this.teamsFieldIsForbidden) {
                return true;
            }

            return null;
        }

        let teamIdList = model.getTeamIdList();

        let inTeam = false;

        userTeamIdList.forEach(id => {
            if (~teamIdList.indexOf(id)) {
                inTeam = true;
            }
        });

        return inTeam;
    }
}

Acl.extend = BullView.extend;

export default Acl;

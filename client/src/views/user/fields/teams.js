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

define('views/user/fields/teams', ['views/fields/link-multiple-with-role'], function (Dep) {

    return Dep.extend({

        forceRoles: true,

        setup: function () {
            Dep.prototype.setup.call(this);

            this.roleListMap = {};

            this.loadRoleList(() => {
                if (this.isEditMode()) {
                    if (this.isRendered() || this.isBeingRendered()) {
                        this.reRender();
                    }
                }
            });

            this.listenTo(this.model, 'change:teamsIds', () => {
                let toLoad = false;

                this.ids.forEach(id => {
                    if (!(id in this.roleListMap)) {
                        toLoad = true;
                    }
                });

                if (toLoad) {
                    this.loadRoleList(() => {
                        this.reRender();
                    });
                }
            });
        },

        loadRoleList: function (callback, context) {
            if (!this.getAcl().checkScope('Team', 'read')) {
                return;
            }

            let ids = this.ids || [];

            if (ids.length === 0) {
                return;
            }

            this.getCollectionFactory().create('Team', teams => {
                teams.maxSize = 50;
                teams.where = [
                    {
                        type: 'in',
                        field: 'id',
                        value: ids,
                    }
                ];

                this.listenToOnce(teams, 'sync', () => {
                    teams.models.forEach(model => {
                        this.roleListMap[model.id] = model.get('positionList') || [];
                    });

                    callback.call(context);
                });

                teams.fetch();
            });
        },

        getDetailLinkHtml: function (id, name) {
            name = name || this.nameHash[id];

            let role = (this.columns[id] || {})[this.columnName] || '';

            let $el = $('<div>')
                .append(
                    $('<a>')
                        .attr('href', '#' + this.foreignScope + '/view/' + id)
                        .attr('data-id', id)
                        .text(name)
                );

            if (role) {
                role = this.getHelper().escapeString(role);

                $el.append(
                    $('<span>').text(' '),
                    $('<span>').addClass('text-muted chevron-right'),
                    $('<span>').text(' '),
                    $('<span>').addClass('text-muted').text(role)
                )
            }

            return $el.get(0).outerHTML;
        },

        getJQSelect: function (id, roleValue) {
            /** @var {string[]} */
            let roleList = Espo.Utils.clone(this.roleListMap[id] || []);

            if (!roleList.length && !roleValue) {
                return null;
            }

            roleList.unshift('');

            if (roleValue && roleList.indexOf(roleValue) === -1) {
                roleList.push(roleValue);
            }

            let $role = $('<select>')
                .addClass('role form-control input-sm pull-right')
                .attr('data-id', id);

            roleList.forEach(role => {
                let $option = $('<option>')
                    .val(role)
                    .text(role);

                if (role === (roleValue || '')) {
                    $option.attr('selected', 'selected');
                }

                $role.append($option);
            });

            return $role;
        },
    });
});

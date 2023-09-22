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

define('views/email-folder/modals/select-folder', ['views/modal'], function (Dep) {

    return Dep.extend({

        cssName: 'select-folder',

        template: 'email-folder/modals/select-folder',

        fitHeight: true,

        backdrop: true,

        data: function () {
            return {
                folderDataList: this.folderDataList,
            };
        },

        events: {
            'click a[data-action="selectFolder"]': function (e) {
                let $target = $(e.currentTarget);

                let id = $target.attr('data-id');
                let name = $target.attr('data-name');

                this.trigger('select', id, name);
                this.close();
            },
        },

        setup: function () {
            this.headerText = this.options.headerText || '';

            if (this.headerText === '') {
                this.buttonList.push({
                    name: 'cancel',
                    label: 'Cancel',
                });
            }

            Espo.Ui.notify(' ... ');

            this.wait(
                Espo.Ajax.getRequest('EmailFolder/action/listAll')
                    .then(data => {
                        Espo.Ui.notify(false);

                        this.folderDataList = data.list
                            .filter(item => {
                                return ['inbox', 'important', 'sent', 'drafts', 'trash'].indexOf(item.id) === -1;
                            })
                            .map(item => {
                                return {
                                    id: item.id,
                                    name: item.name,
                                    isGroup: item.id.indexOf('group:') === 0,
                                };
                            });

                        this.folderDataList.unshift({
                            id: 'inbox',
                            name: this.translate('inbox', 'presetFilters', 'Email'),
                        })
                    })
            );
        },
    });
});

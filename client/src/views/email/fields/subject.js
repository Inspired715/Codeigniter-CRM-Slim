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

define('views/email/fields/subject', ['views/fields/varchar'], function (Dep) {

    return Dep.extend({

        listLinkTemplate: 'email/fields/subject/list-link',

        data: function () {
            let data = Dep.prototype.data.call(this);

            data.isRead = (this.model.get('sentById') === this.getUser().id) || this.model.get('isRead');
            data.isImportant = this.model.has('isImportant') && this.model.get('isImportant');
            data.hasAttachment = this.model.has('hasAttachment') && this.model.get('hasAttachment');
            data.isReplied = this.model.has('isReplied') && this.model.get('isReplied');
            data.inTrash = this.model.has('inTrash') && this.model.get('inTrash');

            if (!data.isRead && !this.model.has('isRead')) {
                data.isRead = true;
            }

            if (!data.isNotEmpty) {
                if (
                    this.model.get('name') !== null &&
                    this.model.get('name') !== '' &&
                    this.model.has('name')
                ) {
                    data.isNotEmpty = true;
                }
            }

            return data;
        },

        getValueForDisplay: function () {
            return this.model.get('name');
        },

        getAttributeList: function () {
            return ['name', 'subject', 'isRead', 'isImportant', 'hasAttachment', 'inTrash'];
        },

        setup: function () {
            Dep.prototype.setup.call(this);

            this.events['click [data-action="showAttachments"]'] = e => {
                e.stopPropagation();

                this.showAttachments();
            }

            this.listenTo(this.model, 'change', () => {
                if (this.mode === 'list' || this.mode === 'listLink') {
                    if (this.model.hasChanged('isRead') || this.model.hasChanged('isImportant')) {
                        this.reRender();
                    }
                }
            });
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);
        },

        fetch: function () {
            var data = Dep.prototype.fetch.call(this);
            data.name = data.subject;
            return data;
        },

        showAttachments: function () {
            Espo.Ui.notify(' ... ');

            this.createView('dialog', 'views/email/modals/attachments', {model: this.model})
                .then(view => {
                    view.render();

                    Espo.Ui.notify(false);
                });
        },
    });
});

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

define('views/wysiwyg/modals/insert-link', ['views/modal'], function (Dep) {

    return Dep.extend({

        className: 'dialog dialog-record',

        template: 'wysiwyg/modals/insert-link',

        events: {
            'input [data-name="url"]': function () {
                this.controlInputs();
            },
            'paste [data-name="url"]': function () {
                this.controlInputs();
            },
        },

        shortcutKeys: {
            'Control+Enter': function () {
                if (this.hasAvailableActionItem('insert')) {
                    this.actionInsert();
                }
            },
        },

        data: function () {
            return {
                labels: this.options.labels || {},
            };
        },

        setup: function () {
            let labels = this.options.labels || {};

            this.headerText = labels.insert;

            this.buttonList = [
                {
                    name: 'insert',
                    text: this.translate('Insert'),
                    style: 'primary',
                    disabled: true,
                }
            ];

            this.linkInfo = this.options.linkInfo || {};

            if (this.linkInfo.url) {
                this.enableButton('insert');
            }
        },

        afterRender: function () {
            this.$url = this.$el.find('[data-name="url"]');
            this.$text = this.$el.find('[data-name="text"]');
            this.$openInNewWindow = this.$el.find('[data-name="openInNewWindow"]');

            let linkInfo = this.linkInfo;

            this.$url.val(linkInfo.url || '');
            this.$text.val(linkInfo.text || '');

            if ('isNewWindow' in linkInfo) {
                this.$openInNewWindow.get(0).checked = !!linkInfo.isNewWindow;
            }
        },

        controlInputs: function () {
            let url = this.$url.val().trim();

            if (url) {
                this.enableButton('insert');
            } else {
                this.disableButton('insert');
            }
        },

        actionInsert: function () {
            let url = this.$url.val().trim();
            let text = this.$text.val().trim();
            let openInNewWindow = this.$openInNewWindow.get(0).checked;

            let data = {
                url: url,
                text: text || url,
                isNewWindow: openInNewWindow,
                range: this.linkInfo.range,
            };

            this.trigger('insert', data);
            this.close();
        },
    });
});

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

define('views/email-account/fields/test-connection', ['views/fields/base'], function (Dep) {

    return Dep.extend({

        readOnly: true,

        templateContent:
            '<button class="btn btn-default disabled" data-action="testConnection">'+
            '{{translate \'Test Connection\' scope=\'EmailAccount\'}}</button>',

        url: 'EmailAccount/action/testConnection',

        events: {
            'click [data-action="testConnection"]': function () {
                this.test();
            },
        },

        fetch: function () {
            return {};
        },

        checkAvailability: function () {
            if (this.model.get('host')) {
                this.$el.find('button').removeClass('disabled').removeAttr('disabled');
            } else {
                this.$el.find('button').addClass('disabled').attr('disabled', 'disabled');
            }
        },

        afterRender: function () {
            this.checkAvailability();

            this.stopListening(this.model, 'change:host');

            this.listenTo(this.model, 'change:host', () => {
                this.checkAvailability();
            });
        },

        getData: function () {
            return {
                'host': this.model.get('host'),
                'port': this.model.get('port'),
                'security': this.model.get('security'),
                'username': this.model.get('username'),
                'password': this.model.get('password') || null,
                'id': this.model.id,
                emailAddress: this.model.get('emailAddress'),
                userId: this.model.get('assignedUserId'),
            };
        },

        test: function () {
            let data = this.getData();

            let $btn = this.$el.find('button');

            $btn.addClass('disabled');

            Espo.Ui.notify(this.translate('pleaseWait', 'messages'));

            Espo.Ajax.postRequest(this.url, data)
                .then(() => {
                    $btn.removeClass('disabled');

                    Espo.Ui.success(this.translate('connectionIsOk', 'messages', 'EmailAccount'));
                })
                .catch(xhr => {
                    let statusReason = xhr.getResponseHeader('X-Status-Reason') || '';
                    statusReason = statusReason.replace(/ $/, '');
                    statusReason = statusReason.replace(/,$/, '');

                    let msg = this.translate('Error');

                    if (parseInt(xhr.status) !== 200) {
                        msg += ' ' + xhr.status;
                    }

                    if (statusReason) {
                        msg += ': ' + statusReason;
                    }

                    Espo.Ui.error(msg, true);

                    console.error(msg);

                    xhr.errorIsHandled = true;

                    $btn.removeClass('disabled');
                });
        },
    });
});

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

define('views/outbound-email/modals/test-send', ['views/modal'], function (Dep) {

    return Dep.extend({

        cssName: 'test-send',

        templateContent: `
            <label class="control-label">{{translate \'Email Address\' scope=\'Email\'}}</label>
            <input type="text" name="emailAddress" value="{{emailAddress}}" class="form-control">
        `,

        data: function () {
            return {
                emailAddress: this.options.emailAddress,
            };
        },

        setup: function () {
            this.buttonList = [
                {
                    name: 'send',
                    text: this.translate('Send', 'labels', 'Email'),
                    style: 'primary',
                    onClick: () => {
                        var emailAddress = this.$el.find('input').val();

                        if (emailAddress === '') {
                            return;
                        }

                        this.trigger('send', emailAddress);
                    },
                },
                {
                    name: 'cancel',
                    label: 'Cancel',
                    onClick: dialog =>{
                        dialog.close();
                    },
                }
            ];
        },
    });
});

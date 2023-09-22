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

define('crm:views/lead/detail', ['views/detail'], function (Dep) {

    return Dep.extend({

        setup: function () {
            Dep.prototype.setup.call(this);

            this.addMenuItem('buttons', {
                name: 'convert',
                action: 'convert',
                label: 'Convert',
                acl: 'edit',
                hidden: !this.isConvertable(),
                onClick: () => this.actionConvert(),
            });

            if (!this.model.has('status')) {
                this.listenToOnce(this.model, 'sync', () => {
                    if (this.isConvertable()) {
                        this.showHeaderActionItem('convert');
                    }
                });
            }
        },

        isConvertable: function () {
            return !['Converted', 'Dead'].includes(this.model.get('status')) ||
                !this.model.has('status');
        },

        actionConvert: function () {
            this.getRouter().navigate(this.model.entityType + '/convert/' + this.model.id , {trigger: true});
        },
    });
});

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

define('crm:views/case/record/detail', ['views/record/detail'], function (Dep) {

    return Dep.extend({

        selfAssignAction: true,

        setupActionItems: function () {
            Dep.prototype.setupActionItems.call(this);

            if (
                this.getAcl().checkModel(this.model, 'edit') &&
                !~['Closed', 'Rejected', 'Duplicate'].indexOf(this.model.get('status')) &&
                this.getAcl().checkField(this.entityType, 'status', 'edit')
            ) {

                var statusList = this.getMetadata().get(
                    ['entityDefs', 'Case', 'fields', 'status', 'options']
                ) || [];

                if (~statusList.indexOf('Closed')) {
                    this.dropdownItemList.push({
                        'label': 'Close',
                        'name': 'close',
                    });
                }

                if (~statusList.indexOf('Rejected')) {
                    this.dropdownItemList.push({
                        'label': 'Reject',
                        'name': 'reject',
                    });
                }
            }
        },

        manageAccessEdit: function (second) {
            Dep.prototype.manageAccessEdit.call(this, second);

            if (second) {
                if (!this.getAcl().checkModel(this.model, 'edit', true)) {
                    this.hideActionItem('close');
                    this.hideActionItem('reject');
                }
            }
        },

        actionClose: function () {
            this.model.save({status: 'Closed'}, {patch: true})
                .then(() => {
                    Espo.Ui.success(this.translate('Closed', 'labels', 'Case'));

                    this.removeButton('close');
                    this.removeButton('reject');
                });
        },

        actionReject: function () {
            this.model.save({status: 'Rejected'}, {patch: true})
                .then(() => {
                    Espo.Ui.success(this.translate('Rejected', 'labels', 'Case'));

                    this.removeButton('close');
                    this.removeButton('reject');
                });
        },

        getSelfAssignAttributes: function () {
            if (this.model.get('status') === 'New') {
                if (~(this.getMetadata().get(['entityDefs', 'Case', 'fields', 'status', 'options']) || [])
                    .indexOf('Assigned')
                ) {
                    return {
                        'status': 'Assigned',
                    };
                }
            }
        },
    });
});

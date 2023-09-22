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

define('views/email-folder/record/list', ['views/record/list'], function (Dep) {

    return Dep.extend({

        massUpdateDisabled: true,

        massRemoveDisabled: true,

        mergeDisabled: true,

        exportDisabled: true,

        removeDisabled: true,

        rowActionsView: 'views/email-folder/record/row-actions/default',

        actionMoveUp: function (data) {
            var model = this.collection.get(data.id);

            if (!model) {
                return;
            }

            var index = this.collection.indexOf(model);

            if (index === 0) {
                return;
            }

            Espo.Ajax.postRequest('EmailFolder/action/moveUp', {id: model.id}).then(() => {
                this.collection.fetch();
            });
        },

        actionMoveDown: function (data) {
            var model = this.collection.get(data.id);

            if (!model) {
                return;
            }

            var index = this.collection.indexOf(model);

            if ((index === this.collection.length - 1) && (this.collection.length === this.collection.total)) {
                return;
            }

            Espo.Ajax.postRequest('EmailFolder/action/moveDown', {id: model.id}).then(() => {
                this.collection.fetch();
            });
        },
    });
});

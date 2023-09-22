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

define('views/admin/formula/fields/attribute', ['views/fields/multi-enum', 'ui/multi-select'],
function (Dep, /** module:ui/multi-select */MultiSelect) {

    return Dep.extend({

        setupOptions: function () {
            Dep.prototype.setupOptions.call(this);

            if (this.options.attributeList) {
                this.params.options = this.options.attributeList;

                return;
            }

            let attributeList = this.getFieldManager()
                .getEntityTypeAttributeList(this.options.scope)
                .concat(['id'])
                .sort();

            let links = this.getMetadata().get(['entityDefs', this.options.scope, 'links']) || {};

            let linkList = [];

            Object.keys(links).forEach(link => {
                var type = links[link].type;
                let scope = links[link].entity;

                if (!type) {
                    return;
                }

                if (!scope) {
                    return;
                }

                if (
                    links[link].disabled ||
                    links[link].utility
                ) {
                    return;
                }

                if (~['belongsToParent', 'hasOne', 'belongsTo'].indexOf(type)) {
                    linkList.push(link);
                }
            });

            linkList.sort();

            linkList.forEach(link => {
                let linkAttributeList = this.getFieldManager()
                    .getEntityTypeAttributeList(scope)
                    .sort();

                linkAttributeList.forEach(item => {
                    attributeList.push(link + '.' + item);
                });
            });

            this.params.options = attributeList;
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);

            if (this.$element) {
                MultiSelect.focus(this.$element);
            }
        },
    });
});

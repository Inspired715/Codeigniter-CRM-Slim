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

define('views/admin/field-manager/fields/options-reference', ['views/fields/enum'], function (Dep) {

    return Dep.extend({

        enumFieldTypeList: [
            'enum',
            'multiEnum',
            'array',
            'checklist',
            'varchar',
        ],

        setupOptions: function () {
            this.params.options = [''];

            let entityTypeList = Object.keys(this.getMetadata().get(['entityDefs']))
                .filter(item => this.getMetadata().get(['scopes', item, 'object']))
                .sort((s1, s2) => {
                    return this.getLanguage().translate(s1, 'scopesName')
                        .localeCompare(this.getLanguage().translate(s2, 'scopesName'));
                });

            this.translatedOptions = {};

            entityTypeList.forEach(entityType => {
                let fieldList =
                    Object.keys(this.getMetadata().get(['entityDefs', entityType, 'fields']) || [])
                        .filter(item => entityType !== this.model.scope || item !== this.model.get('name'))
                        .sort((s1, s2) => {
                            return this.getLanguage().translate(s1, 'fields', entityType)
                                .localeCompare(this.getLanguage().translate(s2, 'fields', entityType));
                        });

                fieldList.forEach(field => {
                    let {type, options, optionsPath, optionsReference} =
                        this.getMetadata().get(['entityDefs', entityType, 'fields', field]) || {};

                    if (!this.enumFieldTypeList.includes(type)) {
                        return;
                    }

                    if (optionsPath || optionsReference) {
                        return;
                    }

                    if (!options) {
                        return;
                    }

                    let value = entityType + '.' + field;

                    this.params.options.push(value);

                    this.translatedOptions[value] =
                        this.translate(entityType, 'scopeName') + ' · ' +
                        this.translate(field, 'fields', entityType);
                });
            });
        },
    });
});

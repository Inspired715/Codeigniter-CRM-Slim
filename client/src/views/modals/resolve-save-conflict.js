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

import ModalView from 'views/modal';

class ResolveSaveConflictModalView extends ModalView {

    template = 'modals/resolve-save-conflict'

    backdrop = true

    resolutionList = [
        'current',
        'actual',
        'original',
    ]

    defaultResolution = 'current'

    data() {
        let dataList = [];

        this.fieldList.forEach(item => {
            let o = {
                field: item,
                viewKey: item + 'Field',
                resolution: this.defaultResolution,
            };

            dataList.push(o);
        });

        return {
            dataList: dataList,
            entityType: this.entityType,
            resolutionList: this.resolutionList,
        };
    }

    setup() {
        this.headerText = this.translate('Resolve Conflict');

        this.buttonList = [
            {
                name: 'apply',
                label: 'Apply',
                style: 'danger',
            },
            {
                name: 'cancel',
                label: 'Cancel',
            },
        ];

        this.entityType = this.model.entityType;

        this.originalModel = this.model;

        this.originalAttributes = Espo.Utils.cloneDeep(this.options.originalAttributes);
        this.currentAttributes = Espo.Utils.cloneDeep(this.options.currentAttributes);
        this.actualAttributes = Espo.Utils.cloneDeep(this.options.actualAttributes);

        let attributeList = this.options.attributeList;

        let fieldList = [];

        this.getFieldManager()
            .getEntityTypeFieldList(this.entityType)
            .forEach(field => {
                let fieldAttributeList = this.getFieldManager()
                    .getEntityTypeFieldAttributeList(this.entityType, field);

                let intersect = attributeList.filter(value => fieldAttributeList.includes(value));

                if (intersect.length) {
                    fieldList.push(field);
                }
            });

        this.fieldList = fieldList;

        this.wait(
            this.getModelFactory().create(this.entityType)
                .then(model => {
                    this.model = model;

                    this.fieldList.forEach(field => {
                        this.setResolution(field, this.defaultResolution);
                    });

                    this.fieldList.forEach(field => {
                        this.createField(field);
                    });
                })
        );
    }

    setResolution(field, resolution) {
        let attributeList = this.getFieldManager()
            .getEntityTypeFieldAttributeList(this.entityType, field);

        let values = {};

        let source = this.currentAttributes;

        if (resolution === 'actual') {
            source = this.actualAttributes;
        }
        else if (resolution === 'original') {
            source = this.originalAttributes;
        }

        for (let attribute of attributeList) {
            values[attribute] = source[attribute] || null;
        }

        this.model.set(values);
    }

    createField(field) {
        let type = this.model.getFieldType(field);

        let viewName =
            this.model.getFieldParam(field, 'view') ||
            this.getFieldManager().getViewName(type);

        this.createView(field + 'Field', viewName, {
            readOnly: true,
            model: this.model,
            name: field,
            selector: '[data-name="field"][data-field="' + field + '"]',
            mode: 'list',
        });
    }

    afterRender() {
        this.$el.find('[data-name="resolution"]').on('change', e => {
            let $el = $(e.currentTarget);

            let field = $el.attr('data-field');
            let resolution = $el.val();

            this.setResolution(field, resolution);
        });
    }

    // noinspection JSUnusedGlobalSymbols
    actionApply() {
        let attributes = this.model.attributes;

        this.originalModel.set(attributes);

        this.trigger('resolve');
        this.close();
    }
}

export default ResolveSaveConflictModalView;

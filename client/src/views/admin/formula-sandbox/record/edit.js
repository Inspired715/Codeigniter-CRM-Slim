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

define('views/admin/formula-sandbox/record/edit', ['views/record/edit'], function (Dep) {

    return Dep.extend({

        scriptAreaHeight: 400,

        bottomView: null,

        sideView: null,

        buttonList: [
            {
                name: 'run',
                label: 'Run',
                style: 'danger',
                title: 'Ctrl+Enter',
            },
        ],

        dropdownItemList: [],

        isWide: true,

        accessControlDisabled: true,

        saveAndContinueEditingAction: false,

        saveAndNewAction: false,

        shortcutKeyCtrlEnterAction: 'run',

        setup: function () {
            this.scope = 'Formula';

            let additionalFunctionDataList = [
                {
                    "name": "output\\print",
                    "insertText": "output\\print(VALUE)"
                },
                {
                    "name": "output\\printLine",
                    "insertText": "output\\printLine(VALUE)"
                }
            ];

            this.detailLayout = [
                {
                    rows: [
                        [
                            false,
                            {
                                name: 'targetType',
                                labelText: this.translate('targetType', 'fields', 'Formula'),
                            },
                            {
                                name: 'target',
                                labelText: this.translate('target', 'fields', 'Formula'),
                            },
                        ]
                    ]
                },
                {
                    rows: [
                        [
                            {
                                name: 'script',
                                noLabel: true,
                                options: {
                                    targetEntityType: this.model.get('targetType'),
                                    height: this.scriptAreaHeight,
                                    additionalFunctionDataList: additionalFunctionDataList,
                                },
                            },
                        ]
                    ]
                },
                {
                    name: 'output',
                    rows: [
                        [
                            {
                                name: 'errorMessage',
                                labelText: this.translate('error', 'fields', 'Formula'),
                            },
                        ],
                        [
                            {
                                name: 'output',
                                labelText: this.translate('output', 'fields', 'Formula'),
                            },
                        ]
                    ]
                },
            ];

            Dep.prototype.setup.call(this);

            if (!this.model.get('targetType')) {
                this.hideField('target');
            }
            else {
                this.showField('target');
            }

            this.controlTargetTypeField();
            this.listenTo(this.model, 'change:targetId', () => this.controlTargetTypeField());

            this.controlOutputField();
            this.listenTo(this.model, 'change', () => this.controlOutputField());
        },

        controlTargetTypeField: function () {
            if (this.model.get('targetId')) {
                this.setFieldReadOnly('targetType');

                return;
            }

            this.setFieldNotReadOnly('targetType');
        },

        controlOutputField: function () {
            if (this.model.get('errorMessage')) {
                this.showField('errorMessage');
            }
            else {
                this.hideField('errorMessage');
            }
        },

        actionRun: function () {
            this.model.trigger('run');
        },
    });
});

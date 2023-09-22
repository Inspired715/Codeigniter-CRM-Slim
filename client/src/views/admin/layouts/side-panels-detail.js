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

define('views/admin/layouts/side-panels-detail', ['views/admin/layouts/rows'], function (Dep) {

    return Dep.extend({

        dataAttributeList: [
            'name',
            'dynamicLogicVisible',
            'style',
            'dynamicLogicStyled',
            'sticked',
        ],

        dataAttributesDefs: {
            dynamicLogicVisible: {
                type: 'base',
                view: 'views/admin/field-manager/fields/dynamic-logic-conditions',
                tooltip: 'dynamicLogicVisible',
            },
            style: {
                type: 'enum',
                options: [
                    'default',
                    'success',
                    'danger',
                    'warning',
                ],
                default: 'default',
                translation: 'LayoutManager.options.style',
                tooltip: 'panelStyle',
            },
            dynamicLogicStyled: {
                type: 'base',
                view: 'views/admin/field-manager/fields/dynamic-logic-conditions',
                tooltip: 'dynamicLogicStyled',
            },
            sticked: {
                type: 'bool',
                tooltip: 'sticked',
            },
            name: {
                readOnly: true,
            },
        },

        dataAttributesDynamicLogicDefs: {
            fields: {
                dynamicLogicStyled: {
                    visible: {
                        conditionGroup: [
                            {
                                type: 'and',
                                value: [
                                    {
                                        attribute: 'style',
                                        type: 'notEquals',
                                        value: 'default',
                                    },
                                    {
                                        attribute: 'style',
                                        type: 'isNotEmpty',
                                    },
                                ]
                            }

                        ]
                    }
                },
            }
        },

        editable: true,

        ignoreList: [],

        ignoreTypeList: [],

        viewType: 'detail',

        setup: function () {
            Dep.prototype.setup.call(this);

            this.dataAttributesDefs = Espo.Utils.cloneDeep(this.dataAttributesDefs);

            this.dataAttributesDefs.dynamicLogicVisible.scope = this.scope;
            this.dataAttributesDefs.dynamicLogicStyled.scope = this.scope;

            this.wait(true);

            this.loadLayout(() => {
                this.wait(false);
            });
        },

        loadLayout: function (callback) {
            this.getHelper().layoutManager.getOriginal(this.scope, this.type, this.setId, (layout) => {
                this.readDataFromLayout(layout);

                if (callback) {
                    callback();
                }
            });
        },

        readDataFromLayout: function (layout) {
            var panelListAll = [];
            var labels = {};
            var params = {};

            layout = Espo.Utils.cloneDeep(layout);

            if (
                this.getMetadata().get(['clientDefs', this.scope, 'defaultSidePanel', this.viewType]) !== false &&
                !this.getMetadata().get(['clientDefs', this.scope, 'defaultSidePanelDisabled'])
            ) {
                panelListAll.push('default');

                labels['default'] = 'Default';
            }

            (this.getMetadata().get(['clientDefs', this.scope, 'sidePanels', this.viewType]) || [])
                .forEach(item => {
                    if (!item.name) {
                        return;
                    }

                    panelListAll.push(item.name);

                    if (item.label) {
                        labels[item.name] = item.label;
                    }
                    params[item.name] = item;
                });

            this.disabledFields = [];

            layout = layout || {};

            this.rowLayout = [];

            panelListAll.push('_delimiter_');

            if (!layout['_delimiter_']) {
                layout['_delimiter_'] = {
                    disabled: true,
                };
            }

            panelListAll.forEach((item, index) => {
                let disabled = false;
                let itemData = layout[item] || {};

                if (itemData.disabled) {
                    disabled = true;
                }

                if (!layout[item]) {
                    if ((params[item] || {}).disabled) {
                        disabled = true;
                    }
                }

                var labelText;

                if (labels[item]) {
                    labelText = this.getLanguage().translate(labels[item], 'labels', this.scope);
                } else {
                    labelText = this.getLanguage().translate(item, 'panels', this.scope);
                }

                if (disabled) {
                    let o = {
                        name: item,
                        label: labelText,
                    };

                    if (o.name[0] === '_') {
                        o.notEditable = true;

                        if (o.name === '_delimiter_') {
                            o.label = '. . .';
                        }
                    }

                    this.disabledFields.push(o);

                    return;
                }

                let o = {
                    name: item,
                    label: labelText,
                };

                if (o.name[0] === '_') {
                    o.notEditable = true;
                    if (o.name === '_delimiter_') {
                        o.label = '. . .';
                    }
                }

                if (o.name in params) {
                    this.dataAttributeList.forEach(attribute => {
                        if (attribute === 'name') {
                            return;
                        }

                        var itemParams = params[o.name] || {};

                        if (attribute in itemParams) {
                            o[attribute] = itemParams[attribute];
                        }
                    });
                }

                for (var i in itemData) {
                    o[i] = itemData[i];
                }

                o.index = ('index' in itemData) ? itemData.index : index;

                this.rowLayout.push(o);

                this.itemsData[o.name] = Espo.Utils.cloneDeep(o);
            });

            this.rowLayout.sort((v1, v2) => {
                return v1.index - v2.index;
            });
        },

        fetch: function () {
            let layout = {};

            $('#layout ul.disabled > li').each((i, el) => {
                var name = $(el).attr('data-name');

                layout[name] = {
                    disabled: true,
                };
            });

            $('#layout ul.enabled > li').each((i, el) => {
                let $el = $(el);
                let o = {};

                let name = $el.attr('data-name');

                let attributes = this.itemsData[name] || {};

                attributes.name = name;

                this.dataAttributeList.forEach(attribute => {
                    if (attribute === 'name') {
                        return;
                    }

                    if (attribute in attributes) {
                        o[attribute] = attributes[attribute];
                    }
                });

                o.index = i;

                layout[name] = o;
            })

            return layout;
        },
    });
});

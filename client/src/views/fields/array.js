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

/** @module views/fields/array */

import BaseFieldView from 'views/fields/base';
import RegExpPattern from 'helpers/reg-exp-pattern';
import MultiSelect from 'ui/multi-select';

/**
 * An array field.
 */
class ArrayFieldView extends BaseFieldView {

    type = 'array'

    listTemplate = 'fields/array/list'
    listLinkTemplate = 'fields/array/list-link'
    detailTemplate = 'fields/array/detail'
    editTemplate = 'fields/array/edit'
    searchTemplate = 'fields/array/search'

    searchTypeList = ['anyOf', 'noneOf', 'allOf', 'isEmpty', 'isNotEmpty']
    maxItemLength = null
    validations = ['required', 'maxCount']
    MAX_ITEM_LENGTH = 100

    /**
     * An add-item model view.
     *
     * @protected
     * @type {string}
     */
    addItemModalView = 'views/modals/array-field-add'
    /**
     * @protected
     * @type {string}
     */
    itemDelimiter = ':,:'
    /**
     * @protected
     * @type {boolean}
     */
    matchAnyWord = true
    /**
     * @protected
     * @type {Object|null}
     */
    translatedOptions = null

    /** @inheritDoc */
    data() {
        let itemHtmlList = [];

        (this.selected || []).forEach(value => {
            itemHtmlList.push(this.getItemHtml(value));
        });

        return {
            ...super.data(),
            selected: this.selected,
            translatedOptions: this.translatedOptions,
            hasOptions: !!this.params.options,
            itemHtmlList: itemHtmlList,
            isEmpty: (this.selected || []).length === 0,
            valueIsSet: this.model.has(this.name),
            maxItemLength: this.maxItemLength || this.MAX_ITEM_LENGTH,
            allowCustomOptions: this.allowCustomOptions,
        };
    }

    /** @inheritDoc */
    events = {
        /** @this ArrayFieldView */
        'click [data-action="removeValue"]': function (e) {
            let value = $(e.currentTarget).attr('data-value').toString();

            this.removeValue(value);
            this.focusOnElement();
        },
        /** @this ArrayFieldView */
        'click [data-action="showAddModal"]': function () {
            this.actionAddItem();
        },
    }

    setup() {
        super.setup();

        this.noEmptyString = this.params.noEmptyString;

        this.listenTo(this.model, 'change:' + this.name, () => {
            this.selected = Espo.Utils.clone(this.model.get(this.name)) || [];
        });

        this.selected = Espo.Utils.clone(this.model.get(this.name) || []);

        if (Object.prototype.toString.call(this.selected) !== '[object Array]')    {
            this.selected = [];
        }

        let optionsPath = this.params.optionsPath;
        /** @type {?string} */
        let optionsReference = this.params.optionsReference;

        if (!optionsPath && optionsReference) {
            let [refEntityType, refField] = optionsReference.split('.');

            optionsPath = `entityDefs.${refEntityType}.fields.${refField}.options`;
        }

        if (optionsPath) {
            this.params.options = Espo.Utils.clone(this.getMetadata().get(optionsPath)) || [];
        }

        this.styleMap = this.params.style || {};

        this.setupOptions();

        if ('translatedOptions' in this.options) {
            this.translatedOptions = this.options.translatedOptions;
        }

        if ('translatedOptions' in this.params) {
            this.translatedOptions = this.params.translatedOptions;
        }

        if (!this.translatedOptions) {
            this.setupTranslation();
        }

        this.displayAsLabel = this.params.displayAsLabel || this.displayAsLabel;
        this.displayAsList = this.params.displayAsList || this.displayAsList;

        if (this.params.isSorted && this.translatedOptions) {
            this.params.options = Espo.Utils.clone(this.params.options);
            this.params.options = this.params.options.sort((v1, v2) => {
                 return (this.translatedOptions[v1] || v1).localeCompare(this.translatedOptions[v2] || v2);
            });
        }

        if (this.options.customOptionList) {
            this.setOptionList(this.options.customOptionList, true);
        }

        if (this.params.allowCustomOptions || !this.params.options) {
            this.allowCustomOptions = true;
        }
    }

    focusOnElement() {
        let $button = this.$el.find('button[data-action="showAddModal"]');

        if ($button[0]) {
            $button[0].focus({preventScroll: true});

            return;
        }

        let $input = this.$el.find('input');

        if ($input[0]) {
            $input[0].focus({preventScroll: true});
        }
    }

    setupSearch() {
        this.events['change select.search-type'] = e => {
            this.handleSearchType($(e.currentTarget).val());
        };
    }

    handleSearchType(type) {
        let $inputContainer = this.$el.find('div.input-container');

        if (~['anyOf', 'noneOf', 'allOf'].indexOf(type)) {
            $inputContainer.removeClass('hidden');
        } else {
            $inputContainer.addClass('hidden');
        }
    }

    setupTranslation() {
        let obj = {};

        let translation = this.params.translation;
        /** @type {?string} */
        let optionsReference = this.params.optionsReference;

        if (!translation && optionsReference) {
            let [refEntityType, refField] = optionsReference.split('.');

            translation = `${refEntityType}.options.${refField}`;
        }

        this.translatedOptions = null;

        if (!this.params.options) {
            return;
        }

        obj = translation ?
            this.getLanguage().translatePath(translation) :
            this.translate(this.name, 'options', this.model.name);

        let map = {};

        this.params.options.forEach(o => {
            if (typeof obj === 'object' && o in obj) {
                map[o] = obj[o];

                return;
            }

            map[o] = o;
        });

        this.translatedOptions = map;
    }

    setupOptions() {}

    setOptionList(optionList, silent) {
        let previousOptions = this.params.options;

        if (!this.originalOptionList) {
            this.originalOptionList = this.params.options;
        }

        this.params.options = Espo.Utils.clone(optionList);

        let isChanged = !_(previousOptions).isEqual(optionList);

        if (this.isEditMode() && !silent && isChanged) {
            let selectedOptionList = [];

            this.selected.forEach(option => {
                if (~optionList.indexOf(option)) {
                    selectedOptionList.push(option);
                }
            });

            this.selected = selectedOptionList;

            if (this.isRendered()) {
                this.reRender();

                this.trigger('change');
            }
            else {
                this.once('after:render', () => {
                    this.trigger('change');
                });
            }
        }
    }

    setTranslatedOptions(translatedOptions) {
        this.translatedOptions = translatedOptions;
    }

    resetOptionList() {
        if (!this.originalOptionList) {
            return;
        }

        let previousOptions = this.params.options;

        this.params.options = Espo.Utils.clone(this.originalOptionList);

        let isChanged = !_(previousOptions).isEqual(this.originalOptionList);

        if (!this.isEditMode() || !isChanged) {
            return;
        }

        if (this.isRendered()) {
            this.reRender();
        }
    }

    controlAddItemButton() {
        let $select = this.$select;

        if (!$select) {
            return;
        }

        if (!$select.get(0)) {
            return;
        }

        let value = $select.val().toString().trim();

        if (!value && this.params.noEmptyString) {
            this.$addButton.addClass('disabled').attr('disabled', 'disabled');
        }
        else {
            this.$addButton.removeClass('disabled').removeAttr('disabled');
        }
    }

    afterRender() {
        if (this.isEditMode()) {
            this.$list = this.$el.find('.list-group');

            let $select = this.$select = this.$el.find('.select');

            if (this.allowCustomOptions) {
                this.$addButton = this.$el.find('button[data-action="addItem"]');

                this.$addButton.on('click', () => {
                    let value = $select.val().toString();

                    this.addValueFromUi(value);

                    this.focusOnElement();
                });

                $select.on('input', () => this.controlAddItemButton());

                $select.on('keydown', e => {
                    let key = Espo.Utils.getKeyFromKeyEvent(e);

                    if (key === 'Enter') {
                        let value = $select.val().toString();

                        this.addValueFromUi(value);
                    }
                });

                this.controlAddItemButton();
            }

            this.$list.sortable({
                stop: () => {
                    this.fetchFromDom();
                    this.trigger('change');
                },
                distance: 5,
                cancel: 'input,textarea,button,select,option,a[role="button"]',
                cursor: 'grabbing',
            });
        }

        if (this.isSearchMode()) {
            this.renderSearch();
        }
    }

    /**
     * @param {string} value
     */
    addValueFromUi(value) {
        value = value.trim();

        if (this.noEmptyString && value === '') {
            return;
        }

        if (this.params.pattern) {
            let helper = new RegExpPattern(this.getMetadata(), this.getLanguage());

            let result = helper.validate(this.params.pattern, value, this.name, this.entityType);

            if (result) {
                setTimeout(() => this.showValidationMessage(result.message, 'input.select'), 10);

                return;
            }
        }

        this.addValue(value);

        this.$select.val('');

        this.controlAddItemButton();
    }

    renderSearch() {
        this.$element = this.$el.find('.main-element');

        let valueList = this.getSearchParamsData().valueList || this.searchParams.valueFront || [];

        this.$element.val(valueList.join(this.itemDelimiter));

        let items = [];

        (this.params.options || []).forEach(value => {
            let label = this.getLanguage().translateOption(value, this.name, this.scope);

            if (this.translatedOptions) {
                if (value in this.translatedOptions) {
                    label = this.translatedOptions[value];
                }
            }

            if (label === '') {
                return;
            }

            items.push({
                value: value,
                text: label,
            });
        });

        valueList
            .filter(item => !(this.params.options || []).includes(item))
            .forEach(item => {
                items.push({
                    value: item,
                    text: item,
                });
            });

        /** @type {module:ui/multi-select~Options} */
        let multiSelectOptions = {
            items: items,
            delimiter: this.itemDelimiter,
            matchAnyWord: this.matchAnyWord,
            allowCustomOptions: this.allowCustomOptions,
            create: input => {
                return {
                    value: input,
                    text: input,
                };
            },
        };

        MultiSelect.init(this.$element, multiSelectOptions);

        this.$el.find('.selectize-dropdown-content').addClass('small');

        let type = this.$el.find('select.search-type').val();

        this.handleSearchType(type);

        this.$el.find('select.search-type').on('change', () => {
            this.trigger('change');
        });

        this.$element.on('change', () => {
            this.trigger('change');
        });
    }

    fetchFromDom() {
        let selected = [];

        this.$el.find('.list-group .list-group-item').each((i, el) => {
            let value = $(el).attr('data-value').toString();

            selected.push(value);
        });

        this.selected = selected;
    }

    getValueForDisplay() {
        // Do not use the `html` method to avoid XSS.

        /** @var {string[]} */
        let list = this.selected.map(item => {
            let label = null;

            if (this.translatedOptions !== null) {
                if (item in this.translatedOptions) {
                    label = this.translatedOptions[item];
                }
            }

            if (label === null) {
                label = item;
            }

            if (label === '') {
                label = this.translate('None');
            }

            let style = this.styleMap[item] || 'default';

            if (this.params.displayAsLabel) {
                return $('<span>')
                    .addClass('label label-md label-' + style)
                    .text(label)
                    .get(0).outerHTML;

            }

            if (style && style !== 'default') {
                return $('<span>')
                    .addClass('text-' + style)
                    .text(label)
                    .get(0).outerHTML;
            }

            return $('<span>')
                .text(label)
                .get(0).outerHTML;
        });

        if (this.displayAsList) {
            if (!list.length) {
                return '';
            }

            let itemClassName = 'multi-enum-item-container';

            if (this.displayAsLabel) {
                itemClassName += ' multi-enum-item-label-container';
            }

            return list
                .map(item =>
                    $('<div>')
                        .addClass(itemClassName)
                        .html(item)
                        .get(0).outerHTML
                )
                .join('');
        }

        if (this.displayAsLabel) {
            return list.join(' ');
        }

        return list.join(', ');
    }

    getItemHtml(value) {
        // Do not use the `html` method to avoid XSS.

        if (this.translatedOptions !== null) {
            for (let item in this.translatedOptions) {
                if (this.translatedOptions[item] === value) {
                    value = item;

                    break;
                }
            }
        }

        value = value.toString();

        let text = this.translatedOptions && value in this.translatedOptions ?
            this.translatedOptions[value].toString() :
            value;

        return $('<div>')
            .addClass('list-group-item')
            .attr('data-value', value)
            .css('cursor', 'default')
            .append(
                $('<a>')
                    .attr('role', 'button')
                    .attr('tabindex', '0')
                    .addClass('pull-right')
                    .attr('data-value', value)
                    .attr('data-action', 'removeValue')
                    .append(
                        $('<span>').addClass('fas fa-times')
                    )
            )
            .append(
                $('<span>')
                    .addClass('text')
                    .text(text)
            )
            .append('')
            .get(0)
            .outerHTML;
    }

    addValue(value) {
        if (this.selected.indexOf(value) === -1) {
            let html = this.getItemHtml(value);

            this.$list.append(html);
            this.selected.push(value);
            this.trigger('change');
        }
    }

    removeValue(value) {
        let valueInternal = value.replace(/"/g, '\\"');

        this.$list.children('[data-value="' + valueInternal + '"]').remove();

        let index = this.selected.indexOf(value);

        this.selected.splice(index, 1);
        this.trigger('change');
    }

    fetch() {
        let data = {};

        let list = Espo.Utils.clone(this.selected || []);

        if (this.params.isSorted && this.translatedOptions) {
            list = list.sort((v1, v2) => {
                 return (this.translatedOptions[v1] || v1)
                     .localeCompare(this.translatedOptions[v2] || v2);
            });
        }

        data[this.name] = list;

        return data;
    }

    fetchSearch() {
        let type = this.$el.find('select.search-type').val() || 'anyOf';

        let valueList;

        if (~['anyOf', 'noneOf', 'allOf'].indexOf(type)) {
            valueList = this.$element.val().split(this.itemDelimiter);

            if (valueList.length === 1 && valueList[0] === '') {
                valueList = [];
            }

            if (valueList.length === 0) {
               if (type === 'anyOf') {
                   return {
                       type: 'any',
                       data: {
                           type: type,
                           valueList: valueList,
                       },
                   };
               }

               if (type === 'noneOf') {
                   return {
                       type: 'any',
                       data: {
                           type: type,
                           valueList: valueList,
                       },
                   };
               }

               if (type === 'allOf') {
                   return {
                       type: 'any',
                       data: {
                           type: type,
                           valueList: valueList,
                       },
                   };
               }
           }
        }

        if (type === 'anyOf') {
            let data = {
                type: 'arrayAnyOf',
                value: valueList,
                data: {
                    type: 'anyOf',
                    valueList: valueList,
                },
            };

            if (!valueList.length) {
                data.value = null;
            }

            return data;
        }

        if (type === 'noneOf') {
            return {
                type: 'arrayNoneOf',
                value: valueList,
                data: {
                    type: 'noneOf',
                    valueList: valueList,
                },
            };
        }

        if (type === 'allOf') {
            let data = {
                type: 'arrayAllOf',
                value: valueList,
                data: {
                    type: 'allOf',
                    valueList: valueList,
                },
            };

            if (!valueList.length) {
                data.value = null;
            }

            return data;
        }

        if (type === 'isEmpty') {
            return {
                type: 'arrayIsEmpty',
                data: {
                    type: 'isEmpty',
                },
            };
        }

        if (type === 'isNotEmpty') {
            return {
                type: 'arrayIsNotEmpty',
                data: {
                    type: 'isNotEmpty',
                },
            };
        }

        return null;
    }

    validateRequired() {
        if (this.isRequired()) {
            let value = this.model.get(this.name);

            if (!value || value.length === 0) {
                let msg = this.translate('fieldIsRequired', 'messages')
                    .replace('{field}', this.getLabelText());

                this.showValidationMessage(msg, '.array-control-container');

                return true;
            }
        }

        return false;
    }

    validateMaxCount() {
        if (this.params.maxCount) {
            let itemList = this.model.get(this.name) || [];

            if (itemList.length > this.params.maxCount) {
                let msg =
                    this.translate('fieldExceedsMaxCount', 'messages')
                        .replace('{field}', this.getLabelText())
                        .replace('{maxCount}', this.params.maxCount.toString());

                this.showValidationMessage(msg, '.array-control-container');

                return true;
            }
        }

        return false;
    }

    getSearchType() {
        return this.getSearchParamsData().type || 'anyOf';
    }

    /**
     * @return {{
     *    translatedOptions: Object.<string, *>|null,
     *    options: string[],
     * } | Object.<string, *>}
     */
    getAddItemModalOptions() {
        let options = [];

        this.params.options.forEach(item => {
            if (!~this.selected.indexOf(item)) {
                options.push(item);
            }
        });

        return {
            options: options,
            translatedOptions: this.translatedOptions,
        };
    }

    actionAddItem() {
        this.createView('addModal', this.addItemModalView, this.getAddItemModalOptions(), view => {
            view.render();

            view.once('add', item => {
                this.addValue(item);
                view.close();
            });

            view.once('add-mass', items => {
                items.forEach(item => this.addValue(item));
                view.close();
            });
        });
    }
}

export default ArrayFieldView;

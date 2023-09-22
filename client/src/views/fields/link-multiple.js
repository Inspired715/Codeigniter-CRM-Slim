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

/** @module views/fields/link-multiple */

import BaseFieldView from 'views/fields/base';
import RecordModal from 'helpers/record-modal';

/**
 * A link-multiple field (for has-many relations).
 */
class LinkMultipleFieldView extends BaseFieldView {

    type = 'linkMultiple'

    listTemplate = 'fields/link-multiple/list'
    detailTemplate = 'fields/link-multiple/detail'
    editTemplate = 'fields/link-multiple/edit'
    searchTemplate = 'fields/link-multiple/search'

    /**
     * A name-hash attribute name.
     *
     * @protected
     * @type {string}
     */
    nameHashName = null

    /**
     * A IDs attribute name.
     *
     * @protected
     * @type {string}
     */
    idsName = null

    /**
     * @protected
     * @type {Object.<string,string>|null}
     */
    nameHash = null

    /**
     * @protected
     * @type {string[]|null}
     */
    ids = null

    /**
     * A foreign entity type.
     *
     * @protected
     * @type {string}
     */
    foreignScope = null

    /**
     * Autocomplete disabled.
     *
     * @protected
     * @type {boolean}
     */
    autocompleteDisabled = false

    /**
     * A select-record view.
     *
     * @protected
     * @type {string}
     */
    selectRecordsView = 'views/modals/select-records'

    /**
     * Create disabled.
     *
     * @protected
     * @type {boolean}
     */
    createDisabled = false

    /**
     * Force create button even is disabled in clientDefs > relationshipPanels.
     *
     * @protected
     * @type {boolean}
     */
    forceCreateButton = false

    /**
     * @protected
     * @type {boolean}
     */
    sortable = false

    /**
     * A search type list.
     *
     * @protected
     * @type {string[]}
     */
    searchTypeList = [
        'anyOf',
        'isEmpty',
        'isNotEmpty',
        'noneOf',
        'allOf',
    ]

    /**
     * A primary filter list that will be available when selecting a record.
     *
     * @protected
     * @type {string[]|null}
     */
    selectFilterList = null

    /**
     * A select bool filter list.
     *
     * @protected
     * @type {string[]|null}
     */
    selectBoolFilterList = null

    /**
     * A select primary filter.
     *
     * @protected
     * @type {string|null}
     */
    selectPrimaryFilterName = null

    /**
     * An autocomplete max record number.
     *
     * @protected
     * @type {number|null}
     */
    autocompleteMaxCount = null

    /**
     * Select all attributes.
     *
     * @protected
     * @type {boolean}
     */
    forceSelectAllAttributes = false

    /**
     * @protected
     * @type {string}
     */
    iconHtml = ''

    /** @inheritDoc */
    events = {
        /** @this LinkMultipleFieldView */
        'auxclick a[href]:not([role="button"])': function (e) {
            if (!this.isReadMode()) {
                return;
            }

            let isCombination = e.button === 1 && (e.ctrlKey || e.metaKey);

            if (!isCombination) {
                return;
            }

            let id = $(e.currentTarget).attr('data-id');

            if (!id) {
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            this.quickView(id);
        },
    }

    /** @inheritDoc */
    data() {
        let ids = this.model.get(this.idsName);

        return {
            ...super.data(),
            idValues: this.model.get(this.idsName),
            idValuesString: ids ? ids.join(',') : '',
            nameHash: this.model.get(this.nameHashName),
            foreignScope: this.foreignScope,
            valueIsSet: this.model.has(this.idsName),
        };
    }

    /**
     * Get advanced filters (field filters) to be applied when select a record.
     * Can be extended.
     *
     * @protected
     * @return {Object.<string, module:search-manager~advancedFilter>|null}
     */
    getSelectFilters() {
        return null;
    }

    /**
     * Get a select bool filter list. Applied when select a record.
     * Can be extended.
     *
     * @protected
     * @return {string[]|null}
     */
    getSelectBoolFilterList() {
        return this.selectBoolFilterList;
    }

    /**
     * Get a select primary filter. Applied when select a record.
     * Can be extended.
     *
     * @protected
     * @return {string|null}
     */
    getSelectPrimaryFilterName() {
        return this.selectPrimaryFilterName;
    }

    /**
     * Get a primary filter list that will be available when selecting a record.
     * Can be extended.
     *
     * @return {string[]|null}
     */
    getSelectFilterList() {
        return this.selectFilterList;
    }

    /**
     * Attributes to pass to a model when creating a new record.
     * Can be extended.
     *
     * @return {Object.<string, *>|null}
     */
    getCreateAttributes() {
        let attributeMap = this.getMetadata()
            .get(['clientDefs', this.entityType, 'relationshipPanels', this.name, 'createAttributeMap']) || {};

        let attributes = {};

        Object.keys(attributeMap).forEach(attr => attributes[attributeMap[attr]] = this.model.get(attr));

        return attributes;
    }

    /** @inheritDoc */
    setup() {
        this.nameHashName = this.name + 'Names';
        this.idsName = this.name + 'Ids';

        this.foreignScope = this.options.foreignScope ||
            this.foreignScope ||
            this.model.getFieldParam(this.name, 'entity') ||
            this.model.getLinkParam(this.name, 'entity');

        if ('createDisabled' in this.options) {
            this.createDisabled = this.options.createDisabled;
        }

        if (this.isSearchMode()) {
            let nameHash = this.getSearchParamsData().nameHash || this.searchParams.nameHash || {};
            let idList = this.getSearchParamsData().idList || this.searchParams.value || [];

            this.nameHash = Espo.Utils.clone(nameHash);
            this.ids = Espo.Utils.clone(idList);
        }
        else {
            this.copyValuesFromModel();
        }

        this.listenTo(this.model, 'change:' + this.idsName, () => {
            this.copyValuesFromModel();
        });

        this.sortable = this.sortable || this.params.sortable;

        this.iconHtml = this.getHelper().getScopeColorIconHtml(this.foreignScope);

        if (!this.isListMode()) {
            this.addActionHandler('selectLink', () => this.actionSelect());

            this.events['click a[data-action="clearLink"]'] = (e) => {
                let id = $(e.currentTarget).attr('data-id');

                this.deleteLink(id);

                // noinspection JSUnresolvedReference
                this.$element.get(0).focus({preventScroll: true});
            };
        }
    }

    /**
     * Copy values from a model to view properties.
     */
    copyValuesFromModel() {
        this.ids = Espo.Utils.clone(this.model.get(this.idsName) || []);
        this.nameHash = Espo.Utils.clone(this.model.get(this.nameHashName) || {});
    }

    /**
     * Handle a search type.
     *
     * @protected
     * @param {string} type A type.
     */
    handleSearchType(type) {
        if (~['anyOf', 'noneOf', 'allOf'].indexOf(type)) {
            this.$el.find('div.link-group-container').removeClass('hidden');
        }
        else {
            this.$el.find('div.link-group-container').addClass('hidden');
        }
    }

    /** @inheritDoc */
    setupSearch() {
        this.events = _.extend({
            'change select.search-type': (e) => {
                let type = $(e.currentTarget).val();

                this.handleSearchType(type);
            },
        }, this.events || {});
    }

    /**
     * Get an autocomplete max record number. Can be extended.
     *
     * @protected
     * @return {number}
     */
    getAutocompleteMaxCount() {
        if (this.autocompleteMaxCount) {
            return this.autocompleteMaxCount;
        }

        return this.getConfig().get('recordsPerPage');
    }

    /**
     * Compose an autocomplete URL. Can be extended.
     *
     * @protected
     * @return {string}
     */
    getAutocompleteUrl() {
        let url = this.foreignScope + '?&maxSize=' + this.getAutocompleteMaxCount();

        if (!this.forceSelectAllAttributes) {
            /** @var {Object.<string, *>} */
            const panelDefs = this.getMetadata()
                .get(['clientDefs', this.entityType, 'relationshipPanels', this.name]) || {};

            const mandatorySelectAttributeList = this.mandatorySelectAttributeList ||
                panelDefs.selectMandatoryAttributeList;

            let select = ['id', 'name'];

            if (mandatorySelectAttributeList) {
                select = select.concat(mandatorySelectAttributeList);
            }

            url += '&select=' + select.join(',')
        }

        /** @var {Object.<string, *>} */
        const panelDefs = this.getMetadata()
            .get(['clientDefs', this.entityType, 'relationshipPanels', this.name]) || {};

        const boolList = [
            ...(this.getSelectBoolFilterList() || []),
            ...(panelDefs.selectBoolFilterList || []),
        ];

        if (boolList.length) {
            url += '&' + $.param({'boolFilterList': boolList});
        }

        const primary = this.getSelectPrimaryFilterName() || panelDefs.selectPrimaryFilter;

        if (primary) {
            url += '&' + $.param({'primaryFilter': primary});
        }

        return url;
    }

    /** @inheritDoc */
    afterRender() {
        if (this.isEditMode() || this.isSearchMode()) {
            this.$element = this.$el.find('input.main-element');

            let $element = this.$element;

            if (!this.autocompleteDisabled) {
                this.$element.on('blur', () => {
                    setTimeout(() => this.$element.autocomplete('clear'), 300);
                });

                this.$element.autocomplete({
                    serviceUrl: () => {
                        return this.getAutocompleteUrl();
                    },
                    minChars: 1,
                    paramName: 'q',
                    noCache: true,
                    autoSelectFirst: true,
                    triggerSelectOnValidInput: false,
                    beforeRender: $c => {
                        if (this.$element.hasClass('input-sm')) {
                            $c.addClass('small');
                        }
                    },
                    formatResult: suggestion => {
                        // noinspection JSUnresolvedReference
                        return this.getHelper().escapeString(suggestion.name);
                    },
                    transformResult: response => {
                        response = JSON.parse(response);

                        let list = [];

                        response.list.forEach((item) => {
                            list.push({
                                id: item.id,
                                name: item.name || item.id,
                                data: item.id,
                                value: item.name || item.id,
                            });
                        });

                        return {
                            suggestions: list
                        };
                    },
                    onSelect: s => {
                        // noinspection JSUnresolvedReference
                        this.addLink(s.id, s.name);

                        this.$element.val('');
                        this.$element.focus();
                    },
                });

                this.$element.attr('autocomplete', 'espo-' + this.name);

                this.once('render', () => {
                    $element.autocomplete('dispose');
                });

                this.once('remove', () => {
                    $element.autocomplete('dispose');
                });
            }

            $element.on('change', () => {
                $element.val('');
            });

            this.renderLinks();

            if (this.isEditMode()) {
                if (this.sortable) {
                    // noinspection JSUnresolvedReference
                    this.$el.find('.link-container').sortable({
                        stop: () => {
                            this.fetchFromDom();
                            this.trigger('change');
                        },
                    });
                }
            }

            if (this.isSearchMode()) {
                let type = this.$el.find('select.search-type').val();

                this.handleSearchType(type);

                this.$el.find('select.search-type').on('change', () => {
                    this.trigger('change');
                });
            }
        }
    }

    /**
     * Render items.
     *
     * @protected
     */
    renderLinks() {
        this.ids.forEach(id => {
            this.addLinkHtml(id, this.nameHash[id]);
        });
    }

    /**
     * Delete an item.
     *
     * @protected
     * @param {string} id An ID.
     */
    deleteLink(id) {
        this.trigger('delete-link', id);
        this.trigger('delete-link:' + id);

        this.deleteLinkHtml(id);

        let index = this.ids.indexOf(id);

        if (index > -1) {
            this.ids.splice(index, 1);
        }

        delete this.nameHash[id];

        this.afterDeleteLink(id);
        this.trigger('change');
    }

    /**
     * Add an item.
     *
     * @protected
     * @param {string} id An ID.
     * @param {string} name A name.
     */
    addLink(id, name) {
        if (!~this.ids.indexOf(id)) {
            this.ids.push(id);

            this.nameHash[id] = name;

            this.addLinkHtml(id, name);
            this.afterAddLink(id);

            this.trigger('add-link', id);
            this.trigger('add-link:' + id);
        }

        this.trigger('change');
    }

    /**
     * @protected
     * @param {string} id An ID.
     */
    afterDeleteLink(id) {}

    /**
     * @protected
     * @param {string} id An ID.
     */
    afterAddLink(id) {}

    /**
     * @protected
     * @param {string} id An ID.
     */
    deleteLinkHtml(id) {
        this.$el.find('.link-' + id).remove();
    }

    /**
     * Add an item for edit mode.
     *
     * @protected
     * @param {string} id An ID.
     * @param {string} name A name.
     * @return {JQuery|null}
     */
    addLinkHtml(id, name) {
        // Do not use the `html` method to avoid XSS.

        name = name || id;

        let $container = this.$el.find('.link-container');

        let $el = $('<div>')
            .addClass('link-' + id)
            .addClass('list-group-item')
            .attr('data-id', id);

        $el.text(name).append('&nbsp;');

        $el.prepend(
            $('<a>')
                .addClass('pull-right')
                .attr('role', 'button')
                .attr('tabindex', '0')
                .attr('data-id', id)
                .attr('data-action', 'clearLink')
                .append(
                    $('<span>').addClass('fas fa-times')
                )
        );

        $container.append($el);

        return $el;
    }

    // noinspection JSUnusedLocalSymbols
    /**
     * @param {string} id An ID.
     * @return {string}
     */
    getIconHtml(id) {
        return this.iconHtml;
    }

    /**
     * Get an item HTML for detail mode.
     *
     * @param {string} id An ID.
     * @param {string} [name] A name.
     * @return {string}
     */
    getDetailLinkHtml(id, name) {
        // Do not use the `html` method to avoid XSS.

        name = name || this.nameHash[id] || id;

        if (!name && id) {
            name = this.translate(this.foreignScope, 'scopeNames');
        }

        let iconHtml = this.isDetailMode() ?
            this.getIconHtml(id) : '';

        let $a = $('<a>')
            .attr('href', this.getUrl(id))
            .attr('data-id', id)
            .text(name);

        if (iconHtml) {
            $a.prepend(iconHtml)
        }

        return $a.get(0).outerHTML;
    }

    /**
     * @protected
     * @param {string} id An ID.
     * @return {string}
     */
    getUrl(id) {
        return '#' + this.foreignScope + '/view/' + id;
    }

    /** @inheritDoc */
    getValueForDisplay() {
        if (!this.isDetailMode() && !this.isListMode()) {
            return null;
        }

        let itemList = [];

        this.ids.forEach(id => {
            itemList.push(this.getDetailLinkHtml(id));
        });

        if (!itemList.length) {
            return null;
        }

        return itemList
            .map(item => $('<div>')
                .addClass('link-multiple-item')
                .html(item)
                .wrap('<div />').parent().html()
            )
            .join('');
    }

    /** @inheritDoc */
    validateRequired() {
        if (!this.isRequired()) {
            return false;
        }

        let idList = this.model.get(this.idsName) || [];

        if (idList.length === 0) {
            let msg = this.translate('fieldIsRequired', 'messages')
                .replace('{field}', this.getLabelText());

            this.showValidationMessage(msg);

            return true;
        }

        return false;
    }

    /** @inheritDoc */
    fetch() {
        let data = {};

        data[this.idsName] = Espo.Utils.clone(this.ids);
        data[this.nameHashName] = Espo.Utils.clone(this.nameHash);

        return data;
    }

    /** @inheritDoc */
    fetchFromDom() {
        this.ids = [];

        this.$el.find('.link-container').children().each((i, li) => {
            let id = $(li).attr('data-id');

            if (!id) {
                return;
            }

            this.ids.push(id);
        });
    }

    /** @inheritDoc */
    fetchSearch() {
        let type = this.$el.find('select.search-type').val();
        let idList = this.ids || [];

        if (~['anyOf', 'allOf', 'noneOf'].indexOf(type) && !idList.length) {
            return {
                type: 'isNotNull',
                attribute: 'id',
                data: {
                    type: type,
                },
            };
        }

        let data;

        if (type === 'anyOf') {
            data = {
                type: 'linkedWith',
                value: idList,
                data: {
                    type: type,
                    nameHash: this.nameHash,
                },
            };

            return data;
        }

        if (type === 'allOf') {
            data = {
                type: 'linkedWithAll',
                value: idList,
                data: {
                    type: type,
                    nameHash: this.nameHash,
                },
            };

            if (!idList.length) {
                data.value = null;
            }

            return data;
        }

        if (type === 'noneOf') {
            data = {
                type: 'notLinkedWith',
                value: idList,
                data: {
                    type: type,
                    nameHash: this.nameHash,
                },
            };

            return data;
        }

        if (type === 'isEmpty') {
            data = {
                type: 'isNotLinked',
                data: {
                    type: type,
                },
            };

            return data;
        }

        if (type === 'isNotEmpty') {
            data = {
                type: 'isLinked',
                data: {
                    type: type,
                },
            };

            return data;
        }
    }

    /** @inheritDoc */
    getSearchType() {
        return this.getSearchParamsData().type ||
            this.searchParams.typeFront ||
            this.searchParams.type || 'anyOf';
    }

    /**
     * @protected
     * @param {string} id
     */
    quickView(id) {
        let entityType = this.foreignScope;

        let helper = new RecordModal(this.getMetadata(), this.getAcl());

        helper.showDetail(this, {
            id: id,
            scope: entityType,
        });
    }

    /**
     * @protected
     */
    actionSelect() {
        Espo.Ui.notify(' ... ');

        /** @var {Object.<string, *>} */
        const panelDefs = this.getMetadata()
            .get(['clientDefs', this.entityType, 'relationshipPanels', this.name]) || {};

        const viewName = panelDefs.selectModalView ||
            this.getMetadata().get(`clientDefs.${this.foreignScope}.modalViews.select`) ||
            this.selectRecordsView;

        const mandatorySelectAttributeList = this.mandatorySelectAttributeList ||
            panelDefs.selectMandatoryAttributeList;

        const handler = panelDefs.selectHandler || null;

        let createButton = this.isEditMode() &&
            (!this.createDisabled && !panelDefs.createDisabled || this.forceCreateButton);

        let createAttributesProvider = null;

        if (createButton) {
            createAttributesProvider = () => {
                let attributes = this.getCreateAttributes() || {};

                if (!panelDefs.createHandler) {
                    return Promise.resolve(attributes);
                }

                return new Promise(resolve => {
                    Espo.loader.requirePromise(panelDefs.createHandler)
                        .then(Handler => new Handler(this.getHelper()))
                        .then(handler => {
                            handler.getAttributes(this.model)
                                .then(additionalAttributes => {
                                    resolve({
                                        ...attributes,
                                        ...additionalAttributes,
                                    });
                                });
                        });
                });
            };
        }

        new Promise(resolve => {
            if (!handler || this.isSearchMode()) {
                resolve({});

                return;
            }

            Espo.loader.requirePromise(handler)
                .then(Handler => new Handler(this.getHelper()))
                .then(/** module:handlers/select-related */handler => {
                    handler.getFilters(this.model)
                        .then(filters => resolve(filters));
                });
        }).then(filters => {
            const advanced = {...(this.getSelectFilters() || {}), ...(filters.advanced || {})};
            const boolFilterList = [
                ...(this.getSelectBoolFilterList() || []),
                ...(filters.bool || []),
                ...(panelDefs.selectBoolFilterList || []),
            ];
            const primaryFilter = this.getSelectPrimaryFilterName() ||
                filters.primary || panelDefs.selectPrimaryFilter;

            this.createView('dialog', viewName, {
                scope: this.foreignScope,
                createButton: createButton,
                filters: advanced,
                boolFilterList: boolFilterList,
                primaryFilterName: primaryFilter,
                filterList: this.getSelectFilterList(),
                multiple: true,
                mandatorySelectAttributeList: mandatorySelectAttributeList,
                forceSelectAllAttributes: this.forceSelectAllAttributes,
                createAttributesProvider: createAttributesProvider,
            }, dialog => {
                dialog.render();

                Espo.Ui.notify(false);

                this.listenToOnce(dialog, 'select', models => {
                    this.clearView('dialog');

                    if (Object.prototype.toString.call(models) !== '[object Array]') {
                        models = [models];
                    }

                    models.forEach(model => {
                        this.addLink(model.id, model.get('name'));
                    });
                });
            });
        });
    }
}

export default LinkMultipleFieldView;

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

/** @module views/record/panels/relationship */

import BottomPanelView from 'views/record/panels/bottom';
import SearchManager from 'search-manager';
import RecordModal from 'helpers/record-modal';

/**
 * A relationship panel.
 */
class RelationshipPanelView extends BottomPanelView {

    /** @inheritDoc */
    template = 'record/panels/relationship'

    /**
     * A row-actions view.
     *
     * @protected
     */
    rowActionsView = 'views/record/row-actions/relationship'

    /**
     * An API URL.
     *
     * @protected
     * @type {string|null}
     */
    url = null

    /**
     * A scope.
     *
     * @type {string|null}
     */
    scope = null

    /**
     * Read-only.
     */
    readOnly = false

    /**
     * Fetch a collection on a model 'after:relate' event.
     *
     * @protected
     */
    fetchOnModelAfterRelate = false

    /**
     * @protected
     */
    noCreateScopeList = ['User', 'Team', 'Role', 'Portal']

    /**
     * @private
     */
    recordsPerPage = null

    /**
     * @protected
     */
    viewModalView = null

    setup() {
        super.setup();

        this.link = this.link || this.defs.link || this.panelName;

        if (!this.scope && !(this.link in this.model.defs.links)) {
            throw new Error('Link \'' + this.link + '\' is not defined in model \'' + this.model.entityType + '\'');
        }

        this.scope = this.scope || this.model.defs.links[this.link].entity;

        let linkReadOnly = this.getMetadata()
            .get(['entityDefs', this.model.entityType, 'links', this.link, 'readOnly']) || false;

        let url = this.url = this.url || this.model.entityType + '/' + this.model.id + '/' + this.link;

        if (!('create' in this.defs)) {
            this.defs.create = true;
        }

        if (!('select' in this.defs)) {
            this.defs.select = true;
        }

        if (!('view' in this.defs)) {
            this.defs.view = true;
        }

        if (linkReadOnly) {
            this.defs.create = false;
            this.defs.select = false;
        }

        this.filterList = this.defs.filterList || this.filterList || null;

        if (this.filterList && this.filterList.length) {
            this.filter = this.getStoredFilter();
        }

        this.setupTitle();

        if (this.defs.createDisabled) {
            this.defs.create = false;
        }

        if (this.defs.selectDisabled) {
            this.defs.select = false;
        }

        if (this.defs.viewDisabled) {
            this.defs.view = false;
        }

        let hasCreate = false;

        if (this.defs.create) {
            if (
                this.getAcl().check(this.scope, 'create') &&
                !~this.noCreateScopeList.indexOf(this.scope)
            ) {
                this.buttonList.push({
                    title: 'Create',
                    action: this.defs.createAction || 'createRelated',
                    link: this.link,
                    html: '<span class="fas fa-plus"></span>',
                    data: {
                        link: this.link,
                    },
                    acl: this.defs.createRequiredAccess || null,
                });

                hasCreate = true;
            }
        }

        if (this.defs.select) {
            let data = {link: this.link};

            if (this.defs.selectPrimaryFilterName) {
                data.primaryFilterName = this.defs.selectPrimaryFilterName;
            }

            if (this.defs.selectBoolFilterList) {
                data.boolFilterList = this.defs.selectBoolFilterList;
            }

            data.massSelect = this.defs.massSelect;
            data.createButton = hasCreate;

            this.actionList.unshift({
                label: 'Select',
                action: this.defs.selectAction || 'selectRelated',
                data: data,
                acl: this.defs.selectRequiredAccess || 'edit',
            });
        }

        if (this.defs.view) {
            this.actionList.unshift({
                label: 'View List',
                action: this.defs.viewAction || 'viewRelatedList',
            });
        }

        this.setupActions();

        let layoutName = 'listSmall';

        this.setupListLayout();

        if (this.listLayoutName) {
            layoutName = this.listLayoutName;
        }

        let listLayout = null;

        let layout = this.defs.layout || null;

        if (layout) {
            if (typeof layout === 'string') {
                 layoutName = layout;
            } else {
                 layoutName = 'listRelationshipCustom';
                 listLayout = layout;
            }
        }

        this.listLayout = listLayout;
        this.layoutName = layoutName;

        this.setupSorting();

        this.wait(true);

        this.getCollectionFactory().create(this.scope, collection => {
            collection.maxSize = this.recordsPerPage || this.getConfig().get('recordsPerPageSmall') || 5;

            if (this.defs.filters) {
                let searchManager = new SearchManager(collection, 'listRelationship', false, this.getDateTime());
                searchManager.setAdvanced(this.defs.filters);
                collection.where = searchManager.getWhere();
            }

            collection.url = collection.urlRoot = url;

            if (this.defaultOrderBy) {
                collection.setOrder(this.defaultOrderBy, this.defaultOrder || false, true);
            }

            this.collection = collection;

            collection.parentModel = this.model;

            this.setFilter(this.filter);

            if (this.fetchOnModelAfterRelate) {
                this.listenTo(this.model, 'after:relate', () => collection.fetch());
            }

            this.listenTo(this.model, 'update-all', () => collection.fetch());

            let viewName =
                this.defs.recordListView ||
                this.getMetadata().get(['clientDefs', this.scope, 'recordViews', 'listRelated']) ||
                this.getMetadata().get(['clientDefs', this.scope, 'recordViews', 'list']) ||
                'views/record/list';

            this.listViewName = viewName;
            this.rowActionsView = this.defs.readOnly ? false : (this.defs.rowActionsView || this.rowActionsView);

            this.once('after:render', () => {
                this.createView('list', viewName, {
                    collection: collection,
                    layoutName: layoutName,
                    listLayout: listLayout,
                    checkboxes: false,
                    rowActionsView: this.rowActionsView,
                    buttonsDisabled: true,
                    selector: '.list-container',
                    skipBuildRows: true,
                    rowActionsOptions: {
                        unlinkDisabled: this.defs.unlinkDisabled,
                    },
                    displayTotalCount: false,
                }, view => {
                    view.getSelectAttributeList((selectAttributeList) => {
                        if (selectAttributeList) {
                            collection.data.select = selectAttributeList.join(',');
                        }

                        if (!this.defs.hidden) {
                            collection.fetch();

                            return;
                        }

                        this.once('show', () => collection.fetch());
                    });
                });
            });

            this.wait(false);
        });

        this.setupFilterActions();
        this.setupLast();
    }

    /**
     * Set up lastly.
     *
     * @protected
     */
    setupLast() {}

    /**
     * Set up title.
     *
     * @protected
     */
    setupTitle() {
        this.title = this.title || this.translate(this.link, 'links', this.model.entityType);

        let iconHtml = '';

        if (!this.getConfig().get('scopeColorsDisabled')) {
            iconHtml = this.getHelper().getScopeColorIconHtml(this.scope);
        }

        this.titleHtml = this.title;

        if (this.defs.label) {
            this.titleHtml = iconHtml + this.translate(this.defs.label, 'labels', this.scope);
        } else {
            this.titleHtml = iconHtml + this.title;
        }

        if (this.filter && this.filter !== 'all') {
            this.titleHtml += ' &middot; ' + this.translateFilter(this.filter);
        }
    }

    /**
     * Set up sorting.
     *
     * @protected
     */
    setupSorting() {
        let orderBy = this.defs.orderBy || this.defs.sortBy || this.orderBy;
        let order = this.defs.orderDirection || this.orderDirection || this.order;

        if ('asc' in this.defs) { // @todo Remove.
            order = this.defs.asc ? 'asc' : 'desc';
        }

        if (!orderBy) {
            orderBy = this.getMetadata().get(['entityDefs', this.scope, 'collection', 'orderBy']);
            order = this.getMetadata().get(['entityDefs', this.scope, 'collection', 'order'])
        }

        if (orderBy && !order) {
            order = 'asc';
        }

        this.defaultOrderBy = orderBy;
        this.defaultOrder = order;
    }

    /**
     * Set up a list layout.
     *
     * @protected
     */
    setupListLayout() {}

    /**
     * Set up actions.
     *
     * @protected
     */
    setupActions() {}

    /**
     * Set up filter actions.
     *
     * @protected
     */
    setupFilterActions() {
        if (this.filterList && this.filterList.length) {
            this.actionList.push(false);

            this.filterList.slice(0).forEach((item) => {
                let selected;

                if (item === 'all') {
                    selected = !this.filter;
                }
                else {
                    selected = item === this.filter;
                }

                let label = this.translateFilter(item);

                let $item =
                    $('<div>')
                        .append(
                            $('<span>')
                                .addClass('check-icon fas fa-check pull-right')
                                .addClass(!selected ? 'hidden' : '')
                        )
                        .append(
                            $('<div>').text(label)
                        );

                this.actionList.push({
                    action: 'selectFilter',
                    html: $item.get(0).innerHTML,
                    data: {
                        name: item,
                    },
                });
            });
        }
    }

    /**
     * Translate a filter.
     *
     * @param {string} name A name.
     * @return {string}
     */
    translateFilter(name) {
        return this.translate(name, 'presetFilters', this.scope);
    }

    /**
     * @protected
     */
    getStoredFilter() {
        let key = 'panelFilter' + this.model.entityType + '-' + (this.panelName || this.name);

        return this.getStorage().get('state', key) || null;
    }

    /**
     * @private
     */
    storeFilter(filter) {
        let key = 'panelFilter' + this.model.entityType + '-' + (this.panelName || this.name);

        if (filter) {
            this.getStorage().set('state', key, filter);
        } else {
            this.getStorage().clear('state', key);
        }
    }

    /**
     * Set a filter.
     *
     * @param {string} filter A filter.
     */
    setFilter(filter) {
        this.filter = filter;
        this.collection.data.primaryFilter = null;

        if (filter && filter !== 'all') {
            this.collection.data.primaryFilter = filter;
        }
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * A `select-filter` action.
     *
     * @protected
     */
    actionSelectFilter(data) {
        let filter = data.name;
        let filterInternal = filter;

        if (filter === 'all') {
            filterInternal = false;
        }

        this.storeFilter(filterInternal);
        this.setFilter(filterInternal);

        this.filterList.forEach(item => {
            let $el = this.$el.closest('.panel').find('[data-name="'+item+'"] span');

            if (item === filter) {
                $el.removeClass('hidden');
            } else {
                $el.addClass('hidden');
            }
        });

        this.collection.reset();

        let listView = this.getView('list');

        if (listView && listView.$el) {
            let height = listView.$el.parent().get(0).clientHeight;

            listView.$el.empty();

            if (height) {
                listView.$el.parent().css('height', height + 'px');
            }
        }

        this.collection.fetch().then(() => {
            listView.$el.parent().css('height', '');
        });

        this.setupTitle();

        if (this.isRendered()) {
            this.$el.closest('.panel')
                .find('> .panel-heading > .panel-title > span')
                .html(this.titleHtml);
        }
    }

    /**
     * A `refresh` action.
     *
     * @protected
     */
    actionRefresh() {
        this.collection.fetch();
    }

    /**
     * A `view-related-list` action.
     *
     * @protected
     */
    actionViewRelatedList(data) {
        let viewName =
            this.getMetadata().get(
                ['clientDefs', this.model.entityType, 'relationshipPanels', this.name, 'viewModalView']
            ) ||
            this.getMetadata().get(['clientDefs', this.scope, 'modalViews', 'relatedList']) ||
            this.viewModalView ||
            'views/modals/related-list';

        let scope = data.scope || this.scope;

        let filter = this.filter;

        if (this.relatedListFiltersDisabled) {
            filter = null;
        }

        let options = {
            model: this.model,
            panelName: this.panelName,
            link: this.link,
            scope: scope,
            defs: this.defs,
            title: data.title || this.title,
            filterList: this.filterList,
            filter: filter,
            layoutName: this.layoutName,
            defaultOrder: this.defaultOrder,
            defaultOrderBy: this.defaultOrderBy,
            url: data.url || this.url,
            listViewName: this.listViewName,
            createDisabled: !this.isCreateAvailable(scope),
            selectDisabled: !this.isSelectAvailable(scope),
            rowActionsView: this.rowActionsView,
            panelCollection: this.collection,
            filtersDisabled: this.relatedListFiltersDisabled,
        };

        if (data.viewOptions) {
            for (let item in data.viewOptions) {
                options[item] = data.viewOptions[item];
            }
        }

        Espo.Ui.notify(' ... ');

        this.createView('modalRelatedList', viewName, options, view => {
            Espo.Ui.notify(false);

            view.render();

            this.listenTo(view, 'action', (event, element) => {
                Espo.Utils.handleAction(this, event, element);
            });

            this.listenToOnce(view, 'close', () => {
                this.clearView('modalRelatedList');
            });
        });
    }

    /**
     * Is create available.
     *
     * @protected
     * @param {string} scope A scope (entity type).
     * @return {boolean};
     */
    isCreateAvailable(scope) {
        return !!this.defs.create;
    }

    // noinspection JSUnusedLocalSymbols
    /**
     * Is select available.
     *
     * @protected
     * @param {string} scope A scope (entity type).
     * @return {boolean};
     */
    isSelectAvailable(scope) {
        return !!this.defs.select;
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * A `view-related` action.
     *
     * @protected
     */
    actionViewRelated(data) {
        let id = data.id;
        let model = this.collection.get(id);

        if (!model) {
            return;
        }

        let scope = model.entityType;

        let helper = new RecordModal(this.getMetadata(), this.getAcl());

        helper
            .showDetail(this, {
                scope: scope,
                id: id,
                model: model,
            })
            .then(view => {
                this.listenTo(view, 'after:save', () => {
                    this.collection.fetch();
                });
            });
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * An `edit-related` action.
     *
     * @protected
     */
    actionEditRelated(data) {
        let id = data.id;
        let scope = this.collection.get(id).name;

        let viewName = this.getMetadata().get('clientDefs.' + scope + '.modalViews.edit') ||
            'views/modals/edit';

        Espo.Ui.notify(' ... ');

        this.createView('quickEdit', viewName, {
            scope: scope,
            id: id,
        }, (view) => {
            view.once('after:render', () => {
                Espo.Ui.notify(false);
            });

            view.render();

            view.once('after:save', () => {
                this.collection.fetch();
            });
        });
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * An `unlink-related` action.
     *
     * @protected
     */
    actionUnlinkRelated(data) {
        let id = data.id;

        this.confirm({
            message: this.translate('unlinkRecordConfirmation', 'messages'),
            confirmText: this.translate('Unlink'),
        }, () => {
            Espo.Ui.notify(' ... ');

            Espo.Ajax
                .deleteRequest(this.collection.url, {id: id})
                .then(() => {
                    Espo.Ui.success(this.translate('Unlinked'));

                    this.collection.fetch();

                    this.model.trigger('after:unrelate');
                    this.model.trigger('after:unrelate:' + this.link);
                });
        });
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * A `remove-related` action.
     *
     * @protected
     */
    actionRemoveRelated(data) {
        let id = data.id;

        this.confirm({
            message: this.translate('removeRecordConfirmation', 'messages'),
            confirmText: this.translate('Remove'),
        }, () => {
            let model = this.collection.get(id);

            Espo.Ui.notify(' ... ');

            model
                .destroy()
                .then(() => {
                    Espo.Ui.success(this.translate('Removed'));

                    this.collection.fetch();

                    this.model.trigger('after:unrelate');
                    this.model.trigger('after:unrelate:' + this.link);
                });
        });
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * An `unlink-all-related` action.
     *
     * @protected
     */
    actionUnlinkAllRelated(data) {
        this.confirm(this.translate('unlinkAllConfirmation', 'messages'), () => {
            Espo.Ui.notify(' ... ');

            Espo.Ajax
                .postRequest(this.model.entityType + '/action/unlinkAll', {
                    link: data.link,
                    id: this.model.id,
                })
                .then(() => {
                    Espo.Ui.success(this.translate('Unlinked'));

                    this.collection.fetch();

                    this.model.trigger('after:unrelate');
                    this.model.trigger('after:unrelate:' + this.link);
                });
        });
    }
}

export default RelationshipPanelView;

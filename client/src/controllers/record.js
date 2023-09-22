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

/** @module controllers/record */

import Controller from 'controller';

/**
 * A record controller.
 */
class RecordController extends Controller {

    /** @inheritDoc */
    defaultAction = 'list'

    constructor(params, injections) {
        super(params, injections);

        /**
         * @private
         * @type {Object}
         */
        this.collectionMap = {};
    }

    /** @inheritDoc */
    checkAccess(action) {
        if (this.getAcl().check(this.name, action)) {
            return true;
        }

        return false;
    }

    /**
     * Get a view name/path.
     *
     * @protected
     * @param {'list'|'detail'|'edit'|'create'|'listRelated'|string} type A type.
     * @returns {string}
     */
    getViewName(type) {
        return this.getMetadata().get(['clientDefs', this.name, 'views', type]) ||
            'views/' + Espo.Utils.camelCaseToHyphen(type);
    }

    // noinspection JSUnusedGlobalSymbols
    beforeList() {
        this.handleCheckAccess('read');
    }

    actionList(options) {
        let isReturn = options.isReturn || this.getRouter().backProcessed;

        let key = this.name + 'List';

        if (!isReturn && this.getStoredMainView(key)) {
            this.clearStoredMainView(key);
        }

        this.getCollection().then(collection => {
            const mediator = {};

            const abort = () => {
                collection.abortLastFetch();
                mediator.abort = true;

                Espo.Ui.notify(false);
            };

            this.listenToOnce(this.baseController, 'action', abort);
            this.listenToOnce(collection, 'sync', () => this.stopListening(this.baseController, 'action', abort));

            let viewOptions = {
                scope: this.name,
                collection: collection,
                params: options,
                mediator: mediator,
            };

            const viewName = this.getViewName('list');

            const params = {
                useStored: isReturn,
                key: key,
            };

            this.main(viewName, viewOptions, null, params);
        });
    }

    beforeView() {
        this.handleCheckAccess('read');
    }

    /**
     * @protected
     * @param {Object} options
     * @param {module:model} model
     * @param {string|null} [view]
     */
    createViewView(options, model, view) {
        view = view || this.getViewName('detail');

        this.main(view, {
            scope: this.name,
            model: model,
            returnUrl: options.returnUrl,
            returnDispatchParams: options.returnDispatchParams,
            params: options,
        });
    }

    /**
     * @protected
     * @param {module:model} model
     * @param {Object} options
     */
    prepareModelView(model, options) {}

    // noinspection JSUnusedGlobalSymbols
    /**
     * @param {{
     *     model?: module:model,
     *     id?: string,
     *     isReturn?: boolean,
     *     isAfterCreate?: boolean,
     * }} options
     */
    actionView(options) {
        let id = options.id;

        let isReturn = this.getRouter().backProcessed;

        if (isReturn) {
            if (this.lastViewActionOptions && this.lastViewActionOptions.id === id) {
                options = Espo.Utils.clone(this.lastViewActionOptions);

                if (options.model && options.model.get('deleted')) {
                    delete options.model;
                }
            }

            options.isReturn = true;
        }
        else {
            delete this.lastViewActionOptions;
        }

        this.lastViewActionOptions = options;

        const createView = model => {
            this.prepareModelView(model, options);

            this.createViewView.call(this, options, model);
        };

        if ('model' in options) {
            let model = options.model;

            createView(model);

            this.showLoadingNotification();

            model.fetch()
                .then(() => this.hideLoadingNotification())
                .catch(xhr => {
                    if (
                        xhr.status === 403 &&
                        options.isAfterCreate
                    ) {
                        this.hideLoadingNotification();
                        xhr.errorIsHandled = true;

                        model.trigger('fetch-forbidden');
                    }
                });

            this.listenToOnce(this.baseController, 'action', () => {
                model.abortLastFetch();
                this.hideLoadingNotification();
            });

            return;
        }

        this.getModel().then(model => {
            model.id = id;

            this.showLoadingNotification();

            model.fetch({main: true})
                .then(() => {
                    this.hideLoadingNotification();

                    if (model.get('deleted')) {
                        this.listenToOnce(model, 'after:restore-deleted', () => {
                            createView(model);
                        });

                        this.prepareModelView(model, options);
                        this.createViewView(options, model, 'views/deleted-detail');

                        return;
                    }

                    createView(model);
                });

            this.listenToOnce(this.baseController, 'action', () => {
                model.abortLastFetch();
            });
        });
    }

    // noinspection JSUnusedGlobalSymbols
    beforeCreate() {
        this.handleCheckAccess('create');
    }

    // noinspection JSUnusedLocalSymbols
    /**
     * @protected
     * @param {module:model} model
     * @param {Object} options
     */
    prepareModelCreate(model, options) {
        this.listenToOnce(model, 'before:save', () => {
            let key = this.name + 'List';

            let stored = this.getStoredMainView(key);

            if (!stored) {
                return;
            }

            if (!('storeViewAfterCreate' in stored) || !stored.storeViewAfterCreate) {
                this.clearStoredMainView(key);
            }
        });

        this.listenToOnce(model, 'after:save', () => {
            let key = this.name + 'List';

            let stored = this.getStoredMainView(key);

            if (!stored) {
                return;
            }

            if (!('storeViewAfterCreate' in stored) || !stored.storeViewAfterCreate) {
                return;
            }

            if (!('collection' in stored) || !stored.collection) {
                return;
            }

            this.listenToOnce(stored, 'after:render', () => stored.collection.fetch());
        });
    }

    create(options) {
        options = options || {};

        let optionsOptions = options.options || {};

        this.getModel().then(model => {
            if (options.relate) {
                model.setRelate(options.relate);
            }

            let o = {
                scope: this.name,
                model: model,
                returnUrl: options.returnUrl,
                returnDispatchParams: options.returnDispatchParams,
                params: options,
            };

            for (let k in optionsOptions) {
                o[k] = optionsOptions[k];
            }

            if (options.attributes) {
                model.set(options.attributes);
            }

            this.prepareModelCreate(model, options);

            this.main(this.getViewName('edit'), o);
        });
    }

    actionCreate(options) {
        this.create(options);
    }

    // noinspection JSUnusedGlobalSymbols
    beforeEdit() {
        this.handleCheckAccess('edit');
    }

    // noinspection JSUnusedLocalSymbols
    /**
     * @protected
     * @param {module:model} model
     * @param {Object} options
     */
    prepareModelEdit(model, options) {
        this.listenToOnce(model, 'before:save', () => {
            let key = this.name + 'List';

            let stored = this.getStoredMainView(key);

            if (!stored) {
                return;
            }

            if (!('storeViewAfterUpdate' in stored) || !stored.storeViewAfterUpdate) {
                this.clearStoredMainView(key);
            }
        });
    }

    actionEdit(options) {
        let id = options.id;

        let optionsOptions = options.options || {};

        this.getModel().then(model => {
            model.id = id;

            if (options.model) {
                model = options.model;
            }

            this.prepareModelEdit(model, options);

            this.showLoadingNotification();

            model
                .fetch({main: true})
                .then(() => {
                    this.hideLoadingNotification();

                    let o = {
                        scope: this.name,
                        model: model,
                        returnUrl: options.returnUrl,
                        returnDispatchParams: options.returnDispatchParams,
                        params: options,
                    };

                    for (let k in optionsOptions) {
                        o[k] = optionsOptions[k];
                    }

                    if (options.attributes) {
                        o.attributes = options.attributes;
                    }

                    this.main(this.getViewName('edit'), o);
                });

            this.listenToOnce(this.baseController, 'action', () => {
                model.abortLastFetch();
            });
        });
    }

    // noinspection JSUnusedGlobalSymbols
    beforeMerge() {
        this.handleCheckAccess('edit');
    }

    // noinspection JSUnusedGlobalSymbols
    actionMerge(options) {
        let ids = options.ids.split(',');

        this.getModel().then((model) => {
            let models = [];

            let proceed = () => {
                this.main('views/merge', {
                    models: models,
                    scope: this.name,
                    collection: options.collection
                });
            };

            let i = 0;

            ids.forEach(id => {
                let current = model.clone();

                current.id = id;
                models.push(current);

                this.listenToOnce(current, 'sync', () => {
                    i++;

                    if (i === ids.length) {
                        proceed();
                    }
                });

                current.fetch();
            });
        });
    }

    // noinspection JSUnusedGlobalSymbols
    actionRelated(options) {
        let id = options.id;
        let link = options.link;

        let viewName = this.getViewName('listRelated');

        let model;

        this.getModel()
            .then(m => {
                model = m;
                model.id = id;

                return model.fetch({main: true});
            })
            .then(() => {
                let foreignEntityType = model.getLinkParam(link, 'entity');

                if (!foreignEntityType) {
                    this.baseController.error404();

                    throw new Error(`Bad link '${link}'.`);
                }

                return this.collectionFactory.create(foreignEntityType);
            })
            .then(collection => {
                collection.url = model.entityType + '/' + id + '/' + link;

                this.main(viewName, {
                    scope: this.name,
                    model: model,
                    collection: collection,
                    link: link,
                });
            })
    }

    /**
     * Get a collection for the current controller.
     *
     * @protected
     * @param {boolean} [usePreviouslyFetched=false] Use a previously fetched. @todo Revise.
     * @return {Promise<module:collection>}
     */
    getCollection(usePreviouslyFetched) {
        if (!this.name) {
            throw new Error('No collection for unnamed controller');
        }

        let entityType = this.entityType || this.name;

        if (usePreviouslyFetched && entityType in this.collectionMap) {
            let collection = this.collectionMap[entityType];

            return Promise.resolve(collection);
        }

        return this.collectionFactory.create(entityType, collection => {
            this.collectionMap[entityType] = collection;

            this.listenTo(collection, 'sync', () => collection.isFetched = true);
        });
    }

    /**
     * Get a model for the current controller.
     *
     * @protected
     * @param {Function} [callback]
     * @param {Object} [context]
     * @return {Promise<module:model>}
     */
    getModel(callback, context) {
        context = context || this;

        if (!this.name) {
            throw new Error('No collection for unnamed controller');
        }

        let modelName = this.entityType || this.name;

        return this.modelFactory.create(modelName, model => {
            if (callback) {
                callback.call(context, model);
            }
        });
    }
}

export default RecordController;

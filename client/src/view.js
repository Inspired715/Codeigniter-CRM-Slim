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

/** @module view */

import {View as BullView} from 'bullbone';

/**
 * A base view. All views should extend this class.
 *
 * @see {@link https://docs.espocrm.com/development/view/}
 * @mixes Bull.Events
 */
class View extends BullView {

    /**
     * @callback module:view~actionHandlerCallback
     * @param {MouseEvent} event A DOM event.
     * @param {HTMLElement} element A target element.
     */

    /**
     * A model.
     *
     * @name model
     * @type {module:model|null}
     * @memberOf View.prototype
     * @public
     */

    /**
     * A collection.
     *
     * @name collection
     * @type {module:collection|null}
     * @memberOf View.prototype
     * @public
     */

    /**
     * A helper.
     *
     * @name _helper
     * @type {module:view-helper}
     * @memberOf View.prototype
     * @private
     */

    /**
     * Add a DOM click event handler for a target defined by `data-action="{name}"` attribute.
     *
     * @param {string} action An action name.
     * @param {module:view~actionHandlerCallback} handler A handler.
     */
    addActionHandler(action, handler) {
        const fullAction = `click [data-action="${action}"]`;

        this.events[fullAction] = e => {
            handler.call(this, e.originalEvent, e.currentTarget);
        };
    }

    /**
     * Escape a string.
     *
     * @param {string} string
     * @returns {string}
     */
    escapeString(string) {
        return Handlebars.Utils.escapeExpression(string);
    }

    /**
     * Show a notify-message.
     *
     * @deprecated Use `Espo.Ui.notify`.
     * @param {string|false} label
     * @param {string} [type]
     * @param {number} [timeout]
     * @param {string} [scope]
     */
    notify(label, type, timeout, scope) {
        if (!label) {
            Espo.Ui.notify(false);

            return;
        }

        scope = scope || null;
        timeout = timeout || 2000;

        if (!type) {
            timeout = void 0;
        }

        let text = this.getLanguage().translate(label, 'labels', scope);

        Espo.Ui.notify(text, type, timeout);
    }

    /**
     * Get a view-helper.
     *
     * @returns {module:view-helper}
     */
    getHelper() {
        return this._helper;
    }

    /**
     * Get a current user.
     *
     * @returns {module:models/user}
     */
    getUser() {
        return this._helper.user;
    }

    /**
     * Get the preferences.
     *
     * @returns {module:models/preferences}
     */
    getPreferences() {
        return this._helper.preferences;
    }

    /**
     * Get the config.
     *
     * @returns {module:models/settings}
     */
    getConfig() {
        return this._helper.settings;
    }

    /**
     * Get the ACL.
     *
     * @returns {module:acl-manager}
     */
    getAcl() {
        return this._helper.acl;
    }

    /**
     * Get the model factory.
     *
     * @returns {module:model-factory}
     */
    getModelFactory() {
        return this._helper.modelFactory;
    }

    /**
     * Get the collection factory.
     *
     * @returns {module:collection-factory}
     */
    getCollectionFactory() {
        return this._helper.collectionFactory;
    }

    /**
     * Get the router.
     *
     * @returns {module:router}
     */
    getRouter() {
        return this._helper.router;
    }

    /**
     * Get the storage-util.
     *
     * @returns {module:storage}
     */
    getStorage() {
        return this._helper.storage;
    }

    /**
     * Get the session-storage-util.
     *
     * @returns {module:session-storage}
     */
    getSessionStorage() {
        return this._helper.sessionStorage;
    }

    /**
     * Get the language-util.
     *
     * @returns {module:language}
     */
    getLanguage() {
        return this._helper.language;
    }

    /**
     * Get metadata.
     *
     * @returns {module:metadata}
     */
    getMetadata() {
        return this._helper.metadata;
    }

    /**
     * Get the cache-util.
     *
     * @returns {module:cache}
     */
    getCache() {
        return this._helper.cache;
    }

    /**
     * Get the date-time util.
     *
     * @returns {module:date-time}
     */
    getDateTime() {
        return this._helper.dateTime;
    }

    /**
     * Get the number-util.
     *
     * @returns {module:num-util}
     */
    getNumberUtil() {
        return this._helper.numberUtil;
    }

    /**
     * Get the field manager.
     *
     * @returns {module:field-manager}
     */
    getFieldManager() {
        return this._helper.fieldManager;
    }

    /**
     * Get the base-controller.
     *
     * @returns {module:controllers/base}
     */
    getBaseController() {
        return this._helper.baseController;
    }

    /**
     * Get the theme manager.
     *
     * @returns {module:theme-manager}
     */
    getThemeManager() {
        return this._helper.themeManager;
    }

    /**
     * Update a page title. Supposed to be overridden if needed.
     */
    updatePageTitle() {
        var title = this.getConfig().get('applicationName') || 'EspoCRM';

        this.setPageTitle(title);
    }

    /**
     * Set a page title.
     *
     * @param {string} title A title.
     */
    setPageTitle(title) {
        this.getHelper().pageTitle.setTitle(title);
    }

    /**
     * Translate a label.
     *
     * @param {string} label Label.
     * @param {string} [category] Category.
     * @param {string} [scope] Scope.
     * @returns {string}
     */
    translate(label, category, scope) {
        return this.getLanguage().translate(label, category, scope);
    }

    /**
     * Get a base path.
     *
     * @returns {string}
     */
    getBasePath() {
        return this._helper.basePath || '';
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * Ajax request.
     *
     * @deprecated Use `Espo.Ajax`.
     * @todo Remove in v9.0.
     * @param {string} url An URL.
     * @param {string} type A method.
     * @param {any} [data] Data.
     * @param {Object} [options] Options.
     * @returns {Promise<*>}
     */
    ajaxRequest(url, type, data, options) {
        return /** @type {Promise<*>} */ Espo.Ajax.request(url, type, data, options);
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * POST request.
     *
     * @deprecated Use `Espo.Ajax.postRequest`.
     * @todo Remove in v9.0.
     * @param {string} url An URL.
     * @param {any} [data] Data.
     * @param {Object} [options] Options.
     * @returns {Promise<any>}
     */
    ajaxPostRequest(url, data, options) {
        return Espo.Ajax.postRequest(url, data, options);
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * GET request.
     *
     * @deprecated Use `Espo.Ajax.getRequest`.
     * @todo Remove in v9.0.
     * @param {string} url An URL.
     * @param {any} [data] Data.
     * @param {Object} [options] Options.
     * @returns {Promise<any>}
     */
    ajaxGetRequest(url, data, options) {
        return Espo.Ajax.getRequest(url, data, options);
    }

    /**
     * @typedef {Object} module:view~ConfirmOptions
     *
     * @property {string} message A message.
     * @property {string} [confirmText] A confirm-button text.
     * @property {string} [cancelText] A cancel-button text.
     * @property {'danger'|'success'|'warning'|'default'} [confirmStyle='danger'] A confirm-button style.
     * @property {'static'|boolean} [backdrop=false] A backdrop.
     * @property {function():void} [cancelCallback] A cancel-callback.
     */

    /**
     * Show a confirmation dialog.
     *
     * @param {string|module:view~ConfirmOptions} o A message or options.
     * @param [callback] A callback. Deprecated, use a promise.
     * @param [context] A context. Deprecated.
     * @returns {Promise} To be resolved if confirmed.
     */
    confirm(o, callback, context) {
        let message;

        if (typeof o === 'string' || o instanceof String) {
            message = o;

            o = /** @type {module:view~ConfirmOptions} */{};
        }
        else {
            o = o || {};

            message = o.message;
        }

        if (message) {
            message = this.getHelper()
                .transformMarkdownText(message, {linksInNewTab: true})
                .toString();
        }

        let confirmText = o.confirmText || this.translate('Yes');
        let confirmStyle = o.confirmStyle || null;
        let cancelText = o.cancelText || this.translate('Cancel');

        return Espo.Ui.confirm(message, {
            confirmText: confirmText,
            cancelText: cancelText,
            confirmStyle: confirmStyle,
            backdrop: ('backdrop' in o) ? o.backdrop : true,
            isHtml: true,
        }, callback, context);
    }
}

export default View;

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

/** @module metadata */

import {Events} from 'bullbone';

/**
 * Application metadata.
 *
 * @mixes Bull.Events
 */
class Metadata {

    /**
     * Application metadata.
     *
     * @param {module:cache} [cache] A cache.
     */
    constructor(cache) {
        /**
         * @private
         * @type {module:cache|null}
         */
        this.cache = cache || null;

        /**
         * @private
         * @type {Object}
         */
        this.data = {};
    }

    /** @private */
    url = 'Metadata'

    /**
     * Load from cache or the backend (if not yet cached).
     *
     * @param {Function|null} [callback] Deprecated. Use a promise.
     * @param {boolean} [disableCache=false] Bypass cache.
     * @returns {Promise}
     */
    load(callback, disableCache) {
        this.off('sync');

        if (callback) {
            this.once('sync', callback);
        }

        if (!disableCache) {
            if (this.loadFromCache()) {
                this.trigger('sync');

                return new Promise(resolve => resolve());
            }
        }

        return new Promise(resolve => {
            this.fetch()
                .then(() => resolve());
        });
    }

    /**
     * Load from the server.
     *
     * @returns {Promise}
     */
    loadSkipCache() {
        return this.load(null, true);
    }

    /**
     * @private
     * @returns {Promise}
     */
    fetch() {
        return Espo.Ajax.getRequest(this.url)
            .then(data => {
                this.data = data;
                this.storeToCache();
                this.trigger('sync');
            });
    }

    /**
     * Get a value.
     *
     * @param {string[]|string} path A key path.
     * @param {*} [defaultValue] A value to return if not set.
     * @returns {*} Null if not set.
     */
    get(path, defaultValue) {
        defaultValue = defaultValue || null;

        let arr;

        if (Array && Array.isArray && Array.isArray(path)) {
            arr = path;
        }
        else {
            arr = path.split('.');
        }

        let pointer = this.data;
        let result = defaultValue;

        for (var i = 0; i < arr.length; i++) {
            let key = arr[i];

            if (!(key in pointer)) {
                result = defaultValue;

                break;
            }

            if (arr.length - 1 === i) {
                result = pointer[key];
            }

            pointer = pointer[key];
        }

        return result;
    }

    /**
     * @private
     * @returns {boolean|null} True if success.
     */
    loadFromCache() {
        if (this.cache) {
            let cached = this.cache.get('app', 'metadata');

            if (cached) {
                this.data = cached;

                return true;
            }
        }

        return null;
    }

    /** @private */
    storeToCache() {
        if (this.cache) {
            this.cache.set('app', 'metadata', this.data);
        }
    }

    /**
     * Clear cache.
     */
    clearCache() {
        if (!this.cache) {
            return;
        }

        this.cache.clear('app', 'metadata');
    }

    /**
     * Get a scope list.
     *
     * @returns {string[]}
     */
    getScopeList () {
        let scopes = this.get('scopes') || {};
        let scopeList = [];

        for (let scope in scopes) {
            let d = scopes[scope];

            if (d.disabled) {
                continue;
            }

            scopeList.push(scope);
        }

        return scopeList;
    }

    /**
     * Get an object-scope list. An object-scope represents a business entity.
     *
     * @returns {string[]}
     */
    getScopeObjectList () {
        let scopes = this.get('scopes') || {};
        let scopeList = [];

        for (let scope in scopes) {
            let d = scopes[scope];

            if (d.disabled) {
                continue;
            }

            if (!d.object) {
                continue;
            }

            scopeList.push(scope);
        }

        return scopeList;
    }

    /**
     * Get an entity-scope list. Scopes that represents entities.
     *
     * @returns {string[]}
     */
    getScopeEntityList () {
        let scopes = this.get('scopes') || {};
        let scopeList = [];

        for (let scope in scopes) {
            let d = scopes[scope];

            if (d.disabled) {
                continue;
            }

            if (!d.entity) {
                continue;
            }

            scopeList.push(scope);
        }

        return scopeList;
    }
}

Object.assign(Metadata.prototype, Events);

export default Metadata;

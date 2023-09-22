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

/** @module ajax */

import $ from 'jquery';

let isConfigured = false;
/** @type {number} */
let defaultTimeout;
/** @type {string} */
let apiUrl;
/** @type {Espo.Ajax~Handler} */
let beforeSend;
/** @type {Espo.Ajax~Handler} */
let onSuccess;
/** @type {Espo.Ajax~Handler} */
let onError;
/** @type {Espo.Ajax~Handler} */
let onTimeout;

/**
 * @callback Espo.Ajax~Handler
 * @param {XMLHttpRequest} [xhr]
 * @param {Object.<string, *>} [options]
 */

/**
 * Options.
 *
 * @typedef {Object} Espo.Ajax~Options
 *
 * @property {Number} [timeout] A timeout.
 * @property {Object.<string, string>} [headers] A request headers.
 * @property {'json'|'text'} [dataType] A data type.
 * @property {string} [contentType] A content type.
 * @property {boolean} [resolveWithXhr] To resolve with `XMLHttpRequest`.
 */

const baseUrl = window.location.origin + window.location.pathname;

// noinspection JSUnusedGlobalSymbols
/**
 * Functions for API HTTP requests.
 */
const Ajax = Espo.Ajax = {

    /**
     * Request.
     *
     * @param {string} url An URL.
     * @param {'GET'|'POST'|'PUT'|'DELETE'|'PATCH'|'OPTIONS'} method An HTTP method.
     * @param {*} [data] Data.
     * @param {Espo.Ajax~Options & Object.<string, *>} [options] Options.
     * @returns {AjaxPromise<any, XMLHttpRequest>}
     */
    request: function (url, method, data, options) {
        options = options || {};

        let timeout = 'timeout' in options ? options.timeout : defaultTimeout;
        let contentType = options.contentType || 'application/json';
        let body;

        if (options.data && !data) {
            data = options.data;
        }

        if (apiUrl) {
            url = Espo.Utils.trimSlash(apiUrl) + '/' + url;
        }

        if (!['GET', 'OPTIONS'].includes(method) && data) {
            body = data;

            if (contentType === 'application/json' && typeof data !== 'string') {
                body = JSON.stringify(data);
            }
        }

        if (method === 'GET' && data) {
            let part = $.param(data);

            url.includes('?') ?
                url += '&' :
                url += '?';

            url += part;
        }

        let urlObj = new URL(baseUrl + url);

        let xhr = new Xhr();
        xhr.timeout = timeout;
        xhr.open(method, urlObj);
        xhr.setRequestHeader('Content-Type', contentType);

        if (options.headers) {
            for (let key in options.headers) {
                xhr.setRequestHeader(key, options.headers[key]);
            }
        }

        if (beforeSend) {
            beforeSend(xhr, options);
        }

        let promiseWrapper = {};

        let promise = new AjaxPromise((resolve, reject) => {
            const onErrorGeneral = (isTimeout) => {
                if (options.error) {
                    options.error(xhr, options);
                }

                reject(xhr, options);

                if (isTimeout) {
                    if (onTimeout) {
                        onTimeout(xhr, options);
                    }

                    return;
                }

                if (onError) {
                    onError(xhr, options);
                }
            };

            xhr.ontimeout = () => onErrorGeneral(true);
            xhr.onerror = () => onErrorGeneral();

            xhr.onload = () => {
                if (xhr.status >= 400) {
                    onErrorGeneral();

                    return;
                }

                let response = xhr.responseText;

                if ((options.dataType || 'json') === 'json') {
                    try {
                        response = JSON.parse(xhr.responseText);
                    }
                    catch (e) {
                        console.error('Could not parse API response.');

                        onErrorGeneral();
                    }
                }

                if (options.success) {
                    options.success(response);
                }

                onSuccess(xhr, options);

                if (options.resolveWithXhr) {
                    response = xhr;
                }

                resolve(response)
            }

            xhr.send(body);

            if (promiseWrapper.promise) {
                promiseWrapper.promise.xhr = xhr;

                return;
            }

            promiseWrapper.xhr = xhr;
        });

        promiseWrapper.promise = promise;
        promise.xhr = promise.xhr || promiseWrapper.xhr;

        return promise;
    },

    /**
     * POST request.
     *
     * @param {string} url An URL.
     * @param {*} [data] Data.
     * @param {Espo.Ajax~Options & Object.<string, *>} [options] Options.
     * @returns {Promise<any, XMLHttpRequest>}
     */
    postRequest: function (url, data, options) {
        if (data) {
            data = JSON.stringify(data);
        }

        return /** @type {Promise<any>} */ Ajax.request(url, 'POST', data, options);
    },

    /**
     * PATCH request.
     *
     * @param {string} url An URL.
     * @param {*} [data] Data.
     * @param {Espo.Ajax~Options & Object.<string, *>} [options] Options.
     * @returns {Promise<any, XMLHttpRequest>}
     */
    patchRequest: function (url, data, options) {
        if (data) {
            data = JSON.stringify(data);
        }

        return /** @type {Promise<any>} */ Ajax.request(url, 'PATCH', data, options);
    },

    /**
     * PUT request.
     *
     * @param {string} url An URL.
     * @param {*} [data] Data.
     * @param {Espo.Ajax~Options & Object.<string, *>} [options] Options.
     * @returns {Promise<any, XMLHttpRequest>}
     */
    putRequest: function (url, data, options) {
        if (data) {
            data = JSON.stringify(data);
        }

        return /** @type {Promise<any>} */ Ajax.request(url, 'PUT', data, options);
    },

    /**
     * DELETE request.
     *
     * @param {string} url An URL.
     * @param {*} [data] Data.
     * @param {Espo.Ajax~Options & Object.<string, *>} [options] Options.
     * @returns {Promise<any, XMLHttpRequest>}
     */
    deleteRequest: function (url, data, options) {
        if (data) {
            data = JSON.stringify(data);
        }

        return /** @type {Promise<any>} */ Ajax.request(url, 'DELETE', data, options);
    },

    /**
     * GET request.
     *
     * @param {string} url An URL.
     * @param {*} [data] Data.
     * @param {Espo.Ajax~Options & Object.<string, *>} [options] Options.
     * @returns {Promise<any, XMLHttpRequest>}
     */
    getRequest: function (url, data, options) {
        return /** @type {Promise<any>} */ Ajax.request(url, 'GET', data, options);
    },

    /**
     * @internal
     * @param {{
     *     apiUrl: string,
     *     timeout: number,
     *     beforeSend: Espo.Ajax~Handler,
     *     onSuccess: Espo.Ajax~Handler,
     *     onError: Espo.Ajax~Handler,
     *     onTimeout: Espo.Ajax~Handler,
     * }} options Options.
     */
    configure: function (options) {
        if (isConfigured) {
            throw new Error("Ajax is already configured.");
        }

        apiUrl = options.apiUrl;
        defaultTimeout = options.timeout;
        beforeSend = options.beforeSend;
        onSuccess = options.onSuccess;
        onError = options.onError;
        onTimeout = options.onTimeout;

        isConfigured = true;
    },
};

/**
 * @memberOf module:ajax
 */
class AjaxPromise extends Promise {

    /**
     * @type {XMLHttpRequest|null}
     * @internal
     */
    xhr = null

    isAborted = false

    /**
     * @deprecated Use `catch`.
     * @todo Remove in v9.0.
     */
    fail(...args) {
        return this.catch(args[0]);
    }
    /**
     * @deprecated Use `then`
     * @todo Remove in v9.0.
     */
    done(...args) {
        return this.then(args[0]);
    }

    /**
     * Abort the request.
     */
    abort() {
        this.isAborted = true;

        if (this.xhr) {
            this.xhr.abort();
        }
    }

    /**
     * Get a ready state.
     *
     * @return {Number}
     */
    getReadyState() {
        if (!this.xhr) {
            return 0;
        }

        return this.xhr.readyState || 0;
    }

    /**
     * Get a status code
     *
     * @return {Number}
     */
    getStatus() {
        if (!this.xhr) {
            return 0;
        }

        return this.xhr.status;
    }
}

/**
 * @name module:ajax.Xhr
 */
class Xhr extends XMLHttpRequest {
    /**
     * To be set in an error handler to bypass default handling.
     */
    errorIsHandled = false
}

export default Ajax;

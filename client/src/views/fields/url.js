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

/** @module views/fields/url */

import VarcharFieldView from 'views/fields/varchar';

class UrlFieldView extends VarcharFieldView {

    type = 'url'

    listTemplate = 'fields/url/list'
    detailTemplate = 'fields/url/detail'
    defaultProtocol = 'https:'

    validations = [
        'required',
        'valid',
        'maxLength',
    ]

    noSpellCheck = true

    DEFAULT_MAX_LENGTH =255

    data() {
        let data = super.data();

        data.url = this.getUrl();

        return data;
    }

    afterRender() {
        super.afterRender();

        if (this.isEditMode()) {
            this.$element.on('change', () => {
                let value = this.$element.val() || '';

                let parsedValue = this.parse(value);

                if (parsedValue === value) {
                    return;
                }

                let decoded = parsedValue ? decodeURI(parsedValue) : '';

                this.$element.val(decoded);
            });
        }
    }

    getValueForDisplay() {
        let value = this.model.get(this.name);

        return value ? decodeURI(value) : null;
    }

    /**
     * @param {string} value
     * @return {string}
     */
    parse(value) {
        value = value.trim();

        if (this.params.strip) {
            value = this.strip(value);
        }

        if (value === decodeURI(value)) {
            value = encodeURI(value);
        }

        return value;
    }

    /**
     * @param {string} value
     * @return {string}
     */
    strip(value) {
        if (value.indexOf('//') !== -1) {
            value = value.substr(value.indexOf('//') + 2);
        }

        value = value.replace(/\/+$/, '');

        return value;
    }

    getUrl() {
        let url = this.model.get(this.name);

        if (url && url !== '') {
            if (url.indexOf('//') === -1) {
                url = this.defaultProtocol + '//' + url;
            }

            return url;
        }

        return url;
    }

    validateValid() {
        let value = this.model.get(this.name);

        if (!value) {
            return false;
        }

        /** @var {string} */
        let pattern = this.getMetadata().get(['app', 'regExpPatterns', 'uriOptionalProtocol', 'pattern']);

        let regExp = new RegExp('^' + pattern + '$');

        if (regExp.test(value)) {
            return false;
        }

        let msg = this.translate('fieldInvalid', 'messages')
            .replace('{field}', this.translate(this.name, 'fields', this.entityType));

        this.showValidationMessage(msg);

        return true;
    }

    validateMaxLength() {
        let maxLength = this.params.maxLength || this.DEFAULT_MAX_LENGTH;

        let value = this.model.get(this.name);

        if (!value || !value.length) {
            return false;
        }

        if (value.length <= maxLength) {
            return false;
        }

        let msg = this.translate('fieldUrlExceedsMaxLength', 'messages')
            .replace('{maxLength}', maxLength)
            .replace('{field}', this.translate(this.name, 'fields', this.entityType));

        this.showValidationMessage(msg);

        return true;
    }

    fetch() {
        let data = super.fetch();

        let value = data[this.name];

        if (!value) {
            return data;
        }

        data[this.name] = this.parse(value);

        return data;
    }
}

export default UrlFieldView;

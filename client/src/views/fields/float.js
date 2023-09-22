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

/** @module views/fields/float */

import IntFieldView from 'views/fields/int';

/**
 * A float field.
 */
class FloatFieldView extends IntFieldView {

    type = 'float'

    editTemplate = 'fields/float/edit'

    decimalMark = '.'
    validations = ['required', 'float', 'range']
    decimalPlacesRawValue = 10

    /** @inheritDoc */
    setup() {
        super.setup();

        if (this.getPreferences().has('decimalMark')) {
            this.decimalMark = this.getPreferences().get('decimalMark');
        }
        else if (this.getConfig().has('decimalMark')) {
            this.decimalMark = this.getConfig().get('decimalMark');
        }

        if (!this.decimalMark) {
            this.decimalMark = '.';
        }

        if (this.decimalMark === this.thousandSeparator) {
            this.thousandSeparator = '';
        }
    }

    /** @inheritDoc */
    setupAutoNumericOptions() {
        this.autoNumericOptions = {
            digitGroupSeparator: this.thousandSeparator || '',
            decimalCharacter: this.decimalMark,
            modifyValueOnWheel: false,
            selectOnFocus: false,
            decimalPlaces: this.decimalPlacesRawValue,
            decimalPlacesRawValue: this.decimalPlacesRawValue,
            allowDecimalPadding: false,
            showWarnings: false,
            formulaMode: true,
        };
    }

    getValueForDisplay() {
        let value = isNaN(this.model.get(this.name)) ? null : this.model.get(this.name);

        return this.formatNumber(value);
    }

    formatNumber(value) {
        if (this.disableFormatting) {
            return value;
        }

        return this.formatNumberDetail(value);
    }

    formatNumberDetail(value) {
        if (value === null) {
            return '';
        }

        let decimalPlaces = this.params.decimalPlaces;

        if (decimalPlaces === 0) {
            value = Math.round(value);
        }
        else if (decimalPlaces) {
            value = Math.round(
                 value * Math.pow(10, decimalPlaces)) / (Math.pow(10, decimalPlaces)
            );
        }

        let parts = value.toString().split(".");

        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, this.thousandSeparator);

        if (decimalPlaces === 0) {
            return parts[0];
        }
        else if (decimalPlaces) {
            var decimalPartLength = 0;

            if (parts.length > 1) {
                decimalPartLength = parts[1].length;
            } else {
                parts[1] = '';
            }

            if (decimalPlaces && decimalPartLength < decimalPlaces) {
                var limit = decimalPlaces - decimalPartLength;

                for (var i = 0; i < limit; i++) {
                    parts[1] += '0';
                }
            }
        }

        return parts.join(this.decimalMark);
    }

    setupMaxLength() {}

    validateFloat() {
        let value = this.model.get(this.name);

        if (isNaN(value)) {
            let msg = this.translate('fieldShouldBeFloat', 'messages')
                .replace('{field}', this.getLabelText());

            this.showValidationMessage(msg);

            return true;
        }
    }

    parse(value) {
        value = (value !== '') ? value : null;

        if (value === null) {
            return null;
        }

        value = value
            .split(this.thousandSeparator)
            .join('')
            .split(this.decimalMark)
            .join('.');

        return parseFloat(value);
    }

    fetch() {
        let value = this.$element.val();
        value = this.parse(value);

        let data = {};
        data[this.name] = value;

        return data;
    }
}

export default FloatFieldView;

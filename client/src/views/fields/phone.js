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

import VarcharFieldView from 'views/fields/varchar';
import Select from 'ui/select';

class PhoneFieldView extends VarcharFieldView {

    type = 'phone'

    editTemplate = 'fields/phone/edit'
    detailTemplate = 'fields/phone/detail'
    listTemplate = 'fields/phone/list'

    validations = ['required', 'phoneData']

    events = {
        /** @this PhoneFieldView */
        'click [data-action="switchPhoneProperty"]': function (e) {
            let $target = $(e.currentTarget);
            let $block = $(e.currentTarget).closest('div.phone-number-block');
            let property = $target.data('property-type');

            if (property === 'primary') {
                if (!$target.hasClass('active')) {
                    if ($block.find('input.phone-number').val() !== '') {
                        this.$el.find('button.phone-property[data-property-type="primary"]')
                            .removeClass('active').children().addClass('text-muted');

                        $target.addClass('active').children().removeClass('text-muted');
                    }
                }
            }
            else {
                if ($target.hasClass('active')) {
                    $target.removeClass('active').children().addClass('text-muted');
                } else {
                    $target.addClass('active').children().removeClass('text-muted');
                }
            }

            this.trigger('change');
        },
        /** @this PhoneFieldView */
        'click [data-action="removePhoneNumber"]': function (e) {
            let $block = $(e.currentTarget).closest('div.phone-number-block');

            this.removePhoneNumber($block);

            this.trigger('change');

            let $last = this.$el.find('.phone-number').last();

            if ($last.length) {
                $last[0].focus({preventScroll: true});
            }
        },
        /** @this PhoneFieldView */
        'change input.phone-number': function (e) {
            let $input = $(e.currentTarget);
            let $block = $input.closest('div.phone-number-block');

            if (this._itemJustRemoved) {
                return;
            }

            if ($input.val() === '' && $block.length) {
                this.removePhoneNumber($block);
            }
            else {
                this.trigger('change');
            }

            this.manageAddButton();
        },
        /** @this PhoneFieldView */
        'keypress input.phone-number': function () {
            this.manageAddButton();
        },
        /** @this PhoneFieldView */
        'paste input.phone-number': function () {
            setTimeout(() => this.manageAddButton(), 10);
        },
        /** @this PhoneFieldView */
        'click [data-action="addPhoneNumber"]': function () {
            this.addPhoneNumber();
        },
        /** @this PhoneFieldView */
        'keydown input.phone-number': function (e) {
            let key = Espo.Utils.getKeyFromKeyEvent(e);

            let $target = $(e.currentTarget);

            if (key === 'Enter') {
                if (!this.$el.find('[data-action="addPhoneNumber"]').hasClass('disabled')) {
                    this.addPhoneNumber();

                    e.stopPropagation();
                }

                return;
            }

            if (key === 'Backspace' && $target.val() === '') {
                let $block = $target.closest('div.phone-number-block');

                this._itemJustRemoved = true;
                setTimeout(() => this._itemJustRemoved = false, 100);

                e.stopPropagation();

                this.removePhoneNumber($block);

                setTimeout(() => this.focusOnLast(true), 50);
            }
        },
    }

    validateRequired() {
        if (!this.isRequired()) {
            return;
        }

        if (!this.model.get(this.name)) {
            let msg = this.translate('fieldIsRequired', 'messages')
                .replace('{field}', this.getLabelText());

            this.showValidationMessage(msg, 'div.phone-number-block:nth-child(1) input.phone-number');

            return true;
        }
    }

    // noinspection JSUnusedGlobalSymbols
    validatePhoneData() {
        let data = this.model.get(this.dataFieldName);

        if (!data || !data.length) {
            return;
        }

        /** @var {string} */
        let pattern = '^' + this.getMetadata().get(['app', 'regExpPatterns', 'phoneNumberLoose', 'pattern']) + '$';
        let regExp = new RegExp(pattern);

        let numberList = [];
        let notValid = false;

        data.forEach((row, i) => {
            let number = row.phoneNumber;

            if (!regExp.test(number)) {
                notValid = true;

                let msg = this.translate('fieldPhoneInvalidCharacters', 'messages')
                    .replace('{field}', this.getLabelText());

                this.showValidationMessage(msg, 'div.phone-number-block:nth-child(' + (i + 1)
                    .toString() + ') input.phone-number');
            }

            let numberClean = String(number).replace(/[\s+]/g, '');

            if (~numberList.indexOf(numberClean)) {
                let msg = this.translate('fieldValueDuplicate', 'messages')
                    .replace('{field}', this.getLabelText());

                this.showValidationMessage(msg, 'div.phone-number-block:nth-child(' + (i + 1)
                    .toString() + ') input.phone-number');

                notValid = true;

                return;
            }

            numberList.push(numberClean);
        });

        if (notValid) {
            return true;
        }
    }

    data() {
        let phoneNumberData;

        if (this.mode === this.MODE_EDIT) {
            phoneNumberData = Espo.Utils.cloneDeep(this.model.get(this.dataFieldName));

            if (this.model.isNew() || !this.model.get(this.name)) {
                if (!phoneNumberData || !phoneNumberData.length) {
                    let optOut;

                    if (this.model.isNew()) {
                        optOut = this.phoneNumberOptedOutByDefault && this.model.entityType !== 'User';
                    } else {
                        optOut = this.model.get(this.isOptedOutFieldName)
                    }

                    phoneNumberData = [{
                        phoneNumber: this.model.get(this.name) || '',
                        primary: true,
                        type: this.defaultType,
                        optOut: optOut,
                        invalid: false,
                    }];
                }
            }
        } else {
            phoneNumberData = this.model.get(this.dataFieldName) || false;
        }

        if (phoneNumberData) {
            phoneNumberData = Espo.Utils.cloneDeep(phoneNumberData);

            phoneNumberData.forEach((item) => {
                let number = item.phoneNumber || '';

                item.erased = number.indexOf(this.erasedPlaceholder) === 0;

                if (!item.erased) {
                    item.valueForLink = number.replace(/ /g, '');
                }

                item.lineThrough = item.optOut || item.invalid || this.model.get('doNotCall');
            });
        }

        if ((!phoneNumberData || phoneNumberData.length === 0) && this.model.get(this.name)) {
            let number = this.model.get(this.name);

            let o = {
                phoneNumber: number,
                primary: true,
                valueForLink: number.replace(/ /g, ''),
            };

            if (this.mode === 'edit' && this.model.isNew()) {
                o.type = this.defaultType;
            }

            phoneNumberData = [o];
        }

        let data = {
            ...super.data(),
            phoneNumberData: phoneNumberData,
            doNotCall: this.model.get('doNotCall'),
            lineThrough: this.model.get('doNotCall') || this.model.get(this.isOptedOutFieldName),
        };

        if (this.isReadMode()) {
            data.isOptedOut = this.model.get(this.isOptedOutFieldName);
            data.isInvalid = this.model.get(this.isInvalidFieldName);

            if (this.model.get(this.name)) {
                data.isErased = this.model.get(this.name).indexOf(this.erasedPlaceholder) === 0;

                if (!data.isErased) {
                    data.valueForLink = this.model.get(this.name).replace(/ /g, '');
                }
            }

            data.valueIsSet = this.model.has(this.name);
        }

        data.itemMaxLength = this.itemMaxLength;

        return data;
    }

    focusOnLast(cursorAtEnd) {
        let $item = this.$el.find('input.form-control').last();

        $item.focus();

        if (cursorAtEnd && $item[0]) {
            $item[0].setSelectionRange($item[0].value.length, $item[0].value.length);
        }
    }

    removePhoneNumber($block) {
        if ($block.parent().children().length === 1) {
            $block.find('input.phone-number').val('');
        } else {
            this.removePhoneNumberBlock($block);
        }

        this.trigger('change');
    }

    addPhoneNumber() {
        let data = Espo.Utils.cloneDeep(this.fetchPhoneNumberData());

        let o = {
            phoneNumber: '',
            primary: !data.length,
            type: false,
            optOut: this.emailAddressOptedOutByDefault,
            invalid: false,
        };

        data.push(o);

        this.model.set(this.dataFieldName, data, {silent: true});

        this.reRender()
            .then(() => this.focusOnLast());
    }

    afterRender() {
        super.afterRender();

        this.manageButtonsVisibility();
        this.manageAddButton();

        if (this.mode === this.MODE_EDIT) {
            this.$el.find('select').toArray().forEach(selectElement => {
                Select.init($(selectElement));
            });
        }
    }

    removePhoneNumberBlock($block) {
        let changePrimary = false;

        if ($block.find('button[data-property-type="primary"]').hasClass('active')) {
            changePrimary = true;
        }

        $block.remove();

        if (changePrimary) {
            this.$el.find('button[data-property-type="primary"]')
                .first()
                .addClass('active')
                .children()
                .removeClass('text-muted');
        }

        this.manageButtonsVisibility();
        this.manageAddButton();
    }

    manageAddButton() {
        let $input = this.$el.find('input.phone-number');
        let c = 0;

        $input.each((i, input) => {
            if (input.value !== '') {
                c++;
            }
        });

        if (c === $input.length) {
            this.$el.find('[data-action="addPhoneNumber"]')
                .removeClass('disabled')
                .removeAttr('disabled');

            return;
        }

        this.$el.find('[data-action="addPhoneNumber"]')
            .addClass('disabled')
            .attr('disabled', 'disabled');
    }

    manageButtonsVisibility() {
        let $primary = this.$el.find('button[data-property-type="primary"]');
        let $remove = this.$el.find('button[data-action="removePhoneNumber"]');
        let $container = this.$el.find('.phone-number-block-container');

        if ($primary.length > 1) {
            $primary.removeClass('hidden');
            $remove.removeClass('hidden');
            $container.addClass('many')

            return;
        }

        $container.removeClass('many')
        $primary.addClass('hidden');
        $remove.addClass('hidden');
    }

    setup() {
        this.dataFieldName = this.name + 'Data';
        this.defaultType = this.defaultType ||
            this.getMetadata()
                .get('entityDefs.' + this.model.entityType + '.fields.' + this.name + '.defaultType');

        this.isOptedOutFieldName = this.name + 'IsOptedOut';
        this.isInvalidFieldName = this.name + 'IsInvalid';

        this.phoneNumberOptedOutByDefault = this.getConfig().get('phoneNumberIsOptedOutByDefault');

        if (this.model.has('doNotCall')) {
            this.listenTo(this.model, 'change:doNotCall', (model, value, o) => {
                if (this.mode !== 'detail' && this.mode !== 'list') {
                    return;
                }

                if (!o.ui) {
                    return;
                }

                this.reRender();
            });
        }

        this.erasedPlaceholder = 'ERASED:';

        this.itemMaxLength = this.getMetadata()
            .get(['entityDefs', 'PhoneNumber', 'fields', 'name', 'maxLength']);
    }

    fetchPhoneNumberData() {
        let data = [];

        let $list = this.$el.find('div.phone-number-block');

        if ($list.length) {
            $list.each((i, d) => {
                let row = {};
                let $d = $(d);

                row.phoneNumber = $d.find('input.phone-number').val().trim();

                if (row.phoneNumber === '') {
                    return;
                }

                row.primary = $d.find('button[data-property-type="primary"]').hasClass('active');
                row.type = $d.find('select[data-property-type="type"]').val();
                row.optOut = $d.find('button[data-property-type="optOut"]').hasClass('active');
                row.invalid = $d.find('button[data-property-type="invalid"]').hasClass('active');

                data.push(row);
            });
        }

        return data;
    }

    fetch() {
        let data = {};

        let addressData = this.fetchPhoneNumberData() || [];

        data[this.dataFieldName] = addressData;
        data[this.name] = null;
        data[this.isOptedOutFieldName] = false;
        data[this.isInvalidFieldName] = false;

        let primaryIndex = 0;

        addressData.forEach((item, i) => {
            if (item.primary) {
                primaryIndex = i;

                if (item.optOut) {
                    data[this.isOptedOutFieldName] = true;
                }

                if (item.invalid) {
                    data[this.isInvalidFieldName] = true;
                }
            }
        });

        if (addressData.length && primaryIndex > 0) {
            let t = addressData[0];

            addressData[0] = addressData[primaryIndex];
            addressData[primaryIndex] = t;
        }

        if (addressData.length) {
            data[this.name] = addressData[0].phoneNumber;
        } else {
            data[this.isOptedOutFieldName] = null;
            data[this.isInvalidFieldName] = null;
        }

        return data;
    }
}

export default PhoneFieldView;

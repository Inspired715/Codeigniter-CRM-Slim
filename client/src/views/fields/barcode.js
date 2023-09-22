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

let JsBarcode;
let QRCode;

class BarcodeFieldView extends VarcharFieldView {

    type = 'barcode'

    listTemplate = 'fields/barcode/detail'
    detailTemplate = 'fields/barcode/detail'

    setup() {
        let maxLength = 255;

        // noinspection SpellCheckingInspection
        switch (this.params.codeType) {
            case 'EAN2':
                maxLength = 2; break;
            case 'EAN5':
                maxLength = 5; break;
            case 'EAN8':
                maxLength = 8; break;
            case 'EAN13':
                maxLength = 13; break;
            case 'UPC':
                maxLength = 12; break;
            case 'UPCE':
                maxLength = 11; break;
            case 'ITF14':
                maxLength = 14; break;
            case 'pharmacode':
                maxLength = 6; break;
        }

        this.params.maxLength = maxLength;

        // noinspection SpellCheckingInspection
        if (this.params.codeType !== 'QRcode') {
            this.isSvg = true;

            this.wait(
                Espo.loader.requirePromise('lib!jsbarcode')
                    .then(lib => JsBarcode = lib)
            );
        }
        else {
            this.wait(
                Espo.loader.requirePromise('lib!qrcodejs')
                    .then(lib => QRCode = lib)
            );
        }

        super.setup();

        $(window).on('resize.' + this.cid, () => {
            if (!this.isRendered()) {
                return;
            }

            this.controlWidth();
        });

        this.listenTo(this.recordHelper, 'panel-show', () => this.controlWidth());
    }

    data() {
        let data = super.data();

        data.isSvg = this.isSvg;

        return data;
    }

    onRemove() {
        $(window).off('resize.' + this.cid);
    }

    afterRender() {
        super.afterRender();

        if (this.isListMode() || this.isDetailMode) {
            let value = this.model.get(this.name);

            if (value) {
                // noinspection SpellCheckingInspection
                if (this.params.codeType === 'QRcode') {
                    this.initQrcode(value);
                }
                else {
                    let $barcode = $(this.getSelector() + ' .barcode');

                    if ($barcode.length) {
                        this.initBarcode(value);
                    }
                    else {
                        // SVG may be not available yet (in webkit).
                        setTimeout(() => {
                            this.initBarcode(value);
                            this.controlWidth();
                        }, 100);
                    }

                }
            }

            this.controlWidth();
        }
    }

    initQrcode(value) {
        let size = 128;

        if (value.length > 192) {
            size *= 2;
        }

        if (this.isListMode()) {
            size = 64;
        }

        let containerWidth = this.$el.width() ;

        if (containerWidth < size && containerWidth) {
            size = containerWidth;
        }

        let $barcode = this.$el.find('.barcode');

        let init = (level) => {
            let options = {
                text: value,
                width: size,
                height: size,
                colorDark : '#000000',
                colorLight : '#ffffff',
                correctLevel : level || QRCode.CorrectLevel.H,
            };

            new QRCode($barcode.get(0), options);
        };

        try {
            init();
        }
        catch (e) {
            try {
                $barcode.empty();

                init(QRCode.CorrectLevel.L);
            }
            catch (e) {
                console.error(this.name + ': ' + e.message);
            }
        }
    }

    initBarcode(value) {
        JsBarcode(this.getSelector() + ' .barcode', value, {
            format: this.params.codeType,
            height: 50,
            fontSize: 14,
            margin: 0,
            lastChar: this.params.lastChar,
        });
    }

    controlWidth() {
        this.$el.find('.barcode').css('max-width', this.$el.width() + 'px');
    }
}

export default BarcodeFieldView;

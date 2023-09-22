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
 ************************************************************************/

import BaseFieldView from 'views/fields/base';

class MapFieldView extends BaseFieldView {

    type = 'map'

    detailTemplate = 'fields/map/detail'
    listTemplate = 'fields/map/detail'

    addressField = null
    provider = null
    height = 300

    // noinspection JSCheckFunctionSignatures
    data() {
        const data = super.data();

        data.hasAddress = this.hasAddress();

        // noinspection JSValidateTypes
        return data;
    }

    setup() {
        this.addressField = this.name.slice(0, this.name.length - 3);

        this.provider = this.options.provider || this.params.provider;
        this.height = this.options.height || this.params.height || this.height;

        const addressAttributeList = Object.keys(this.getMetadata().get('fields.address.fields') || {})
            .map(a => this.addressField + Espo.Utils.upperCaseFirst(a));

        this.listenTo(this.model, 'sync', model => {
            let isChanged = false;

            addressAttributeList.forEach(attribute => {
                if (model.hasChanged(attribute)) {
                    isChanged = true;
                }
            });

            if (isChanged && this.isRendered()) {
                this.reRender();
            }
        });

        this.listenTo(this.model, 'after:save', () => {
            if (this.isRendered()) {
                this.reRender();
            }
        });
    }

    hasAddress() {
        return !!this.model.get(this.addressField + 'City') ||
            !!this.model.get(this.addressField + 'PostalCode');
    }

    onRemove() {
        $(window).off('resize.' + this.cid);
    }

    afterRender() {
        this.addressData = {
            city: this.model.get(this.addressField + 'City'),
            street: this.model.get(this.addressField + 'Street'),
            postalCode: this.model.get(this.addressField + 'PostalCode'),
            country: this.model.get(this.addressField + 'Country'),
            state: this.model.get(this.addressField + 'State'),
        };

        this.$map = this.$el.find('.map');

        if (this.hasAddress()) {
            this.processSetHeight(true);

            if (this.height === 'auto') {
                $(window).off('resize.' + this.cid);
                $(window).on('resize.' + this.cid, this.processSetHeight.bind(this));
            }

            let methodName = 'afterRender' + this.provider.replace(/\s+/g, '');

            if (typeof this[methodName] === 'function') {
                this[methodName]();
            }
            else {
                let implClassName = this.getMetadata()
                    .get(['clientDefs', 'AddressMap', 'implementations', this.provider]);

                if (implClassName) {
                    Espo.loader.require(implClassName, impl => {
                        impl.render(this);
                    });
                }
            }
        }
    }

    // noinspection JSUnusedGlobalSymbols
    afterRenderGoogle() {
        if (window.google && window.google.maps) {
            this.initMapGoogle();

            return;
        }

        // noinspection SpellCheckingInspection
        if (typeof window.mapapiloaded === 'function') {
            // noinspection SpellCheckingInspection
            let mapapiloaded = window.mapapiloaded;

            // noinspection SpellCheckingInspection
            window.mapapiloaded = () => {
                this.initMapGoogle();
                mapapiloaded();
            };

            return;
        }

        // noinspection SpellCheckingInspection
        window.mapapiloaded = () => {
            this.initMapGoogle();
        };

        let src = 'https://maps.googleapis.com/maps/api/js?callback=mapapiloaded';
        let apiKey = this.getConfig().get('googleMapsApiKey');

        if (apiKey) {
            src += '&key=' + apiKey;
        }

        let scriptElement = document.createElement('script');

        scriptElement.setAttribute('async', 'async');
        scriptElement.src = src;

        document.head.appendChild(scriptElement);
    }

    processSetHeight(init) {
        let height = this.height;

        if (this.height === 'auto') {
            height = this.$el.parent().height();

            if (init && height <= 0) {
                setTimeout(() => {
                    this.processSetHeight(true);
                }, 50);

                return;
            }
        }

        this.$map.css('height', height + 'px');
    }

    initMapGoogle() {
        const geocoder = new google.maps.Geocoder();
        let map;

        try {
            // noinspection SpellCheckingInspection
            map = new google.maps.Map(this.$el.find('.map').get(0), {
                zoom: 15,
                center: {lat: 0, lng: 0},
                scrollwheel: false,
            });
        }
        catch (e) {
            console.error(e.message);

            return;
        }

        let address = '';

        if (this.addressData.street) {
            address += this.addressData.street;
        }

        if (this.addressData.city) {
            if (address !== '') {
                address += ', ';
            }

            address += this.addressData.city;
        }

        if (this.addressData.state) {
            if (address !== '') {
                address += ', ';
            }

            address += this.addressData.state;
        }

        if (this.addressData.postalCode) {
            if (this.addressData.state || this.addressData.city) {
                address += ' ';
            }
            else {
                if (address) {
                    address += ', ';
                }
            }

            address += this.addressData.postalCode;
        }

        if (this.addressData.country) {
            if (address !== '') {
                address += ', ';
            }

            address += this.addressData.country;
        }

        geocoder.geocode({'address': address}, (results, status) => {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);

                new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                });
            }
        });
    }
}

export default MapFieldView;

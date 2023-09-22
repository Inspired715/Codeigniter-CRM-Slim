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

define('views/admin/field-manager/fields/options', ['views/fields/array'], function (Dep) {

    return Dep.extend({

        maxItemLength: 100,

        setup: function () {
            Dep.prototype.setup.call(this);

            this.translatedOptions = {};

            let list = this.model.get(this.name) || [];

            list.forEach(value => {
                this.translatedOptions[value] = this.getLanguage()
                    .translateOption(value, this.options.field, this.options.scope);
            });

            this.model.fetchedAttributes.translatedOptions = this.translatedOptions;
        },

        getItemHtml: function (value) {
            // Do not use the `html` method to avoid XSS.

            let text = (this.translatedOptions[value] || value);

            let $div = $('<div>')
                .addClass('list-group-item link-with-role form-inline')
                .attr('data-value', value)
                .append(
                    $('<div>')
                        .addClass('pull-left item-content')
                        .css('width', '92%')
                        .css('display', 'inline-block')
                        .append(
                            $('<input>')
                                .attr('type', 'text')
                                .attr('data-name', 'translatedValue')
                                .attr('data-value', value)
                                .addClass('role form-control input-sm pull-right')
                                .attr('value', text)
                                .css('width', 'auto')
                        )
                        .append(
                            $('<div>')
                                .addClass('item-text')
                                .text(value)
                        )
                )
                .append(
                    $('<div>')
                        .css('width', '8%')
                        .css('display', 'inline-block')
                        .css('vertical-align', 'top')
                        .append(
                            $('<a>')
                                .attr('role', 'button')
                                .attr('tabindex', '0')
                                .addClass('pull-right')
                                .attr('data-value', value)
                                .attr('data-action', 'removeValue')
                                .append(
                                    $('<span>').addClass('fas fa-times')
                                )
                        )
                )
                .append(
                    $('<br>').css('clear', 'both')
                );

            return $div.get(0).outerHTML;
        },

        fetch: function () {
            let data = Dep.prototype.fetch.call(this);

            if (!data[this.name].length) {
                data[this.name] = null;
                data.translatedOptions = {};

                return data;
            }

            data.translatedOptions = {};

            (data[this.name] || []).forEach(value => {
                let valueInternal = value.replace(/"/g, '\\"');

                let translatedValue = this.$el
                    .find('input[data-name="translatedValue"][data-value="'+valueInternal+'"]').val() || value;

                data.translatedOptions[value] = translatedValue.toString();
            });

            return data;
        },
    });
});

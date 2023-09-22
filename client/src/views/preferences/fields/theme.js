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

define('views/preferences/fields/theme', ['views/settings/fields/theme'], function (Dep) {

    return Dep.extend({

        setupOptions: function () {
            this.params.options = Object.keys(this.getMetadata().get('themes') || {})
                .sort((v1, v2) => {
                    if (v2 === 'EspoRtl') {
                        return -1;
                    }

                    return this.translate(v1, 'themes').localeCompare(this.translate(v2, 'themes'));
                });

            this.params.options.unshift('');
        },

        setupTranslation: function () {
            Dep.prototype.setupTranslation.call(this);

            this.translatedOptions = this.translatedOptions || {};

            let defaultTheme = this.getConfig().get('theme');
            let defaultTranslated = this.translatedOptions[defaultTheme] || defaultTheme;

            this.translatedOptions[''] = this.translate('Default') + ' (' + defaultTranslated + ')';
        },

        afterRenderDetail: function () {
            let navbar = this.getNavbarValue() || this.getDefaultNavbar();

            if (navbar) {
                this.$el
                    .append(' ')
                    .append(
                        $('<span>').addClass('text-muted chevron-right')
                    )
                    .append(' ')
                    .append(
                        $('<span>').text(this.translate(navbar, 'themeNavbars'))
                    )
            }
        },
    });
});

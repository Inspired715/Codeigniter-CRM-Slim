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

/** @module views/header */

import View from 'view';

class HeaderView extends View {

    template = 'header'

    data() {
        let data = {};

        if ('getHeader' in this.getParentMainView()) {
            data.header = this.getParentMainView().getHeader();
        }

        data.scope = this.scope || this.getParentMainView().scope;
        data.items = this.getItems();

        let dropdown = (data.items || {}).dropdown || [];

        data.hasVisibleDropdownItems = false;

        dropdown.forEach(item => {
            if (!item.hidden) {
                data.hasVisibleDropdownItems = true;
            }
        });

        data.noBreakWords = this.options.fontSizeFlexible;

        data.isXsSingleRow = this.options.isXsSingleRow;

        if ((data.items.buttons || []).length < 2) {
            data.isHeaderAdditionalSpace = true;
        }

        return data;
    }

    setup() {
        this.scope = this.options.scope;

        if (this.model) {
            this.listenTo(this.model, 'after:save', () => {
                if (this.isRendered()) {
                    this.reRender();
                }
            });
        }

        this.wasRendered = false;
    }


    afterRender() {
        if (this.options.fontSizeFlexible) {
            this.adjustFontSize();
        }

        if (this.wasRendered) {
            this.getParentMainView().trigger('header-rendered');
        }

        this.wasRendered = true;
    }

    adjustFontSize(step) {
        step = step || 0;

        if (!step) {
            this.fontSizePercentage = 100;
        }

        let $container = this.$el.find('.header-breadcrumbs');
        let containerWidth = $container.width();
        let childrenWidth = 0;

        $container.children().each((i, el) => {
            childrenWidth += $(el).outerWidth(true);
        });

        if (containerWidth < childrenWidth) {
            if (step > 7) {
                $container.addClass('overlapped');

                this.$el.find('.title').each((i, el) => {
                    let $el = $(el);
                    let text = $(el).text();

                    $el.attr('title', text);

                    let isInitialized = false;

                    $el.on('touchstart', () => {
                        if (!isInitialized) {
                            $el.attr('title', '');
                            isInitialized = true;

                            Espo.Ui.popover($el, {
                                content: text,
                                noToggleInit: true,
                            }, this);
                        }

                        $el.popover('toggle');
                    });
                });

                return;
            }

            this.fontSizePercentage -= 4;

            let $flexible = this.$el.find('.font-size-flexible');

            $flexible.css('font-size', this.fontSizePercentage + '%');
            $flexible.css('position', 'relative');

            if (step > 6) {
                $flexible.css('top', '-1px');
            } else if (step > 4) {
                $flexible.css('top', '-1px');
            }

            this.adjustFontSize(step + 1);
        }
    }

    getItems() {
        return this.getParentMainView().getMenu() || {};
    }

    /**
     * @return {module:views/main}
     */
    getParentMainView() {
        return /** @type module:views/main */this.getParentView();
    }
}

export default HeaderView;

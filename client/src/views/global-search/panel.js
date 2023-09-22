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

import View from 'view';

class GlobalSearchPanel extends View {

    template = 'global-search/panel'

    setup() {
        this.addHandler('click', '[data-action="closePanel"]', () => this.close());

        this.maxSize = this.getConfig().get('globalSearchMaxSize') || 10;

        this.navbarPanelHeightSpace = this.getThemeManager().getParam('navbarPanelHeightSpace') || 100;
        this.navbarPanelBodyMaxHeight = this.getThemeManager().getParam('navbarPanelBodyMaxHeight') || 600;
    }

    onRemove() {
        $(window).off('resize.global-search-height');

        if (this.overflowWasHidden) {
            $('body').css('overflow', 'unset');

            this.overflowWasHidden = false;
        }
    }

    afterRender() {
        this.collection.reset();
        this.collection.maxSize = this.maxSize;

        this.collection.fetch()
            .then(() => this.createRecordView())
            .then(view => view.render());

        const $window = $(window);

        $window.off('resize.global-search-height');
        $window.on('resize.global-search-height', this.processSizing.bind(this));

        this.processSizing();
    }

    /**
     * @return {Promise<module:views/record/list-expanded>}
     */
    createRecordView() {
        return this.createView('list', 'views/record/list-expanded', {
            selector: '.list-container',
            collection: this.collection,
            listLayout: {
                rows: [
                    [
                        {
                            name: 'name',
                            view: 'views/global-search/name-field',
                        }
                    ]
                ],
                right: {
                    name: 'read',
                    view: 'views/global-search/scope-badge',
                    width: '80px',
                },
            }
        });
    }

    processSizing() {
        const $window = $(window);

        let windowHeight = $window.height();
        let windowWidth = $window.width();

        let diffHeight = this.$el.find('.panel-heading').outerHeight();

        let cssParams = {};

        if (windowWidth <= this.getThemeManager().getParam('screenWidthXs')) {
            cssParams.height = (windowHeight - diffHeight) + 'px';
            cssParams.overflow = 'auto';

            $('body').css('overflow', 'hidden');

            this.overflowWasHidden = true;
        }
        else {
            cssParams.height = 'unset';
            cssParams.overflow = 'none';

            if (this.overflowWasHidden) {
                $('body').css('overflow', 'unset');

                this.overflowWasHidden = false;
            }

            if (windowHeight - this.navbarPanelBodyMaxHeight < this.navbarPanelHeightSpace) {
                let maxHeight = windowHeight - this.navbarPanelHeightSpace;

                cssParams.maxHeight = maxHeight + 'px';
            }
        }

        this.$el.find('.panel-body').css(cssParams);
    }

    close() {
        this.trigger('close');
    }
}

export default GlobalSearchPanel;

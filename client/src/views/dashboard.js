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

/** @module views/dashboard */

import View from 'view';
import GridStack from 'gridstack';

class DashboardView extends View {

    template = 'dashboard'

    dashboardLayout = null
    currentTab = null

    WIDTH_MULTIPLIER = 3

    events = {
        /** @this DashboardView */
        'click button[data-action="selectTab"]': function (e) {
            let tab = parseInt($(e.currentTarget).data('tab'));

            this.selectTab(tab);
        },
        /** @this DashboardView */
        'click .dashboard-buttons [data-action="addDashlet"]': function () {
            this.createView('addDashlet', 'views/modals/add-dashlet', {}, view => {
                view.render();

                this.listenToOnce(view, 'add', name => {
                    this.addDashlet(name);
                });
            });
        },
        /** @this DashboardView */
        'click .dashboard-buttons [data-action="editTabs"]': function () {
            this.editTabs();
        },
    }

    data() {
        return {
            displayTitle: this.options.displayTitle,
            currentTab: this.currentTab,
            tabCount: this.dashboardLayout.length,
            dashboardLayout: this.dashboardLayout,
            layoutReadOnly: this.layoutReadOnly,
            hasAdd: !this.layoutReadOnly && !this.getPreferences().get('dashboardLocked'),
        };
    }

    generateId() {
        return (Math.floor(Math.random() * 10000001)).toString();
    }

    setupCurrentTabLayout() {
        if (!this.dashboardLayout) {
            let defaultLayout = [
                {
                    "name": "My Espo",
                    "layout": [],
                }
            ];

            if (this.getConfig().get('forcedDashboardLayout')) {
                this.dashboardLayout = this.getConfig().get('forcedDashboardLayout') || [];
            }
            else if (this.getUser().get('portalId')) {
                this.dashboardLayout = this.getConfig().get('dashboardLayout') || [];
            }
            else {
                this.dashboardLayout = this.getPreferences().get('dashboardLayout') || defaultLayout;
            }

            if (
                this.dashboardLayout.length === 0 ||
                Object.prototype.toString.call(this.dashboardLayout) !== '[object Array]'
            ) {
                this.dashboardLayout = defaultLayout;
            }
        }

        let dashboardLayout = this.dashboardLayout || [];

        if (dashboardLayout.length <= this.currentTab) {
            this.currentTab = 0;
        }

        let tabLayout = dashboardLayout[this.currentTab].layout || [];

        tabLayout = GridStack.Utils.sort(tabLayout);

        this.currentTabLayout = tabLayout;
    }

    storeCurrentTab(tab) {
        this.getStorage().set('state', 'dashboardTab', tab);
    }

    selectTab(tab) {
        this.$el.find('.page-header button[data-action="selectTab"]').removeClass('active');
        this.$el.find('.page-header button[data-action="selectTab"][data-tab="'+tab+'"]').addClass('active');

        this.currentTab = tab;
        this.storeCurrentTab(tab);

        this.setupCurrentTabLayout();

        this.dashletIdList.forEach(id => {
            this.clearView('dashlet-'+id);
        });

        this.dashletIdList = [];

        this.reRender();
    }

    setup() {
        this.currentTab = this.getStorage().get('state', 'dashboardTab') || 0;
        this.setupCurrentTabLayout();

        this.dashletIdList = [];

        this.screenWidthXs = this.getThemeManager().getParam('screenWidthXs');

        if (this.getUser().isPortal()) {
            this.layoutReadOnly = true;
            this.dashletsReadOnly = true;
        }
        else {
            let forbiddenPreferencesFieldList = this.getAcl()
                .getScopeForbiddenFieldList('Preferences', 'edit');

            if (~forbiddenPreferencesFieldList.indexOf('dashboardLayout')) {
                this.layoutReadOnly = true;
            }

            if (~forbiddenPreferencesFieldList.indexOf('dashletsOptions')) {
                this.dashletsReadOnly = true;
            }
        }

        this.once('remove', () => {
            if (this.grid) {
                this.grid.destroy();
            }

            if (this.fallbackModeTimeout) {
                clearTimeout(this.fallbackModeTimeout);
            }

            $(window).off('resize.dashboard');
        });
    }

    afterRender() {
        this.$dashboard = this.$el.find('> .dashlets');

        if (window.innerWidth >= this.screenWidthXs) {
            this.initGridstack();
        }
        else {
            this.initFallbackMode();
        }

        $(window).off('resize.dashboard');
        $(window).on('resize.dashboard', this.onResize.bind(this));
    }

    onResize() {
        if (this.isFallbackMode() && window.innerWidth >= this.screenWidthXs) {
            this.initGridstack();
        }
        else if (!this.isFallbackMode() && window.innerWidth < this.screenWidthXs) {
            this.initFallbackMode();
        }
    }

    isFallbackMode() {
        return this.$dashboard.hasClass('fallback');
    }

    preserveDashletViews() {
        this.preservedDashletViews = {};
        this.preservedDashletElements = {};

        this.currentTabLayout.forEach(o => {
            let key = 'dashlet-' + o.id;
            let view = this.getView(key);

            this.unchainView(key);

            this.preservedDashletViews[o.id] = view;

            let $el = view.$el.children(0);

            this.preservedDashletElements[o.id] = $el;

            $el.detach();
        });
    }

    addPreservedDashlet(id) {
        let view = this.preservedDashletViews[id];
        let $el = this.preservedDashletElements[id];

        this.$el.find('.dashlet-container[data-id="'+id+'"]').append($el);

        this.setView('dashlet-' + id, view);
    }

    clearPreservedDashlets() {
        this.preservedDashletViews = null;
        this.preservedDashletElements = null;
    }

    hasPreservedDashlets() {
        return !!this.preservedDashletViews;
    }

    initFallbackMode() {
        if (this.grid) {
            this.grid.destroy(false);
            this.grid = null;

            this.preserveDashletViews();
        }

        this.$dashboard.empty();

        let $dashboard = this.$dashboard;

        $dashboard.addClass('fallback');

        this.currentTabLayout.forEach(o => {
            let $item = this.prepareFallbackItem(o);

            $dashboard.append($item);
        });

        this.currentTabLayout.forEach(o => {
            if (!o.id || !o.name) {
                return;
            }

            if (!this.getMetadata().get(['dashlets', o.name])) {
                console.error("Dashlet " + o.name + " doesn't exist or not available.");

                return;
            }

            if (this.hasPreservedDashlets()) {
                this.addPreservedDashlet(o.id);

                return;
            }

            this.createDashletView(o.id, o.name);
        });

        this.clearPreservedDashlets();

        if (this.fallbackModeTimeout) {
            clearTimeout(this.fallbackModeTimeout);
        }

        this.$dashboard.css('height', '');

        this.fallbackControlHeights();
    }

    fallbackControlHeights() {
        this.currentTabLayout.forEach(o => {
            let $container = this.$dashboard.find('.dashlet-container[data-id="'+o.id+'"]');

            let headerHeight = $container.find('.panel-heading').outerHeight();

            let $body = $container.find('.dashlet-body');

            let bodyEl = $body.get(0);

            if (!bodyEl) {
                return;
            }

            if (bodyEl.scrollHeight > bodyEl.offsetHeight) {
                let height = bodyEl.scrollHeight + headerHeight;

                $container.css('height', height + 'px');
            }
        });

        this.fallbackModeTimeout = setTimeout(() => {
            this.fallbackControlHeights();
        }, 300);
    }

    initGridstack() {
        if (this.isFallbackMode()) {
            this.preserveDashletViews();
        }

        this.$dashboard.empty();

        let $gridstack = this.$gridstack = this.$dashboard;

        $gridstack.removeClass('fallback');

        if (this.fallbackModeTimeout) {
            clearTimeout(this.fallbackModeTimeout);
        }

        let disableDrag = false;
        let disableResize = false;

        if (this.getUser().isPortal() || this.getPreferences().get('dashboardLocked')) {
            disableDrag = true;
            disableResize = true;
        }

        let grid = this.grid = GridStack.init(
            {
                cellHeight: this.getThemeManager().getParam('dashboardCellHeight') * 1.14,
                margin: this.getThemeManager().getParam('dashboardCellMargin') / 2,
                column: 12,
                handle: '.panel-heading',
                disableDrag: disableDrag,
                disableResize: disableResize,
                disableOneColumnMode: true,
                draggable: {
                    distance: 10,
                },
                dragInOptions: {
                    scroll: false,
                },
                float: false,
                animate: false,
                scroll: false,
            },
            $gridstack.get(0)
        );

        grid.removeAll();

        this.currentTabLayout.forEach(o => {
            let $item = this.prepareGridstackItem(o.id, o.name);

            if (!this.getMetadata().get(['dashlets', o.name])) {
                return;
            }

            grid.addWidget(
                $item.get(0),
                {
                    x: o.x * this.WIDTH_MULTIPLIER,
                    y: o.y,
                    w: o.width * this.WIDTH_MULTIPLIER,
                    h: o.height,
                }
            );
        });

        $gridstack.find('.grid-stack-item').css('position', 'absolute');

        this.currentTabLayout.forEach(o => {
            if (!o.id || !o.name) {
                return;
            }

            if (!this.getMetadata().get(['dashlets', o.name])) {
                console.error("Dashlet " + o.name + " doesn't exist or not available.");

                return;
            }

            if (this.hasPreservedDashlets()) {
                this.addPreservedDashlet(o.id);

                return;
            }

            this.createDashletView(o.id, o.name);
        });

        this.clearPreservedDashlets();

        this.grid.on('change', () => {
            this.fetchLayout();
            this.saveLayout();
        });

        // noinspection SpellCheckingInspection
        this.grid.on('resizestop', e => {
            let id = $(e.target).data('id');
            let view = this.getView('dashlet-' + id);

            if (!view) {
                return;
            }
            view.trigger('resize');
        });
    }

    fetchLayout() {
        this.dashboardLayout[this.currentTab].layout =
            _.map(this.$gridstack.find('.grid-stack-item'), el => {
                let $el = $(el);

                let x = $el.attr('gs-x');
                let y = $el.attr('gs-y');
                let h = $el.attr('gs-h');
                let w = $el.attr('gs-w');

                return {
                    id: $el.data('id'),
                    name: $el.data('name'),
                    x: x / this.WIDTH_MULTIPLIER,
                    y: y,
                    width: w / this.WIDTH_MULTIPLIER,
                    height: h,
                };
            });
    }

    prepareGridstackItem(id, name) {
        let $item = $('<div>').addClass('grid-stack-item');
        let $container = $('<div class="grid-stack-item-content dashlet-container"></div>');

        $container.attr('data-id', id);
        $container.attr('data-name', name);

        $item.attr('data-id', id);
        $item.attr('data-name', name);

        $item.append($container);

        return $item;
    }

    prepareFallbackItem(o) {
        let $item = $('<div>');
        let $container = $('<div class="dashlet-container">');

        $container.attr('data-id', o.id);
        $container.attr('data-name', o.name);
        $container.attr('data-x', o.x);
        $container.attr('data-y', o.y);
        $container.attr('data-height', o.height);
        $container.attr('data-width', o.width);
        $container.css('height', (o.height *
            this.getThemeManager().getParam('dashboardCellHeight')) + 'px');

        $item.attr('data-id', o.id);
        $item.attr('data-name', o.name);

        $item.append($container);

        return $item;
    }

    saveLayout(attributes) {
        if (this.layoutReadOnly) {
            return;
        }

        attributes = {
            ...(attributes || {}),
            ...{dashboardLayout: this.dashboardLayout},
        };

        this.getPreferences().save(attributes, {patch: true});

        this.getPreferences().trigger('update');
    }

    removeDashlet(id) {
        let revertToFallback = false;

        if (this.isFallbackMode()) {
            this.initGridstack();

            revertToFallback = true;
        }

        let $item = this.$gridstack.find('.grid-stack-item[data-id="'+id+'"]');

        // noinspection JSUnresolvedReference
        this.grid.removeWidget($item.get(0), true);

        let layout = this.dashboardLayout[this.currentTab].layout;

        layout.forEach((o, i) => {
            if (o.id === id) {
                layout.splice(i, 1);
            }
        });

        let o = {};

        o.dashletsOptions = this.getPreferences().get('dashletsOptions') || {};

        delete o.dashletsOptions[id];

        o.dashboardLayout = this.dashboardLayout;

        if (this.layoutReadOnly) {
            return;
        }

        this.getPreferences().save(o, {patch: true});
        this.getPreferences().trigger('update');

        let index = this.dashletIdList.indexOf(id);

        if (~index) {
            this.dashletIdList.splice(index, index);
        }

        this.clearView('dashlet-' + id);

        this.setupCurrentTabLayout();

        if (revertToFallback) {
            this.initFallbackMode();
        }
    }

    addDashlet(name) {
        let revertToFallback = false;

        if (this.isFallbackMode()) {
            this.initGridstack();

            revertToFallback = true;
        }

        let id = 'd' + (Math.floor(Math.random() * 1000001)).toString();

        let $item = this.prepareGridstackItem(id, name);

        this.grid.addWidget(
            $item.get(0),
            {
                x: 0,
                y: 0,
                w: 2 * this.WIDTH_MULTIPLIER,
                h: 2,
            }
        );

        this.createDashletView(id, name, name, view => {
            this.fetchLayout();
            this.saveLayout();

            this.setupCurrentTabLayout();

            if (view.getView('body') && view.getView('body').afterAdding) {
                view.getView('body').afterAdding.call(view.getView('body'));
            }

            if (revertToFallback) {
                this.initFallbackMode();
            }
        });
    }

    createDashletView(id, name, label, callback) {
        let o = {
            id: id,
            name: name,
        };

        if (label) {
            o.label = label;
        }

        return this.createView('dashlet-' + id, 'views/dashlet', {
            label: name,
            name: name,
            id: id,
            selector: '> .dashlets .dashlet-container[data-id="' + id + '"]',
            readOnly: this.dashletsReadOnly,
            locked: this.getPreferences().get('dashboardLocked'),
        }, view => {
            this.dashletIdList.push(id);

            view.render();

            this.listenToOnce(view, 'change', () => {
                this.clearView(id);

                this.createDashletView(id, name, label);
            });

            this.listenToOnce(view, 'remove-dashlet', () => {
                this.removeDashlet(id);
            });

            if (callback) {
                callback.call(this, view);
            }
        });
    }

    editTabs() {
        let dashboardLocked = this.getPreferences().get('dashboardLocked');

        this.createView('editTabs', 'views/modals/edit-dashboard', {
            dashboardLayout: this.dashboardLayout,
            dashboardLocked: dashboardLocked,
            fromDashboard: true,
        }, view => {
            view.render();

            this.listenToOnce(view, 'after:save', data => {
                view.close();

                let dashboardLayout = [];

                data.dashboardTabList.forEach(name => {
                    let layout = [];
                    let id = null;

                    this.dashboardLayout.forEach(d => {
                        if (d.name === name) {
                            layout = d.layout;
                            id = d.id;
                        }
                    });

                    if (name in data.renameMap) {
                        name = data.renameMap[name];
                    }

                    let o = {
                        name: name,
                        layout: layout,
                    };

                    if (id) {
                        o.id = id;
                    }

                    dashboardLayout.push(o);
                });

                this.dashletIdList.forEach(item => {
                    this.clearView('dashlet-' + item);
                });

                this.dashboardLayout = dashboardLayout;

                this.saveLayout({
                    dashboardLocked: data.dashboardLocked,
                });

                this.storeCurrentTab(0);
                this.currentTab = 0;
                this.setupCurrentTabLayout();

                this.reRender();
            });
        });
    }
}

export default DashboardView;

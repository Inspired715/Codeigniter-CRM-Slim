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

/** @module views/record/panels-container */

import View from 'view';

/**
 * A panel container view. For bottom and side views.
 */
class PanelsContainerRecordView extends View {

    /** @private */
    panelSoftLockedTypeList = ['default', 'acl', 'delimiter', 'dynamicLogic']

    /**
     * A panel.
     *
     * @typedef {Object} module:views/record/panels-container~panel
     *
     * @property {string} name A name.
     * @property {boolean} [hidden] Hidden.
     * @property {string} [label] A label.
     * @property {'default'|'success'|'danger'|'warning'} [style] A style.
     * @property {string} [titleHtml] A title HTML.
     * @property {boolean} [notRefreshable] Not refreshable.
     * @property {boolean} [isForm] If for a form.
     * @property {module:views/record/panels-container~button[]} [buttonList] Buttons.
     * @property {module:views/record/panels-container~action[]} [actionList] Dropdown actions.
     * @property {string} [view] A view name.
     * @property {Object.<string, *>} [Options] A view options.
     * @property {boolean} [sticked] To stick to an upper panel.
     * @property {Number} [tabNumber] A tab number.
     * @property {string} [aclScope] A scope to check access to.
     * @property {Espo.Utils~AccessDefs[]} [accessDataList] Access control defs.
     */

    /**
     * A button. Handled by an `action{Action}` method or a click handler.
     *
     * @typedef {Object} module:views/record/panels-container~button
     *
     * @property {string} action An action.
     * @property {boolean} [hidden] Hidden.
     * @property {string} [label] A label. Translatable.
     * @property {string} [html] A HTML.
     * @property {string} [text] A text.
     * @property {string} [title] A title (on hover). Translatable.
     * @property {Object.<string, (string|number|boolean)>} [data] Data attributes.
     * @property {function()} [onClick] A click event.
     */

    /**
     * An action. Handled by an `action{Action}` method or a click handler.
     *
     * @typedef {Object} module:views/record/panels-container~action
     *
     * @property {string} [action] An action.
     * @property {string} [link] A link URL.
     * @property {boolean} [hidden] Hidden.
     * @property {string} [label] A label. Translatable.
     * @property {string} [html] A HTML.
     * @property {string} [text] A text.
     * @property {Object.<string, (string|number|boolean)>} [data] Data attributes.
     * @property {function()} [onClick] A click event.
     */

    /**
     * A panel list.
     *
     * @protected
     * @type {module:views/record/panels-container~panel[]}
     */
    panelList = null

    /** @private */
    hasTabs = false

    /**
     * @private
     * @type {Object.<string,*>[]|null}
     */
    tabDataList = null

    /**
     * @protected
     */
    currentTab = 0

    /**
     * @protected
     * @type {string}
     */
    scope = ''

    /**
     * @protected
     * @type {string}
     */
    entityType =  ''

    /**
     * @protected
     * @type {string}
     */
    name =  ''

    /**
     * A mode.
     *
     * @type 'detail'|'edit'
     */
    mode = 'detail'

    data() {
        let tabDataList = this.hasTabs ? this.getTabDataList() : [];

        return {
            panelList: this.panelList,
            scope: this.scope,
            entityType: this.entityType,
            tabDataList: tabDataList,
        };
    }

    events = {
        'click .action': function (e) {
            let $target = $(e.currentTarget);
            let panel = $target.data('panel');

            if (!panel) {
                return;
            }

            let panelView = this.getView(panel);

            if (!panelView) {
                return;
            }

            let actionItems;

            if (
                typeof panelView.getButtonList === 'function' &&
                typeof panelView.getActionList === 'function'
            ) {
                actionItems = [...panelView.getButtonList(), ...panelView.getActionList()];
            }

            Espo.Utils.handleAction(panelView, e.originalEvent, e.currentTarget, {
                actionItems: actionItems,
                className: 'panel-action',
            });

            // @todo Check data. Maybe pass cloned data with unset params.

            /*
            let action = $target.data('action');
            let data = $target.data();

            if (action && panel) {
                let method = 'action' + Espo.Utils.upperCaseFirst(action);
                let d = _.clone(data);

                delete d['action'];
                delete d['panel'];

                let view = this.getView(panel);

                if (view && typeof view[method] == 'function') {
                    view[method].call(view, d, e);
                }
            }*/
        },
        'click .panels-show-more-delimiter [data-action="showMorePanels"]': 'actionShowMorePanels',
        /** @this module:views/record/panels-container */
        'click .tabs > button': function (e) {
            let tab = parseInt($(e.currentTarget).attr('data-tab'));

            this.selectTab(tab);
        },
    }

    afterRender() {
        this.adjustPanels();
    }

    adjustPanels() {
        if (!this.isRendered()) {
            return;
        }

        let $panels = this.$el.find('> .panel');

        $panels
            .removeClass('first')
            .removeClass('last')
            .removeClass('in-middle');

        let $visiblePanels = $panels.filter(`:not(.tab-hidden):not(.hidden)`);

        let groups = [];
        let currentGroup = [];
        let inTab = false;

        $visiblePanels.each((i, el) => {
            let $el = $(el);

            let breakGroup = false;

            if (
                !breakGroup &&
                this.hasTabs &&
                !inTab &&
                $el.attr('data-tab') !== '-1'
            ) {
                inTab = true;
                breakGroup = true;
            }

            if (!breakGroup && !$el.hasClass('sticked')) {
                breakGroup = true;
            }

            if (breakGroup) {
                if (i !== 0) {
                    groups.push(currentGroup);
                }

                currentGroup = [];
            }

            currentGroup.push($el);

            if (i === $visiblePanels.length - 1) {
                groups.push(currentGroup);
            }
        });

        groups.forEach(group => {
            group.forEach(($el, i) => {
                if (i === group.length - 1) {
                    if (i === 0) {
                        return;
                    }

                    $el.addClass('last')

                    return;
                }

                if (i === 0 && group.length) {
                    $el.addClass('first')

                    return;
                }

                $el.addClass('in-middle');
            });
        });
    }

    /**
     * Set read-only.
     */
    setReadOnly() {
        this.readOnly = true;
    }

    /**
     * Set not read-only.
     */
    setNotReadOnly(onlyNotSetAsReadOnly) {
        this.readOnly = false;

        if (onlyNotSetAsReadOnly) {
            this.panelList.forEach(item => {
                this.applyAccessToActions(item.buttonList);
                this.applyAccessToActions(item.actionList);

                if (this.isRendered()) {
                    let actionsView = this.getView(item.actionsViewKey);

                    if (actionsView) {
                        actionsView.reRender();
                    }
                }
            });
        }
    }

    /**
     * @private
     * @param {Object[]} actionList
     */
    applyAccessToActions(actionList) {
        if (!actionList) {
            return;
        }

        actionList.forEach(item => {
            if (!Espo.Utils.checkActionAvailability(this.getHelper(), item)) {
                item.hidden = true;

                return;
            }

            if (Espo.Utils.checkActionAccess(this.getAcl(), this.model, item, true)) {
                if (item.isHiddenByAcl) {
                    item.isHiddenByAcl = false;
                    item.hidden = false;
                }
            }
            else {
                if (!item.hidden) {
                    item.isHiddenByAcl = true;
                    item.hidden = true;
                }
            }
        });
    }

    /**
     * Set up panel views.
     *
     * @protected
     */
    setupPanelViews() {
        this.panelList.forEach(p => {
            let name = p.name;

            let options = {
                model: this.model,
                panelName: name,
                selector: '.panel[data-name="' + name + '"] > .panel-body',
                defs: p,
                mode: this.mode,
                recordHelper: this.recordHelper,
                inlineEditDisabled: this.inlineEditDisabled,
                readOnly: this.readOnly,
                disabled: p.hidden || false,
                recordViewObject: this.recordViewObject,
                dataObject: this.options.dataObject,
            };

            options = _.extend(options, p.options);

            this.createView(name, p.view, options, (view) => {
                if ('getActionList' in view) {
                    p.actionList = view.getActionList();

                    this.applyAccessToActions(p.actionList);
                }

                if ('getButtonList' in view) {
                    p.buttonList = view.getButtonList();
                    this.applyAccessToActions(p.buttonList);
                }

                if (view.titleHtml) {
                    p.titleHtml = view.titleHtml;
                }
                else {
                    if (p.label) {
                        p.title = this.translate(p.label, 'labels', this.scope);
                    }
                    else {
                        p.title = view.title;
                    }
                }

                this.createView(name + 'Actions', 'views/record/panel-actions', {
                    selector: '.panel[data-name="' + p.name + '"] > .panel-heading > .panel-actions-container',
                    model: this.model,
                    defs: p,
                    scope: this.scope,
                    entityType: this.entityType,
                });
            });
        });
    }

    /**
     * Set up panels.
     *
     * @protected
     */
    setupPanels() {}

    /**
     * Get field views.
     *
     * @param {boolean} [withHidden] With hidden.
     * @return {Object.<string, module:views/fields/base>}
     */
    getFieldViews(withHidden) {
        let fields = {};

        this.panelList.forEach(p => {
            let panelView = this.getView(p.name);

            if ((!panelView.disabled || withHidden) && 'getFieldViews' in panelView) {
                fields = _.extend(fields, panelView.getFieldViews());
            }
        });

        return fields;
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * @deprecated Use `getFieldViews`.
     * @todo Remove in v9.0.
     */
    getFields() {
        return this.getFieldViews();
    }

    /**
     * Fetch.
     *
     * @return {Object.<string, *>}
     */
    fetch() {
        let data = {};

        this.panelList.forEach(p => {
            let panelView = this.getView(p.name);

            if (!panelView.disabled && 'fetch' in panelView) {
                data = _.extend(data, panelView.fetch());
            }
        });

        return data;
    }

    /**
     * @param {string} name
     * @return {boolean}
     */
    hasPanel(name) {
        return !!this.panelList.find(item => item.name === name);
    }

    processShowPanel(name, callback, wasShown) {
        if (this.recordHelper.getPanelStateParam(name, 'hidden')) {
            return;
        }

        if (!this.hasPanel(name)) {
            return;
        }

        this.panelList.filter(item => item.name === name).forEach(item => {
            item.hidden = false;

            if (typeof item.tabNumber !== 'undefined') {
                this.controlTabVisibilityShow(item.tabNumber);
            }
        });

        this.showPanelFinalize(name, callback, wasShown);
    }

    processHidePanel(name, callback) {
        if (!this.recordHelper.getPanelStateParam(name, 'hidden')) {
            return;
        }

        if (!this.hasPanel(name)) {
            return;
        }

         this.panelList.filter(item => item.name === name).forEach(item => {
            item.hidden = true;

            if (typeof item.tabNumber !== 'undefined') {
                this.controlTabVisibilityHide(item.tabNumber);
            }
        });

        this.hidePanelFinalize(name, callback);
    }

    showPanelFinalize(name, callback, wasShown) {
        let process = (wasRendered) => {
            let view = this.getView(name);

            if (view) {
                view.$el.closest('.panel').removeClass('hidden');

                view.disabled = false;
                view.trigger('show');
                view.trigger('panel-show-propagated');

                if (wasRendered && !wasShown && view.getFieldViews) {
                    let fields = view.getFieldViews();

                    if (fields) {
                        for (let i in fields) {
                            fields[i].reRender();
                        }
                    }
                }
            }

            if (typeof callback === 'function') {
                callback.call(this);
            }
        };

        if (this.isRendered()) {
            process(true);

            this.adjustPanels();

            return;
        }

        this.once('after:render', () => {
            process();
        });
    }

    hidePanelFinalize(name, callback) {
        if (this.isRendered()) {
            let view = this.getView(name);

            if (view) {
                view.$el.closest('.panel').addClass('hidden');
                view.disabled = true;
                view.trigger('hide');
            }

            if (typeof callback === 'function') {
                callback.call(this);
            }

            this.adjustPanels();

            return;
        }

        if (typeof callback === 'function') {
            this.once('after:render', () => {
                callback.call(this);
            });
        }
    }

    showPanel(name, softLockedType, callback) {
        if (!this.hasPanel(name)) {
            return;
        }

        if (this.recordHelper.getPanelStateParam(name, 'hiddenLocked')) {
            return;
        }

        if (softLockedType) {
            let param = 'hidden' + Espo.Utils.upperCaseFirst(softLockedType) + 'Locked';

            this.recordHelper.setPanelStateParam(name, param, false);

            for (let i = 0; i < this.panelSoftLockedTypeList.length; i++) {
                let iType = this.panelSoftLockedTypeList[i];

                if (iType === softLockedType) {
                    continue;
                }

                let iParam = 'hidden' +  Espo.Utils.upperCaseFirst(iType) + 'Locked';

                if (this.recordHelper.getPanelStateParam(name, iParam)) {
                    return;
                }
            }
        }

        let wasShown = this.recordHelper.getPanelStateParam(name, 'hidden') === false;

        this.recordHelper.setPanelStateParam(name, 'hidden', false);

        this.processShowPanel(name, callback, wasShown);
    }

    hidePanel(name, locked, softLockedType, callback) {
        if (!this.hasPanel(name)) {
            return;
        }

        this.recordHelper.setPanelStateParam(name, 'hidden', true);

        if (locked) {
            this.recordHelper.setPanelStateParam(name, 'hiddenLocked', true);
        }

        if (softLockedType) {
            let param = 'hidden' + Espo.Utils.upperCaseFirst(softLockedType) + 'Locked';

            this.recordHelper.setPanelStateParam(name, param, true);
        }

        this.processHidePanel(name, callback);
    }

    alterPanels(layoutData) {
        layoutData = layoutData || this.layoutData || {};

        let tabBreakIndexList = [];

        let tabDataList = [];

        for (let name in layoutData) {
            let item = layoutData[name];

            if (name === '_delimiter_') {
                this.panelList.push({
                    name: name,
                });
            }

            if (item.tabBreak) {
                tabBreakIndexList.push(item.index);

                tabDataList.push({
                    index: item.index,
                    label: item.tabLabel,
                })
            }
        }

        /**
         * @private
         * @type {Object.<string,*>[]}
         */
        this.tabDataList = tabDataList.sort((v1, v2) => v1.index - v2.index);

        let newList = [];

        this.panelList.forEach((item, i) => {
            item.index = ('index' in item) ? item.index : i;

            let allowedInLayout = false;

            if (item.name) {
                let itemData = layoutData[item.name] || {};

                if (itemData.disabled) {
                    return;
                }

                if (layoutData[item.name]) {
                    allowedInLayout = true;
                }

                for (let i in itemData) {
                    item[i] = itemData[i];
                }
            }

            if (item.disabled && !allowedInLayout) {
                return;
            }

            item.tabNumber = tabBreakIndexList.length -
                tabBreakIndexList.slice().reverse().findIndex(index => item.index > index) - 1;

            if (item.tabNumber === tabBreakIndexList.length) {
                item.tabNumber = -1;
            }

            newList.push(item);
        });

        newList.sort((v1, v2) => v1.index - v2.index);

        let firstTabIndex = newList.findIndex(item => item.tabNumber !== -1);

        if (firstTabIndex !== -1) {
            newList[firstTabIndex].isTabsBeginning = true;
            this.hasTabs = true;
            this.currentTab = newList[firstTabIndex].tabNumber;

            this.panelList
                .filter(item => item.tabNumber !== -1 && item.tabNumber !== this.currentTab)
                .forEach(item => {
                    item.tabHidden = true;
                });

            this.panelList
                .forEach((item, i) => {
                    if (
                        item.tabNumber !== -1 &&
                        (i === 0 || this.panelList[i - 1].tabNumber !== item.tabNumber)
                    ) {
                        item.sticked = false;
                    }
                });
        }

        this.panelList = newList;

        if (this.recordViewObject && this.recordViewObject.dynamicLogic) {
            let dynamicLogic = this.recordViewObject.dynamicLogic;

            this.panelList.forEach(item => {
                if (item.dynamicLogicVisible) {
                    dynamicLogic.addPanelVisibleCondition(item.name, item.dynamicLogicVisible);

                    if (this.recordHelper.getPanelStateParam(item.name, 'hidden')) {
                        item.hidden = true;
                    }
                }

                if (item.style && item.style !== 'default' && item.dynamicLogicStyled) {
                    dynamicLogic.addPanelStyledCondition(item.name, item.dynamicLogicStyled);
                }
            });
        }

        if (
            this.hasTabs &&
            this.options.isReturn &&
            this.isStoredTabForThisRecord()
        ) {
            this.selectStoredTab();
        }
    }

    setupPanelsFinal() {
        let afterDelimiter = false;
        let rightAfterDelimiter = false;

        let index = -1;

        this.panelList.forEach((p, i) => {
            if (p.name === '_delimiter_') {
                afterDelimiter = true;
                rightAfterDelimiter = true;
                index = i;

                return;
            }

            if (afterDelimiter) {
                p.hidden = true;
                p.hiddenAfterDelimiter = true;

                this.recordHelper.setPanelStateParam(p.name, 'hidden', true);
                this.recordHelper.setPanelStateParam(p.name, 'hiddenDelimiterLocked', true);
            }

            if (rightAfterDelimiter) {
                p.isRightAfterDelimiter = true;
                rightAfterDelimiter = false;
            }
        });

        if (~index) {
            this.panelList.splice(index, 1);
        }

        this.panelList = this.panelList.filter((p) => {
            return !this.recordHelper.getPanelStateParam(p.name, 'hiddenLocked');
        });

        this.panelsAreSet = true;

        this.trigger('panels-set');
    }

    actionShowMorePanels() {
        this.panelList.forEach(p => {
            if (!p.hiddenAfterDelimiter) {
                return;
            }

            delete p.isRightAfterDelimiter;

            this.showPanel(p.name, 'delimiter');
        });

        this.$el.find('.panels-show-more-delimiter').remove();
    }

    onPanelsReady(callback) {
        Promise.race([
            new Promise(resolve => {
                if (this.panelsAreSet) {
                    resolve();
                }
            }),
            new Promise(resolve => {
                this.once('panels-set', resolve);
            })
        ]).then(() => {
            callback.call(this);
        });
    }

    getTabDataList() {
        return this.tabDataList.map((item, i) => {
            let label = item.label;

            if (!label) {
                label = (i + 1).toString();
            }
            else if (label[0] === '$') {
                label = this.translate(label.substring(1), 'tabs', this.scope);
            }

            let hidden = this.panelList
                .filter(panel => panel.tabNumber === i)
                .findIndex(panel => !this.recordHelper.getPanelStateParam(panel.name, 'hidden')) === -1;

            return {
                label: label,
                isActive: i === this.currentTab,
                hidden: hidden,
            };
        });
    }

    selectTab(tab) {
        this.currentTab = tab;

        if (this.isRendered()) {
            $('body > .popover').remove();

            this.$el.find('.tabs > button').removeClass('active');
            this.$el.find(`.tabs > button[data-tab="${tab}"]`).addClass('active');

            this.$el.find('.panel[data-tab]:not([data-tab="-1"])').addClass('tab-hidden');
            this.$el.find(`.panel[data-tab="${tab}"]`).removeClass('tab-hidden');
        }

        this.adjustPanels();

        this.panelList
            .filter(item => item.tabNumber === tab && item.name)
            .forEach(item => {
                let view = this.getView(item.name);

                if (view) {
                    view.trigger('tab-show');

                    view.propagateEvent('panel-show-propagated');
                }

                item.tabHidden = false;
            });

        this.panelList
            .filter(item => item.tabNumber !== tab && item.name)
            .forEach(item => {
                let view = this.getView(item.name);

                if (view) {
                    view.trigger('tab-hide');
                }

                if (item.tabNumber > -1) {
                    item.tabHidden = true;
                }
            });

        this.storeTab();
    }

    /** @private */
    storeTab() {
        let key = 'tab_' + this.name;
        let keyRecord = 'tab_' + this.name + '_record';

        this.getSessionStorage().set(key, this.currentTab);
        this.getSessionStorage().set(keyRecord, this.entityType + '_' + this.model.id);
    }

    /** @private */
    isStoredTabForThisRecord() {
        let keyRecord = 'tab_' + this.name + '_record';

        return this.getSessionStorage().get(keyRecord) === this.entityType + '_' + this.model.id;
    }

    /** @private */
    selectStoredTab() {
        let key = 'tab_' + this.name;

        let tab = this.getSessionStorage().get(key);

        if (tab > 0) {
            this.selectTab(tab);
        }
    }

    /** @private */
    controlTabVisibilityShow(tab) {
        if (!this.hasTabs) {
            return;
        }

        if (this.isBeingRendered()) {
            this.once('after:render', () => this.controlTabVisibilityShow(tab));

            return;
        }

        this.$el.find(`.tabs > [data-tab="${tab.toString()}"]`).removeClass('hidden');
    }

    /** @private */
    controlTabVisibilityHide(tab) {
        if (!this.hasTabs) {
            return;
        }

        if (this.isBeingRendered()) {
            this.once('after:render', () => this.controlTabVisibilityHide(tab));

            return;
        }

        let panelList = this.panelList.filter(panel => panel.tabNumber === tab);

        let allIsHidden = panelList
            .findIndex(panel => !this.recordHelper.getPanelStateParam(panel.name, 'hidden')) === -1;

        if (!allIsHidden) {
            return;
        }

        let $tab = this.$el.find(`.tabs > [data-tab="${tab.toString()}"]`);

        $tab.addClass('hidden');

        if (this.currentTab === tab) {
            let firstVisiblePanel = this.panelList
                .find(panel => panel.tabNumber > -1 && !panel.hidden);

            let firstVisibleTab = firstVisiblePanel ?
                firstVisiblePanel.tabNumber : 0;

            this.selectTab(firstVisibleTab);
        }
    }
}

export default PanelsContainerRecordView;

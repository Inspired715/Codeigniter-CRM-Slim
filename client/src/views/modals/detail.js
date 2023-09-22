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

/** @module views/modals/detail */

import ModalView from 'views/modal';
import ActionItemSetup from 'helpers/action-item-setup';
import Backbone from 'backbone';

/**
 * A quick view modal.
 */
class DetailModalView extends ModalView {

    template = 'modals/detail'

    cssName = 'detail-modal'
    className = 'dialog dialog-record'
    editDisabled = false
    fullFormDisabled = false
    detailView = null
    removeDisabled = true
    backdrop = true
    fitHeight = true
    sideDisabled = false
    bottomDisabled = false
    fixedHeaderHeight = true
    flexibleHeaderFontSize = true
    duplicateAction = false

    shortcutKeys = {
        /** @this DetailModalView */
        'Control+Space': function (e) {
            if (this.editDisabled) {
                return;
            }

            if (e.target.tagName === 'TEXTAREA' || e.target.tagName === 'INPUT') {
                return;
            }

            if (this.buttonList.findIndex(item => item.name === 'edit') === -1) {
                return;
            }

            e.stopPropagation();
            e.preventDefault();

            this.actionEdit()
                .then(view => {
                    view.$el
                        .find('.form-control:not([disabled])')
                        .first()
                        .focus();
                });
        },
        /** @this DetailModalView */
        'Control+Backslash': function (e) {
            this.getRecordView().handleShortcutKeyControlBackslash(e);
        },
        /** @this DetailModalView */
        'Control+ArrowLeft': function (e) {
            this.handleShortcutKeyControlArrowLeft(e);
        },
        /** @this DetailModalView */
        'Control+ArrowRight': function (e) {
            this.handleShortcutKeyControlArrowRight(e);
        },
    }

    setup() {
        this.scope = this.scope || this.options.scope;
        this.id = this.options.id;

        this.buttonList = [];

        if ('editDisabled' in this.options) {
            this.editDisabled = this.options.editDisabled;
        }

        if ('removeDisabled' in this.options) {
            this.removeDisabled = this.options.removeDisabled;
        }

        this.editDisabled = this.getMetadata().get(['clientDefs', this.scope, 'editDisabled']) ||
            this.editDisabled;
        this.removeDisabled = this.getMetadata().get(['clientDefs', this.scope, 'removeDisabled']) ||
            this.removeDisabled;

        this.fullFormDisabled = this.options.fullFormDisabled || this.fullFormDisabled;
        this.layoutName = this.options.layoutName || this.layoutName;

        this.setupRecordButtons();

        if (this.model) {
            this.controlRecordButtonsVisibility();
        }

        if (!this.fullFormDisabled) {
            this.buttonList.push({
                name: 'fullForm',
                label: 'Full Form',
            });
        }

        this.buttonList.push({
            name: 'cancel',
            label: 'Close',
            title: 'Esc',
        });

        if (this.model && this.model.collection && !this.navigateButtonsDisabled) {
            this.buttonList.push({
                name: 'previous',
                html: '<span class="fas fa-chevron-left"></span>',
                title: this.translate('Previous Entry'),
                position: 'right',
                className: 'btn-icon',
                style: 'text',
                disabled: true,
            });

            this.buttonList.push({
                name: 'next',
                html: '<span class="fas fa-chevron-right"></span>',
                title: this.translate('Next Entry'),
                position: 'right',
                className: 'btn-icon',
                style: 'text',
                disabled: true,
            });

            this.indexOfRecord = this.model.collection.indexOf(this.model);
        }
        else {
            this.navigateButtonsDisabled = true;
        }

        this.waitForView('record');

        this.sourceModel = this.model;

        this.getModelFactory().create(this.scope).then(model => {
            if (!this.sourceModel) {
                this.model = model;
                this.model.id = this.id;

                this.setupAfterModelCreated();

                this.listenTo(this.model, 'sync', () => {
                    this.controlRecordButtonsVisibility();

                    this.trigger('model-sync');
                });

                this.listenToOnce(this.model, 'sync', () => {
                    this.setupActionItems();
                    this.createRecordView();
                });

                this.model.fetch();

                return;
            }

            this.model = this.sourceModel.clone();
            this.model.collection = this.sourceModel.collection.clone();

            this.setupAfterModelCreated();

            this.listenTo(this.model, 'change', () => {
                this.sourceModel.set(this.model.getClonedAttributes());
            });

            this.listenTo(this.model, 'sync', () => {
                this.controlRecordButtonsVisibility();

                this.trigger('model-sync');
            });

            this.once('after:render', () => {
                this.model.fetch();
            });

            this.setupActionItems();
            this.createRecordView();
        });

        this.listenToOnce(this.getRouter(), 'routed', () => {
            this.remove();
        });

        if (this.duplicateAction && this.getAcl().checkScope(this.scope, 'create')) {
            this.addDropdownItem({
                name: 'duplicate',
                label: 'Duplicate',
            });
        }
    }

    /** @private */
    setupActionItems() {
        let actionItemSetup = new ActionItemSetup(
            this.getMetadata(),
            this.getHelper(),
            this.getAcl(),
            this.getLanguage()
        );

        actionItemSetup.setup(
            this,
            'modalDetail',
            promise => this.wait(promise),
            item => this.addDropdownItem(item),
            name => this.showActionItem(name),
            name => this.hideActionItem(name),
            {listenToViewModelSync: true}
        );
    }

    /**
     * @protected
     */
    setupAfterModelCreated() {}

    /**
     * @protected
     */
    setupRecordButtons() {
        if (!this.removeDisabled) {
            this.addRemoveButton();
        }

        if (!this.editDisabled) {
            this.addEditButton();
        }
    }

    controlRecordButtonsVisibility() {
        if (this.getAcl().check(this.model, 'edit')) {
            this.showButton('edit');
        } else {
            this.hideButton('edit');
        }

        if (this.getAcl().check(this.model, 'delete')) {
            this.showActionItem('remove');
        } else {
            this.hideActionItem('remove');
        }
    }

    addEditButton() {
        this.addButton({
            name: 'edit',
            label: 'Edit',
            title: 'Ctrl+Space',
        }, true);
    }

    removeEditButton() {
        this.removeButton('edit');
    }

    addRemoveButton() {
        this.addDropdownItem({
            name: 'remove',
            label: 'Remove',
        });
    }

    removeRemoveButton() {
        this.removeButton('remove');
    }

    getScope() {
        return this.scope;
    }

    createRecordView(callback) {
        let model = this.model;
        let scope = this.getScope();

        this.headerHtml = '';

        this.headerHtml += $('<span>')
            .text(this.getLanguage().translate(scope, 'scopeNames'))
            .get(0).outerHTML;

        if (model.get('name')) {
            this.headerHtml += ' ' +
                $('<span>')
                    .addClass('chevron-right')
                    .get(0).outerHTML;

            this.headerHtml += ' ' +
                $('<span>')
                    .text(model.get('name'))
                    .get(0).outerHTML;
        }

        if (!this.fullFormDisabled) {
            let url = '#' + scope + '/view/' + this.id;

            this.headerHtml =
                $('<a>')
                    .attr('href', url)
                    .addClass('action font-size-flexible')
                    .attr('title', this.translate('Full Form'))
                    .attr('data-action', 'fullForm')
                    .append(this.headerHtml)
                    .get(0).outerHTML;
        }

        this.headerHtml = this.getHelper().getScopeColorIconHtml(this.scope) + this.headerHtml;

        if (!this.editDisabled) {
            let editAccess = this.getAcl().check(model, 'edit', true);

            if (editAccess) {
                this.showButton('edit');
            } else {
                this.hideButton('edit');

                if (editAccess === null) {
                    this.listenToOnce(model, 'sync', () => {
                        if (this.getAcl().check(model, 'edit')) {
                            this.showButton('edit');
                        }
                    });
                }
            }
        }

        if (!this.removeDisabled) {
            var removeAccess = this.getAcl().check(model, 'delete', true);

            if (removeAccess) {
                this.showButton('remove');
            }
            else {
                this.hideButton('remove');

                if (removeAccess === null) {
                    this.listenToOnce(model, 'sync', () => {
                        if (this.getAcl().check(model, 'delete')) {
                            this.showButton('remove');
                        }
                    });
                }
            }
        }

        let viewName =
            this.detailViewName ||
            this.detailView ||
            this.getMetadata().get(['clientDefs', model.entityType, 'recordViews', 'detailSmall']) ||
            this.getMetadata().get(['clientDefs', model.entityType, 'recordViews', 'detailQuick']) ||
            'views/record/detail-small';

        let options = {
            model: model,
            fullSelector: this.containerSelector + ' .record-container',
            type: 'detailSmall',
            layoutName: this.layoutName || 'detailSmall',
            buttonsDisabled: true,
            inlineEditDisabled: true,
            sideDisabled: this.sideDisabled,
            bottomDisabled: this.bottomDisabled,
            exit: function () {},
        };

        this.createView('record', viewName, options, callback);
    }

    /**
     * @return {module:views/record/detail}
     */
    getRecordView() {
        return this.getView('record');
    }

    afterRender() {
        super.afterRender();

        setTimeout(() => {
            this.$el.children(0).scrollTop(0);
        }, 50);

        if (!this.navigateButtonsDisabled) {
            this.controlNavigationButtons();
        }
    }

    controlNavigationButtons() {
        let recordView = this.getRecordView();

        if (!recordView) {
            return;
        }

        let indexOfRecord = this.indexOfRecord;

        let previousButtonEnabled = false;
        let nextButtonEnabled = false;

        if (indexOfRecord > 0) {
            previousButtonEnabled = true;
        }

        if (indexOfRecord < this.model.collection.total - 1) {
            nextButtonEnabled = true;
        }
        else {
            if (this.model.collection.total === -1) {
                nextButtonEnabled = true;
            } else if (this.model.collection.total === -2) {
                if (indexOfRecord < this.model.collection.length - 1) {
                    nextButtonEnabled = true;
                }
            }
        }

        if (previousButtonEnabled) {
            this.enableButton('previous');
        } else {
            this.disableButton('previous');
        }

        if (nextButtonEnabled) {
            this.enableButton('next');
        } else {
             this.disableButton('next');
        }
    }

    switchToModelByIndex(indexOfRecord) {
        if (!this.model.collection) {
            return;
        }

        let previousModel = this.model;

        this.sourceModel = this.model.collection.at(indexOfRecord);

        if (!this.sourceModel) {
            throw new Error("Model is not found in collection by index.");
        }

        this.indexOfRecord = indexOfRecord;

        this.id = this.sourceModel.id;
        this.scope = this.sourceModel.entityType;

        this.model = this.sourceModel.clone();
        this.model.collection = this.sourceModel.collection.clone();

        this.stopListening(previousModel, 'change');
        this.stopListening(previousModel, 'sync');

        this.listenTo(this.model, 'change', () => {
            this.sourceModel.set(this.model.getClonedAttributes());
        });

        this.listenTo(this.model, 'sync', () => {
            this.controlRecordButtonsVisibility();

            this.trigger('model-sync');
        });

        this.createRecordView(() => {
            this.reRender()
                .then(() => {
                    this.model.fetch();
                })
        });

        this.controlNavigationButtons();
        this.trigger('switch-model', this.model, previousModel);
    }

    actionPrevious() {
        if (!this.model.collection) {
            return;
        }

        if (!(this.indexOfRecord > 0)) {
            return;
        }

        let indexOfRecord = this.indexOfRecord - 1;

        this.switchToModelByIndex(indexOfRecord);
    }

    actionNext() {
        if (!this.model.collection) {
            return;
        }

        if (!(this.indexOfRecord < this.model.collection.total - 1) && this.model.collection.total >= 0) {
            return;
        }

        if (this.model.collection.total === -2 && this.indexOfRecord >= this.model.collection.length - 1) {
            return;
        }

        let collection = this.model.collection;

        let indexOfRecord = this.indexOfRecord + 1;

        if (indexOfRecord <= collection.length - 1) {
            this.switchToModelByIndex(indexOfRecord);

            return;
        }

        collection
            .fetch({
                more: true,
                remove: false,
            })
            .then(() => {
                this.switchToModelByIndex(indexOfRecord);
            });
    }

    /**
     * @return {Promise}
     */
    actionEdit() {
        if (this.options.quickEditDisabled) {
            let options = {
                id: this.id,
                model: this.model,
                returnUrl: this.getRouter().getCurrentUrl(),
            };

            if (this.options.rootUrl) {
                options.rootUrl = this.options.rootUrl;
            }

            this.getRouter().navigate('#' + this.scope + '/edit/' + this.id, {trigger: false});
            this.getRouter().dispatch(this.scope, 'edit', options);

            return Promise.reject();
        }

        let viewName = this.getMetadata().get(['clientDefs', this.scope, 'modalViews', 'edit']) ||
            'views/modals/edit';

        Espo.Ui.notify(' ... ');

        return new Promise(resolve => {
            this.createView('quickEdit', viewName, {
                scope: this.scope,
                entityType: this.model.entityType,
                id: this.id,
                fullFormDisabled: this.fullFormDisabled
            }, view => {
                this.listenToOnce(view, 'remove', () => {
                    this.dialog.show();
                });

                this.listenToOnce(view, 'leave', () => {
                    this.remove();
                });

                this.listenTo(view, 'after:save', (model, o) => {
                    this.model.set(model.getClonedAttributes());

                    this.trigger('after:save', model, o);
                    this.controlRecordButtonsVisibility();

                    this.trigger('model-sync');
                });

                view.render()
                    .then(() => {
                        Espo.Ui.notify(false);
                        this.dialog.hide();

                        resolve(view);
                    });
            });
        });
    }

    actionRemove() {
        let model = this.getRecordView().model;

        this.confirm(this.translate('removeRecordConfirmation', 'messages'), () => {
            let $buttons = this.dialog.$el.find('.modal-footer button');

            $buttons.addClass('disabled').attr('disabled', 'disabled');

            model.destroy()
                .then(() => {
                    this.trigger('after:destroy', model);
                    this.dialog.close();
                })
                .catch(() => {
                    $buttons.removeClass('disabled').removeAttr('disabled');
                });
        });
    }

    actionFullForm() {
        let url;
        let router = this.getRouter();

        let scope = this.getScope();

        url = '#' + scope + '/view/' + this.id;

        let attributes = this.getRecordView().fetch();
        let model = this.getRecordView().model;

        attributes = _.extend(attributes, model.getClonedAttributes());

        let options = {
            attributes: attributes,
            returnUrl: Backbone.history.fragment,
            model: this.sourceModel || this.model,
            id: this.id,
        };

        if (this.options.rootUrl) {
            options.rootUrl = this.options.rootUrl;
        }

        setTimeout(() => {
            router.dispatch(scope, 'view', options);
            router.navigate(url, {trigger: false});
        }, 10);

        this.trigger('leave');
        this.dialog.close();
    }

    actionDuplicate() {
        Espo.Ui.notify(' ... ');

        Espo.Ajax
            .postRequest(this.scope + '/action/getDuplicateAttributes', {id: this.model.id})
            .then(attributes => {
                Espo.Ui.notify(false);

                let url = '#' + this.scope + '/create';

                this.getRouter().dispatch(this.scope, 'create', {
                    attributes: attributes,
                    returnUrl: this.getRouter().getCurrentUrl(),
                    options: {
                        duplicateSourceId: this.model.id,
                        returnAfterCreate: true,
                    },
                });

                this.getRouter().navigate(url, {trigger: false});
            });
    }

    /**
     * @protected
     * @param {JQueryKeyEventObject} e
     */
    handleShortcutKeyControlArrowLeft(e) {
        if (!this.model.collection) {
            return;
        }

        if (this.buttonList.findIndex(item => item.name === 'previous' && !item.disabled) === -1) {
            return;
        }

        if (e.target.tagName === 'TEXTAREA' || e.target.tagName === 'INPUT') {
            return;
        }

        e.preventDefault();
        e.stopPropagation();

        this.actionPrevious();
    }

    /**
     * @protected
     * @param {JQueryKeyEventObject} e
     */
    handleShortcutKeyControlArrowRight(e) {
        if (!this.model.collection) {
            return;
        }

        if (this.buttonList.findIndex(item => item.name === 'next' && !item.disabled) === -1) {
            return;
        }

        if (e.target.tagName === 'TEXTAREA' || e.target.tagName === 'INPUT') {
            return;
        }

        e.preventDefault();
        e.stopPropagation();

        this.actionNext();
    }
}

export default DetailModalView;

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

/** @module views/record/edit */

import DetailRecordView from 'views/record/detail';

/**
 * An edit-record view. Used for create and edit.
 */
class EditRecordView extends DetailRecordView {

    /** @inheritDoc */
    template = 'record/edit'

    /** @inheritDoc */
    type = 'edit'
    /** @inheritDoc */
    fieldsMode = 'edit'
    /** @inheritDoc */
    mode = 'edit'
    /** @inheritDoc */
    buttonList = [
        {
            name: 'save',
            label: 'Save',
            style: 'primary',
            title: 'Ctrl+Enter',
        },
        {
            name: 'cancel',
            label: 'Cancel',
            title: 'Esc',
        }
    ]
    /** @inheritDoc */
    dropdownItemList = []
    /** @inheritDoc */
    sideView = 'views/record/edit-side'
    /** @inheritDoc */
    bottomView = 'views/record/edit-bottom'
    /** @inheritDoc */
    duplicateAction = false
    /** @inheritDoc */
    saveAndContinueEditingAction = true
    /** @inheritDoc */
    saveAndNewAction = true
    /** @inheritDoc */
    setupHandlerType = 'record/edit'

    /**
     * @param {
     *     module:views/record/detail~options |
     *     {
     *         duplicateSourceId?: string,
     *         focusForCreate?: boolean,
     *     }
     * } options Options.
     */
    constructor(options) {
        super(options);
    }

    /** @inheritDoc */
    actionSave(data) {
        data = data || {};

        let isNew = this.isNew;

        return this.save(data.options)
            .then(() => {
                if (this.options.duplicateSourceId) {
                    this.returnUrl = null;
                }

                this.exit(isNew ? 'create' : 'save');
            })
            .catch(() => {});
    }

    /**
     * A `cancel` action.
     */
    actionCancel() {
        this.cancel();
    }

    /**
     * Cancel.
     */
    cancel() {
        if (this.isChanged) {
            this.resetModelChanges();
        }

        this.setIsNotChanged();
        this.exit('cancel');
    }

    /** @inheritDoc */
    setupBeforeFinal() {
        if (this.model.isNew()) {
            this.populateDefaults();
        }

        super.setupBeforeFinal();

        if (this.model.isNew()) {
            this.once('after:render', () => {
                this.model.set(this.fetch(), {silent: true});
            })
        }

        if (this.options.focusForCreate) {
            this.once('after:render', () => {
                if (this.$el.closest('.modal').length) {
                    setTimeout(() => this.focusForCreate(), 50);

                    return;
                }

                this.focusForCreate();
            });
        }
    }

    /** @inheritDoc */
    setupActionItems() {
        super.setupActionItems();

        if (
            this.saveAndContinueEditingAction &&
            this.getAcl().checkScope(this.entityType, 'edit')
        ) {
            this.dropdownItemList.push({
                name: 'saveAndContinueEditing',
                label: 'Save & Continue Editing',
                title: 'Ctrl+S',
            });
        }

        if (
            this.isNew &&
            this.saveAndNewAction &&
            this.getAcl().checkScope(this.entityType, 'create')
        ) {
            this.dropdownItemList.push({
                name: 'saveAndNew',
                label: 'Save & New',
                title: 'Ctrl+Alt+Enter',
            });
        }
    }

    /**
     * A `save-and-create-new` action.
     */
    actionSaveAndNew(data) {
        data = data || {};

        let proceedCallback = () => {
            Espo.Ui.success(this.translate('Created'));

            this.getRouter().dispatch(this.scope, 'create', {
                rootUrl: this.options.rootUrl,
                focusForCreate: !!data.focusForCreate,
            });

            this.getRouter().navigate('#' + this.scope + '/create', {trigger: false});
        };

        this.save(data.options)
            .then(proceedCallback)
            .catch(() => {});

        if (this.lastSaveCancelReason === 'notModified') {
             proceedCallback();
        }
    }

    /**
     * @protected
     * @param {JQueryKeyEventObject} e
     */
    handleShortcutKeyEscape(e) {
        if (this.buttonsDisabled) {
            return;
        }

        if (this.buttonList.findIndex(item => item.name === 'cancel' && !item.hidden) === -1) {
            return;
        }

        e.preventDefault();
        e.stopPropagation();

        let focusedFieldView = this.getFocusedFieldView();

        if (focusedFieldView) {
            this.model.set(focusedFieldView.fetch());
        }

        if (this.isChanged) {
            this.confirm(this.translate('confirmLeaveOutMessage', 'messages'))
                .then(() => this.actionCancel());

            return;
        }

        this.actionCancel();
    }

    /**
     * @protected
     * @param {JQueryKeyEventObject} e
     */
    handleShortcutKeyCtrlAltEnter(e) {
        if (this.buttonsDisabled) {
            return;
        }

        e.preventDefault();
        e.stopPropagation();

        if (!this.saveAndNewAction) {
            return;
        }

        if (!this.hasAvailableActionItem('saveAndNew')) {
            return;
        }

        this.actionSaveAndNew({focusForCreate: true});
    }
}

export default EditRecordView;

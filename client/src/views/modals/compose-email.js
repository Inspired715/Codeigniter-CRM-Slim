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

import EditModalView from 'views/modals/edit';

class ComposeEmailModalView extends EditModalView {

    scope = 'Email'
    layoutName = 'composeSmall'
    saveDisabled = true
    fullFormDisabled = true
    isCollapsable = true
    wasModified = false

    shortcutKeys = {
        /** @this ComposeEmailModalView */
        'Control+Enter': function (e) {
            if (this.buttonList.findIndex(item => item.name === 'send' && !item.hidden) === -1) {
                return;
            }

            e.stopPropagation();
            e.preventDefault();

            this.actionSend();
        },
        /** @this ComposeEmailModalView */
        'Control+KeyS': function (e) {
            if (this.buttonList.findIndex(item => item.name === 'saveDraft' && !item.hidden) === -1) {
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            this.actionSaveDraft();
        },
        /** @this ComposeEmailModalView */
        'Escape': function (e) {
            e.stopPropagation();
            e.preventDefault();

            let focusedFieldView = this.getRecordView().getFocusedFieldView();

            if (focusedFieldView) {
                this.model.set(focusedFieldView.fetch());
            }

            if (this.getRecordView().isChanged) {
                this.confirm(this.translate('confirmLeaveOutMessage', 'messages'))
                    .then(() => this.actionClose());

                return;
            }

            this.actionClose();
        },
    }

    setup() {
        super.setup();

        this.buttonList.unshift({
            name: 'saveDraft',
            text: this.translate('Save Draft', 'labels', 'Email'),
            title: 'Ctrl+S',
        });

        this.buttonList.unshift({
            name: 'send',
            text: this.translate('Send', 'labels', 'Email'),
            style: 'primary',
            title: 'Ctrl+Enter',
        });

        this.$header = $('<a>')
            .attr('role', 'button')
            .attr('tabindex', '0')
            .attr('data-action', 'fullFormDraft')
            .text(this.getLanguage().translate('Compose Email'));

        this.events['click a[data-action="fullFormDraft"]'] = () => this.actionFullFormDraft();

        if (
            this.getConfig().get('emailForceUseExternalClient') ||
            this.getPreferences().get('emailUseExternalClient') ||
            !this.getAcl().checkScope('Email', 'create')
        ) {
            var attributes = this.options.attributes || {};

            Espo.loader.require('email-helper', EmailHelper => {
                this.getRouter().confirmLeaveOut = false;

                let emailHelper = new EmailHelper();

                document.location.href = emailHelper
                    .composeMailToLink(attributes, this.getConfig().get('outboundEmailBccAddress'));
            });

            this.once('after:render', () => {
                this.actionClose();
            });

            return;
        }

        this.once('remove', () => {
            this.dialogIsHidden = false;
        });

        this.listenTo(this.model, 'change', (m, o) => {
            if (o.ui) {
                this.wasModified = true;
            }
        });
    }

    createRecordView(model, callback) {
        let viewName = this.getMetadata().get('clientDefs.' + model.entityType + '.recordViews.compose') ||
            'views/email/record/compose';

        let options = {
            model: model,
            fullSelector: this.containerSelector + ' .edit-container',
            type: 'editSmall',
            layoutName: this.layoutName || 'detailSmall',
            buttonsDisabled: true,
            selectTemplateDisabled: this.options.selectTemplateDisabled,
            removeAttachmentsOnSelectTemplate: this.options.removeAttachmentsOnSelectTemplate,
            signatureDisabled: this.options.signatureDisabled,
            appendSignature: this.options.appendSignature,
            focusForCreate: this.options.focusForCreate,
            exit: () => {},
        };

        this.createView('edit', viewName, options, callback);
    }

    actionSend() {
        let dialog = this.dialog;

        /** @type {module:views/email/record/edit} editView */
        let editView = this.getRecordView();

        let model = editView.model;

        let afterSend = () => {
            this.dialogIsHidden = false;

            this.trigger('after:save', model);
            this.trigger('after:send', model);

            dialog.close();

            this.stopListening(editView, 'before:save', beforeSave);
            this.stopListening(editView, 'error:save', errorSave);

            this.remove();
        };

        let beforeSave = () => {
            this.dialogIsHidden = true;

            dialog.hideWithBackdrop();

            editView.setConfirmLeaveOut(false);

            if (!this.forceRemoveIsInitiated) {
                this.initiateForceRemove();
            }
        };

        let errorSave = () => {
            this.dialogIsHidden = false;

            if (this.isRendered()) {
                dialog.show();
            }
        };

        this.listenToOnce(editView, 'after:send', afterSend);

        this.disableButton('send');
        this.disableButton('saveDraft');

        this.listenToOnce(editView, 'cancel:save', () => {
            this.enableButton('send');
            this.enableButton('saveDraft');

            this.stopListening(editView, 'after:send', afterSend);

            this.stopListening(editView, 'before:save', beforeSave);
            this.stopListening(editView, 'error:save', errorSave);
        });

        this.listenToOnce(editView, 'before:save', beforeSave);
        this.listenToOnce(editView, 'error:save', errorSave);

        editView.send();
    }

    actionSaveDraft(options) {
        /** @type {module:views/email/record/edit} editView */
        let editView = this.getRecordView();

        let model = editView.model;

        this.disableButton('send');
        this.disableButton('saveDraft');

        let afterSave = () => {
            this.enableButton('send');
            this.enableButton('saveDraft');

            Espo.Ui.success(this.translate('savedAsDraft', 'messages', 'Email'))

            this.trigger('after:save', model);

            this.$el.find('button[data-name="cancel"]').html(this.translate('Close'));
        };

        editView.once('after:save', () => afterSave());

        editView.once('cancel:save', () => {
            this.enableButton('send');
            this.enableButton('saveDraft');

            editView.off('after:save', afterSave);
        });

        return editView.saveDraft(options);
    }

    initiateForceRemove() {
        this.forceRemoveIsInitiated = true;

        let parentView = this.getParentView();

        if (!parentView) {
            return true;
        }

        parentView.once('remove', () => {
            if (!this.dialogIsHidden) {
                return;
            }

            this.remove();
        });
    }

    actionFullFormDraft() {
        this.actionSaveDraft()
            .then(() => {
                this.getRouter().navigate('#Email/edit/' + this.model.id, {trigger: true});

                this.close();
            })
            .catch(reason => {
                if (reason === 'notModified') {
                    Espo.Ui.notify(false);

                    this.getRouter().navigate('#Email/edit/' + this.model.id, {trigger: true});
                }
            });
    }

    beforeCollapse() {
        if (this.wasModified) {
            this.actionSaveDraft({skipNotModifiedWarning: true});
        }

        this.getRecordView().setConfirmLeaveOut(false);

        return super.beforeCollapse();
    }
}

export default ComposeEmailModalView;

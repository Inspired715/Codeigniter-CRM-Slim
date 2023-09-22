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

define('crm:views/meeting/modals/detail', ['views/modals/detail', 'lib!moment'], function (Dep, moment) {

    return Dep.extend({

        duplicateAction: true,

        setupAfterModelCreated: function () {
            Dep.prototype.setupAfterModelCreated.call(this);

            let buttonData = this.getAcceptanceButtonData();

            this.addButton({
                name: 'setAcceptanceStatus',
                html: buttonData.html,
                hidden: this.hasAcceptanceStatusButton(),
                style: buttonData.style,
                className: 'btn-text',
                pullLeft: true,
            }, 'cancel');

            if (
                !~this.getAcl().getScopeForbiddenFieldList(this.model.entityType).indexOf('status')
            ) {
                this.addDropdownItem({
                    name: 'setHeld',
                    text: this.translate('Set Held', 'labels', this.model.entityType),
                    hidden: true,
                });

                this.addDropdownItem({
                    name: 'setNotHeld',
                    text: this.translate('Set Not Held', 'labels', this.model.entityType),
                    hidden: true,
                });
            }

            this.addDropdownItem({
                name: 'sendInvitations',
                text: this.translate('Send Invitations', 'labels', 'Meeting'),
                hidden: !this.isSendInvitationsToBeDisplayed(),
            });

            this.initAcceptanceStatus();

            this.on('switch-model', (model, previousModel) => {
                this.stopListening(previousModel, 'sync');
                this.initAcceptanceStatus();
            });

            this.on('after:save', () => {
                if (this.hasAcceptanceStatusButton()) {
                    this.showAcceptanceButton();
                } else {
                    this.hideAcceptanceButton();
                }

                if (this.isSendInvitationsToBeDisplayed()) {
                    this.showActionItem('sendInvitations');
                } else {
                    this.hideActionItem('sendInvitations');
                }
            });

            this.listenTo(this.model, 'sync', () => {
                if (this.isSendInvitationsToBeDisplayed()) {
                    this.showActionItem('sendInvitations');

                    return;
                }

                this.hideActionItem('sendInvitations');
            });

            this.listenTo(this.model, 'after:save', () => {
                if (this.isSendInvitationsToBeDisplayed()) {
                    this.showActionItem('sendInvitations');

                    return;
                }

                this.hideActionItem('sendInvitations');
            });
        },

        controlRecordButtonsVisibility: function () {
            Dep.prototype.controlRecordButtonsVisibility.call(this);

            this.controlStatusActionVisibility();
        },

        controlStatusActionVisibility: function () {
            if (this.getAcl().check(this.model, 'edit') && !~['Held', 'Not Held'].indexOf(this.model.get('status'))) {
                this.showActionItem('setHeld');
                this.showActionItem('setNotHeld');
            } else {
                this.hideActionItem('setHeld');
                this.hideActionItem('setNotHeld');
            }
        },

        hasSetStatusButton: function () {

        },

        initAcceptanceStatus: function () {
            if (this.hasAcceptanceStatusButton()) {
                this.showAcceptanceButton();
            } else {
                this.hideAcceptanceButton();
            }

            this.listenTo(this.model, 'sync', () => {
                if (this.hasAcceptanceStatusButton()) {
                    this.showAcceptanceButton();
                } else {
                    this.hideAcceptanceButton();
                }
            });
        },

        getAcceptanceButtonData: function () {
            let acceptanceStatus = this.model.getLinkMultipleColumn('users', 'status', this.getUser().id);

            let text;
            let style = 'default';

            let iconHtml = null;

            if (acceptanceStatus && acceptanceStatus !== 'None') {
                text = this.getLanguage().translateOption(acceptanceStatus, 'acceptanceStatus', this.model.entityType);

                style = this.getMetadata()
                    .get(['entityDefs', this.model.entityType,
                        'fields', 'acceptanceStatus', 'style', acceptanceStatus]);

                if (style) {
                    let iconClass = ({
                        'success': 'fas fa-check-circle',
                        'danger': 'fas fa-times-circle',
                        'warning': 'fas fa-question-circle',
                    })[style];

                    iconHtml = $('<span>')
                        .addClass(iconClass)
                        .addClass('text-' + style)
                        .get(0).outerHTML;
                }
            } else {
                text = typeof acceptanceStatus !== 'undefined' ?
                    this.translate('Acceptance', 'labels', 'Meeting') :
                    ' ';
            }

            let html = this.getHelper().escapeString(text);

            if (iconHtml) {
                html = iconHtml + ' ' + html;
            }

            return {
                style: style,
                text: text,
                html: html,
            };
        },

        showAcceptanceButton: function () {
            this.showActionItem('setAcceptanceStatus');

            if (!this.isRendered()) {
                this.once('after:render', this.showAcceptanceButton, this);

                return;
            }

            let data = this.getAcceptanceButtonData();

            let $button = this.$el.find('.modal-footer [data-name="setAcceptanceStatus"]');

            $button.html(data.html);

            $button.removeClass('btn-default');
            $button.removeClass('btn-success');
            $button.removeClass('btn-warning');
            $button.removeClass('btn-info');
            $button.removeClass('btn-primary');
            $button.removeClass('btn-danger');
            $button.addClass('btn-' + data.style);
        },

        hideAcceptanceButton: function () {
            this.hideActionItem('setAcceptanceStatus');
        },

        hasAcceptanceStatusButton: function () {
            if (!this.model.has('status')) {
                return false;
            }

            if (!this.model.has('usersIds')) {
                return false;
            }

            if (~['Held', 'Not Held'].indexOf(this.model.get('status'))) {
                return false;
            }

            if (!~this.model.getLinkMultipleIdList('users').indexOf(this.getUser().id)) {
                return false;
            }
            return true;
        },

        actionSetAcceptanceStatus: function () {
            this.createView('dialog', 'crm:views/meeting/modals/acceptance-status', {
                model: this.model,
            }, (view) => {
                view.render();

                this.listenTo(view, 'set-status', (status) => {
                    this.hideAcceptanceButton();

                    Espo.Ajax.postRequest(this.model.entityType + '/action/setAcceptanceStatus', {
                        id: this.model.id,
                        status: status,
                    }).then(() => {
                        this.model.fetch()
                            .then(() => {
                                setTimeout(() => {
                                    this.$el.find(`button[data-name="setAcceptanceStatus"]`).focus();
                                }, 50)
                            });
                    });
                });
            });
        },

        actionSetHeld: function () {
            this.model.save({status: 'Held'});
            this.trigger('after:save', this.model);
        },

        actionSetNotHeld: function () {
            this.model.save({status: 'Not Held'});
            this.trigger('after:save', this.model);
        },

        isSendInvitationsToBeDisplayed: function () {
            if (~['Held', 'Not Held'].indexOf(this.model.get('status'))) {
                return false;
            }

            let dateEnd = this.model.get('dateEnd');

            if (
                dateEnd &&
                this.getDateTime().toMoment(dateEnd).isBefore(moment.now())
            ) {
                return false;
            }

            if (!this.getAcl().checkModel(this.model, 'edit')) {
                return false;
            }

            let userIdList = this.model.getLinkMultipleIdList('users');
            let contactIdList = this.model.getLinkMultipleIdList('contacts');
            let leadIdList = this.model.getLinkMultipleIdList('leads');

            if (!contactIdList.length && !leadIdList.length && !userIdList.length) {
                return false;
            }

            return true;
        },

        actionSendInvitations: function () {
            Espo.Ui.notify(' ... ');

            this.createView('dialog', 'crm:views/meeting/modals/send-invitations', {
                model: this.model,
            }).then(view => {
                Espo.Ui.notify(false);

                view.render();

                this.listenToOnce(view, 'sent', () => this.model.fetch());
            });
        },
    });
});

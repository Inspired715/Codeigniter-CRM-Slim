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

/** @module views/email/record/list */

import ListRecordView from 'views/record/list';
import MassActionHelper from 'helpers/mass-action';

class EmailListRecordView extends ListRecordView {

    rowActionsView = 'views/email/record/row-actions/default'

    massActionList = ['remove', 'massUpdate']

    setup() {
        super.setup();

        if (this.collection.url === this.entityType) {
            this.addMassAction('retrieveFromTrash', false, true);
            this.addMassAction('moveToFolder', true, true);
            this.addMassAction('markAsNotImportant', false, true);
            this.addMassAction('markAsImportant', false, true);
            this.addMassAction('markAsNotRead', false, true);
            this.addMassAction('markAsRead', false, true);
            this.addMassAction('moveToTrash', false, true);

            this.dropdownItemList.push({
                name: 'markAllAsRead',
                label: 'Mark all as read',
            });
        }

        this.listenTo(this.collection, 'moving-to-trash', (id) => {
            let model = this.collection.get(id);

            if (model) {
                model.set('inTrash', true);
            }

            if (this.collection.selectedFolderId !== 'trash' && this.collection.selectedFolderId !== 'all') {
                this.removeRecordFromList(id);
            }
        });

        this.listenTo(this.collection, 'retrieving-from-trash', (id) => {
            let model = this.collection.get(id);

            if (model) {
                model.set('inTrash', false);
            }

            if (this.collection.selectedFolderId === 'trash') {
                this.removeRecordFromList(id);
            }
        });
    }

    // noinspection JSUnusedGlobalSymbols
    massActionMarkAsRead() {
        let ids = [];

        for (let i in this.checkedList) {
            ids.push(this.checkedList[i]);
        }

        Espo.Ajax.postRequest('Email/inbox/read', {ids: ids});

        ids.forEach(id => {
            let model = this.collection.get(id);

            if (model) {
                model.set('isRead', true);
            }
        });
    }

    // noinspection JSUnusedGlobalSymbols
    massActionMarkAsNotRead() {
        let ids = [];

        for (let i in this.checkedList) {
            ids.push(this.checkedList[i]);
        }

        Espo.Ajax.deleteRequest('Email/inbox/read', {ids: ids});

        ids.forEach(id => {
            let model = this.collection.get(id);

            if (model) {
                model.set('isRead', false);
            }
        });
    }

    massActionMarkAsImportant() {
        let ids = [];

        for (let i in this.checkedList) {
            ids.push(this.checkedList[i]);
        }

        Espo.Ajax.postRequest('Email/inbox/important', {ids: ids});

        ids.forEach(id => {
            let model = this.collection.get(id);

            if (model) {
                model.set('isImportant', true);
            }
        });
    }

    massActionMarkAsNotImportant() {
        let ids = [];

        for (let i in this.checkedList) {
            ids.push(this.checkedList[i]);
        }

        Espo.Ajax.deleteRequest('Email/inbox/important', {ids: ids});

        ids.forEach(id => {
            let model = this.collection.get(id);

            if (model) {
                model.set('isImportant', false);
            }
        });
    }

    // noinspection JSUnusedGlobalSymbols
    massActionMoveToTrash() {
        let ids = [];

        for (let i in this.checkedList) {
            ids.push(this.checkedList[i]);
        }

        Espo.Ajax
            .postRequest('Email/inbox/inTrash', {ids: ids})
            .then(() => {
                Espo.Ui.warning(this.translate('Moved to Trash', 'labels', 'Email'));
            });

        if (this.collection.selectedFolderId === 'trash') {
            return;
        }

        ids.forEach(id => {
            this.collection.trigger('moving-to-trash', id, this.collection.get(id));

            this.uncheckRecord(id, null, true);
        });
    }

    // noinspection JSUnusedGlobalSymbols
    massActionRetrieveFromTrash() {
        let ids = [];

        for (let i in this.checkedList) {
            ids.push(this.checkedList[i]);
        }

        Espo.Ajax
            .deleteRequest('Email/inbox/inTrash', {ids: ids})
            .then(() => {
                Espo.Ui.success(this.translate('Done'));
            });

        if (this.collection.selectedFolderId !== 'trash') {
            return;
        }

        ids.forEach(id => {
            this.collection.trigger('retrieving-from-trash', id, this.collection.get(id));

            this.uncheckRecord(id, null, true);
        });
    }

    massMoveToFolder(folderId) {
        let params = this.getMassActionSelectionPostData();
        let helper = new MassActionHelper(this);
        let idle = !!params.searchParams && helper.checkIsIdle();

        Espo.Ui.notify(this.translate('pleaseWait', 'messages'));

        Espo.Ajax
            .postRequest('MassAction', {
                entityType: this.entityType,
                action: 'moveToFolder',
                params: params,
                idle: idle,
                data: {
                    folderId: folderId,
                },
            })
            .then(result => {
                Espo.Ui.notify(false);

                if (result.id) {
                    helper
                        .process(result.id, 'moveToFolder')
                        .then(view => {
                            this.listenToOnce(view, 'close:success', () => {
                                this.collection.fetch().then(() => {
                                    Espo.Ui.success(this.translate('Done'));
                                });
                            });
                        });

                    return;
                }

                this.collection.fetch().then(() => {
                    Espo.Ui.success(this.translate('Done'));
                });
            });
    }

    // noinspection JSUnusedGlobalSymbols
    massActionMoveToFolder() {
        this.createView('dialog', 'views/email-folder/modals/select-folder', {
            headerText: this.translate('Move to Folder', 'labels', 'Email'),
        }, view => {
            view.render();

            this.listenToOnce(view, 'select', folderId => {
                this.clearView('dialog');

                this.massMoveToFolder(folderId);
            });
        });
    }

    actionMarkAsImportant(data) {
        data = data || {};

        let id = data.id;

        Espo.Ajax.postRequest('Email/inbox/important', {id: id});

        let model = this.collection.get(id);

        if (model) {
            model.set('isImportant', true);
        }
    }

    actionMarkAsNotImportant(data) {
        data = data || {};

        let id = data.id;

        Espo.Ajax.deleteRequest('Email/inbox/important', {id: id});

        let model = this.collection.get(id);

        if (model) {
            model.set('isImportant', false);
        }
    }

    // noinspection JSUnusedGlobalSymbols
    actionMarkAllAsRead() {
        Espo.Ajax.postRequest('Email/inbox/read', {all: true});

        this.collection.forEach(model => {
            model.set('isRead', true);
        });

        this.collection.trigger('all-marked-read');
    }

    actionMoveToTrash(data) {
        let id = data.id;

        Espo.Ui.notify(' ... ');

        Espo.Ajax
            .postRequest('Email/inbox/inTrash', {id: id})
            .then(() => {
                Espo.Ui.warning(this.translate('Moved to Trash', 'labels', 'Email'));

                this.collection.trigger('moving-to-trash', id, this.collection.get(id));
            });
    }

    // noinspection JSUnusedGlobalSymbols
    actionRetrieveFromTrash(data) {
        let id = data.id;

        Espo.Ui.notify(' ... ');

        this.retrieveFromTrash(id)
            .then(() => {
                Espo.Ui.warning(this.translate('Retrieved from Trash', 'labels', 'Email'));

                this.collection.trigger('retrieving-from-trash', id, this.collection.get(id));
            });
    }

    /**
     * @param {string} id
     * @return {Promise}
     */
    retrieveFromTrash(id) {
        return Espo.Ajax.deleteRequest('Email/inbox/inTrash', {id: id});
    }

    massRetrieveFromTrashMoveToFolder(folderId) {
        let ids = [];

        for (let i in this.checkedList) {
            ids.push(this.checkedList[i]);
        }

        Espo.Ajax
            .deleteRequest('Email/inbox/inTrash', {ids: ids})
            .then(() => {
                ids.forEach(id => {
                    this.collection.trigger('retrieving-from-trash', id, this.collection.get(id));
                });

                return Espo.Ajax
                    .postRequest(`Email/inbox/folders/${folderId}`, {ids: ids})
                    .then(() => {
                        Espo.Ui.success(this.translate('Done'));
                    })
            });
    }

    // noinspection JSUnusedGlobalSymbols
    /**
     * @todo Use one API request.
     */
    actionRetrieveFromTrashMoveToFolder(data) {
        let id = data.id;
        let folderId = data.folderId;

        Espo.Ui.notify(' ... ');

        this.retrieveFromTrash(id)
            .then(() => {
                return this.moveToFolder(id, folderId)
            })
            .then(() => {
                this.collection.fetch().then(() => {
                    Espo.Ui.success(this.translate('Done'));
                });
            });
    }

    /**
     * @param {string} id
     * @param {string} folderId
     * @return {Promise}
     */
    moveToFolder(id, folderId) {
        return Espo.Ajax.postRequest(`Email/inbox/folders/${folderId}`, {id: id});
    }

    actionMoveToFolder(data) {
        let id = data.id;
        let folderId = data.folderId;

        if (folderId) {
            Espo.Ui.notify(' ... ');

            this.moveToFolder(id, folderId)
                .then(() => {
                    this.collection.fetch().then(() => {
                        Espo.Ui.success(this.translate('Done'));
                    });
                });

            return;
        }

        this.createView('dialog', 'views/email-folder/modals/select-folder', {
            headerText: this.translate('Move to Folder', 'labels', 'Email'),
        }, view => {
            view.render();

            this.listenToOnce(view, 'select', folderId => {
                this.clearView('dialog');

                Espo.Ui.notify(' ... ');

                this.moveToFolder(id, folderId)
                    .then(() => {
                        this.collection.fetch().then(() => {
                            Espo.Ui.success(this.translate('Done'));
                        });
                    });
            });
        });
    }

    // noinspection JSUnusedGlobalSymbols
    actionSend(data) {
        let id = data.id;

        this.confirm({
            message: this.translate('sendConfirm', 'messages', 'Email'),
            confirmText: this.translate('Send', 'labels', 'Email'),
        }).then(() => {
            let model = this.collection.get(id);

            if (!model) {
                return;
            }

            Espo.Ui.notify(this.translate('Sending...', 'labels', 'Email'));

            model
                .save({
                    status: 'Sending',
                })
                .then(() => {
                    Espo.Ui.success(this.translate('emailSent', 'messages', 'Email'));

                    if (this.collection.selectedFolderId === 'drafts') {
                        this.removeRecordFromList(id);
                        this.uncheckRecord(id, null, true);
                        this.collection.trigger('draft-sent');
                    }
                }
            );
        });
    }

    // noinspection JSUnusedGlobalSymbols
    toggleMassMarkAsImportant() {
        let allImportant = !this.checkedList
            .map(id => this.collection.get(id))
            .find(m => !m.get('isImportant'));

        if (allImportant) {
            this.massActionMarkAsNotImportant();

            return;
        }

        this.massActionMarkAsImportant();
    }
}

export default EmailListRecordView;

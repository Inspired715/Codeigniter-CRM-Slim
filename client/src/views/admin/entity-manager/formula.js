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
import Model from 'model';
import EntityManagerEditFormulaRecordView from 'views/admin/entity-manager/record/edit-formula';
import _ from 'underscore';

class EntityManagerFormulaView extends View {

    template = 'admin/entity-manager/formula'

    /** @type {string} */
    scope

    attributes

    data() {
        return {
            scope: this.scope,
            type: this.type,
        };
    }

    setup() {
        this.addActionHandler('save', () => this.actionSave());
        this.addActionHandler('close', () => this.actionClose());
        this.addActionHandler('resetToDefault', () => this.actionResetToDefault());

        this.addHandler('keydown.form', '', 'onKeyDown');

        this.scope = this.options.scope;
        this.type = this.options.type;

        if (!this.scope || !this.type) {
            throw Error("No scope or type.");
        }

        if (!['beforeSaveCustomScript', 'beforeSaveApiScript'].includes(this.type)) {
            Espo.Ui.error('No allowed formula type.', true);

            throw new Espo.Exceptions.NotFound('No allowed formula type specified.');
        }

        this.model = new Model();
        this.model.name = 'EntityManager';

        this.wait(
            this.loadFormula().then(() => {
                this.recordView = new EntityManagerEditFormulaRecordView({
                    model: this.model,
                    targetEntityType: this.scope,
                    type: this.type,
                });

                this.assignView('record', this.recordView, '.record');
            })
        );

        this.listenTo(this.model, 'change', (m, o) => {
            if (!o.ui) {
                return;
            }

            this.setIsChanged();
        });
    }

    async loadFormula() {
        await Espo.Ajax
            .getRequest('Metadata/action/get', {key: 'formula.' + this.scope})
            .then(formulaData => {
                formulaData = formulaData || {};

                this.model.set(this.type, formulaData[this.type] || null);

                this.updateAttributes();
            });
    }

    afterRender() {
        this.$save = this.$el.find('[data-action="save"]');
    }

    disableButtons() {
        this.$save.addClass('disabled').attr('disabled', 'disabled');
    }

    enableButtons() {
        this.$save.removeClass('disabled').removeAttr('disabled');
    }

    updateAttributes() {
        this.attributes = Espo.Utils.clone(this.model.attributes);
    }

    actionSave() {
        let data = this.recordView.fetch();

        if (_.isEqual(data, this.attributes)) {
            Espo.Ui.warning(this.translate('notModified', 'messages'));

            return;
        }

        if (this.recordView.validate()) {
            return;
        }

        this.disableButtons();

        Espo.Ui.notify(' ... ');

        Espo.Ajax
            .postRequest('EntityManager/action/formula', {
                data: data,
                scope: this.scope,
            })
            .then(() => {
                Espo.Ui.success(this.translate('Saved'));

                this.enableButtons();
                this.setIsNotChanged();
                this.updateAttributes();
            })
            .catch(() => this.enableButtons());
    }

    actionClose() {
        this.setIsNotChanged();

        this.getRouter().navigate('#Admin/entityManager/scope=' + this.scope, {trigger: true});
    }

    async actionResetToDefault() {
        await this.confirm(this.translate('confirmation', 'messages'));

        this.disableButtons();
        Espo.Ui.notify(' ... ');

        try {
            await Espo.Ajax.postRequest('EntityManager/action/resetFormulaToDefault', {
                scope: this.scope,
                type: this.type,
            });
        }
        catch (e) {
            this.enableButtons();

            return;
        }

        await this.loadFormula();

        await this.recordView.reRender();

        this.enableButtons();
        this.setIsNotChanged();

        Espo.Ui.success(this.translate('Done'));
    }

    setConfirmLeaveOut(value) {
        this.getRouter().confirmLeaveOut = value;
    }

    setIsChanged() {
        this.isChanged = true;
        this.setConfirmLeaveOut(true);
    }

    setIsNotChanged() {
        this.isChanged = false;
        this.setConfirmLeaveOut(false);
    }

    updatePageTitle() {
        this.setPageTitle(this.getLanguage().translate('Formula', 'labels', 'EntityManager'));
    }

    /**
     * @param {KeyboardEvent} e
     */
    onKeyDown(e) {
        let key = Espo.Utils.getKeyFromKeyEvent(e);

        if (key === 'Control+KeyS' || key === 'Control+Enter') {
            this.actionSave();

            e.preventDefault();
            e.stopPropagation();
        }
    }
}

export default EntityManagerFormulaView;

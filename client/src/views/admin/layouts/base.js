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

/** @module module:views/admin/layouts/base */

import View from 'view';

class LayoutBaseView extends View {

    /**
     * @type {string}
     */
    scope
    /**
     * @type {string}
     */
    type

    events = {
        /** @this LayoutBaseView */
        'click button[data-action="save"]': function () {
            this.actionSave();
        },
        /** @this LayoutBaseView */
        'click button[data-action="cancel"]': function () {
            this.cancel();
        },
        /** @this LayoutBaseView */
        'click button[data-action="resetToDefault"]': function () {
            this.confirm(this.translate('confirmation', 'messages'), () => {
                this.resetToDefault();
            });
        },
        /** @this LayoutBaseView */
        'click button[data-action="remove"]': function () {
            this.actionDelete();
        },
    }

    buttonList = [
        {
            name: 'save',
            label: 'Save',
            style: 'primary',
        },
        {
            name: 'cancel',
            label: 'Cancel',
        },
    ]

    // noinspection JSUnusedGlobalSymbols
    dataAttributes = null
    dataAttributesDefs = null
    dataAttributesDynamicLogicDefs = null

    setup() {
        this.buttonList = _.clone(this.buttonList);
        this.events = _.clone(this.events);
        this.scope = this.options.scope;
        this.type = this.options.type;
        this.setId = this.options.setId;
        this.em = this.options.em;

        let defs = this.getMetadata()
            .get(['clientDefs', this.scope, 'additionalLayouts', this.type]) ?? {};

        this.typeDefs = defs;

        this.dataAttributeList = Espo.Utils.clone(defs.dataAttributeList || this.dataAttributeList);

        this.isCustom = !!defs.isCustom;

        if (this.isCustom && this.em) {
            this.buttonList.push({
                name: 'remove',
                label: 'Remove',
            })
        }

        if (!this.isCustom) {
            this.buttonList.push({
                name: 'resetToDefault',
                label: 'Reset to Default',
            });
        }
    }

    actionSave() {
        this.disableButtons();
        Espo.Ui.notify(this.translate('saving', 'messages'));

        this.save(this.enableButtons.bind(this));
    }

    disableButtons() {
        this.$el.find('.button-container button').attr('disabled', 'disabled');
    }

    enableButtons() {
        this.$el.find('.button-container button').removeAttr('disabled');
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

    save(callback) {
        var layout = this.fetch();

        if (!this.validate(layout)) {
            this.enableButtons();

            return false;
        }

        this.getHelper()
            .layoutManager
            .set(this.scope, this.type, layout, () => {
                Espo.Ui.success(this.translate('Saved'));

                this.setIsNotChanged();

                if (typeof callback === 'function') {
                    callback();
                }

                this.getHelper().broadcastChannel.postMessage('update:layout');
            }, this.setId)
            .catch(() => this.enableButtons());
    }

    resetToDefault() {
        this.getHelper().layoutManager.resetToDefault(this.scope, this.type, () => {
            this.loadLayout(() => {
                this.setIsNotChanged();

                this.prepareLayout().then(() => this.reRender());
            });

        }, this.options.setId);
    }

    prepareLayout() {
        return Promise.resolve();
    }

    reset() {
        this.render();
    }

    fetch() {}

    unescape(string) {
        if (string === null) {
            return '';
        }

        var map = {
            '&amp;': '&',
            '&lt;': '<',
            '&gt;': '>',
            '&quot;': '"',
            '&#x27;': "'",
        };

        var reg = new RegExp('(' + _.keys(map).join('|') + ')', 'g');

        return ('' + string).replace(reg, match => {
            return map[match];
        });
    }

    getEditAttributesModalViewOptions(attributes) {
        return {
            name: attributes.name,
            scope: this.scope,
            attributeList: this.dataAttributeList,
            attributeDefs: this.dataAttributesDefs,
            dynamicLogicDefs: this.dataAttributesDynamicLogicDefs,
            attributes: attributes,
            languageCategory: this.languageCategory,
            headerText: ' ',
        };
    }

    openEditDialog(attributes) {
        let name = attributes.name;

        let viewOptions = this.getEditAttributesModalViewOptions(attributes);

        this.createView('editModal', 'views/admin/layouts/modals/edit-attributes', viewOptions, view => {
            view.render();

            this.listenToOnce(view, 'after:save', attributes => {
                this.trigger('update-item', name, attributes);

                let $li = $("#layout ul > li[data-name='" + name + "']");

                for (let key in attributes) {
                    $li.attr('data-' + key, attributes[key]);
                    $li.data(key, attributes[key]);
                    $li.find('.' + key + '-value').text(attributes[key]);
                }

                view.close();

                this.setIsChanged();
            });
        });
    }

    cancel() {
        this.loadLayout(() => {
            this.setIsNotChanged();

            if (this.em) {
                this.trigger('cancel');

                return;
            }

            this.prepareLayout().then(() => this.reRender());
        });
    }

    // noinspection JSUnusedLocalSymbols
    validate(layout) {
        return true;
    }

    actionDelete() {
        this.confirm(this.translate('confirmation', 'messages'))
            .then(() => {
                this.disableButtons();

                Espo.Ui.notify(' ... ');

                Espo.Ajax
                    .postRequest('Layout/action/delete', {
                        scope: this.scope,
                        name: this.type,
                    })
                    .then(() => {
                        Espo.Ui.success(this.translate('Removed'), {suppress: true});

                        this.trigger('after-delete');
                    })
                    .catch(() => {
                        this.enableButtons();
                    });
            });
    }
}

export default LayoutBaseView;

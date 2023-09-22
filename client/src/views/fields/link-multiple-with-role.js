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

import LinkMultipleFieldView from 'views/fields/link-multiple';
import Select from 'ui/select';

/**
 * A link-multiple field with a relation column.
 * @deprecated Prefer using `link-multiple-with-columns` instead.
 */
class LinkMultipleWithRoleFieldView extends LinkMultipleFieldView {

    /**
     * A role field type.
     */
    roleType = 'enum'
    /**
     * A relation column name.
     */
    columnName = 'role'
    /**
     * The role field is defined in a foreign entity.
     */
    roleFieldIsForeign = true
    /**
     * A value to fetch for an empty role.
     */
    emptyRoleValue = null
    /**
     * A role placeholder text.
     */
    rolePlaceholderText = null
    /**
     * A role value max length.
     * @protected
     */
    roleMaxLength = 50

    /** @const */
    ROLE_TYPE_ENUM = 'enum'
    // noinspection JSUnusedGlobalSymbols
    /** @const */
    ROLE_TYPE_VARCHAR = 'varchar'

    setup() {
        super.setup();

        this.columnsName = this.name + 'Columns';
        this.columns = Espo.Utils.cloneDeep(this.model.get(this.columnsName) || {});

        this.listenTo(this.model, 'change:' + this.columnsName, () => {
            this.columns = Espo.Utils.cloneDeep(this.model.get(this.columnsName) || {});
        });

        this.roleField = this.getMetadata()
            .get(['entityDefs', this.model.entityType, 'fields', this.name, 'columns', this.columnName]);

        this.displayRoleAsLabel = this.getMetadata()
            .get(['entityDefs', this.model.entityType, 'fields', this.roleField, 'displayAsLabel']);

        this.roleFieldScope = this.roleFieldIsForeign ? this.foreignScope : this.model.entityType;

        if (this.roleType === this.ROLE_TYPE_ENUM && !this.forceRoles) {
            this.roleList = this.getMetadata()
                .get(['entityDefs', this.roleFieldScope, 'fields', this.roleField, 'options']);

            if (!this.roleList) {
                this.roleList = [];
                this.skipRoles = true;
            }
        }
    }

    getAttributeList() {
        const list = super.getAttributeList();

        list.push(this.name + 'Columns');

        return list;
    }

    getDetailLinkHtml(id, name) {
        // Do not use the `html` method to avoid XSS.

        name = name || this.nameHash[id] || id;

        if (!name && id) {
            name = this.translate(this.foreignScope, 'scopeNames');
        }

        let role = (this.columns[id] || {})[this.columnName] || '';

        if (this.emptyRoleValue && role === this.emptyRoleValue) {
            role = '';
        }

        let $el = $('<div>')
            .append(
                $('<a>')
                    .attr('href', '#' + this.foreignScope + '/view/' + id)
                    .attr('data-id', id)
                    .text(name)
            );

        if (this.isDetailMode()) {
            let iconHtml = this.getIconHtml(id);

            if (iconHtml) {
                $el.prepend(iconHtml);
            }
        }

        if (role) {
            let style = this.getMetadata()
                .get(['entityDefs', this.model.entityType, 'fields', this.roleField, 'style', role]);

            let className = 'text';

            if (this.displayRoleAsLabel && style && style !== 'default') {
                className = 'label label-sm label';

                if (style === 'muted') {
                    style = 'default';
                }
            } else {
                style = style || 'muted';
            }

            className = className + '-' + style;

            let text = this.roleType === this.ROLE_TYPE_ENUM ?
                this.getLanguage().translateOption(role, this.roleField, this.roleFieldScope) :
                role;

            $el.append(
                $('<span>').text(' '),
                $('<span>').addClass('text-muted chevron-right'),
                $('<span>').text(' '),
                $('<span>').text(text).addClass('small').addClass(className)
            );
        }

        return $el.get(0).outerHTML;
    }

    getValueForDisplay() {
        if (this.isDetailMode() || this.isListMode()) {
            let names = [];

            this.ids.forEach(id => {
                names.push(
                    this.getDetailLinkHtml(id)
                );
            });

            return names.join('');
        }
    }

    deleteLink(id) {
        this.trigger('delete-link', id);
        this.trigger('delete-link:' + id);

        this.deleteLinkHtml(id);

        let index = this.ids.indexOf(id);

        if (index > -1) {
            this.ids.splice(index, 1);
        }

        delete this.nameHash[id];
        delete this.columns[id];

        this.afterDeleteLink(id);
        this.trigger('change');
    }

    addLink(id, name) {
        if (!~this.ids.indexOf(id)) {
            this.ids.push(id);
            this.nameHash[id] = name;
            this.columns[id] = {};
            this.columns[id][this.columnName] = null;
            this.addLinkHtml(id, name);

            this.trigger('add-link', id);
            this.trigger('add-link:' + id);
        }

        this.trigger('change');
    }


    /**
     * Build a role select element.
     *
     * @param {string} id
     * @param {string|null} roleValue
     * @return {JQuery}
     */
    getJQSelect(id, roleValue) {
        // Do not use the `html` method to avoid XSS.

        let $role = $('<select>')
            .addClass('role form-control input-sm')
            .attr('data-id', id);

        this.roleList.forEach(role => {
            let text = this.getLanguage().translateOption(role, this.roleField, this.roleFieldScope);

            let $option = $('<option>')
                .val(role)
                .text(text);

            if (role === (roleValue || '')) {
                $option.attr('selected', 'selected');
            }

            $role.append($option);
        });

        return $role;
    }

    /**
     * @inheritDoc
     */
    addLinkHtml(id, name) {
        // Do not use the `html` method to avoid XSS.

        name = name || id;

        if (this.isSearchMode() || this.skipRoles) {
            return super.addLinkHtml(id, name);
        }

        let role = (this.columns[id] || {})[this.columnName];

        let $container = this.$el.find('.link-container');

        let $el = $('<div>')
            .addClass('form-inline clearfix')
            .addClass('list-group-item link-with-role link-group-item-with-columns')
            .addClass('link-' + id);

        let $remove = $('<a>')
            .attr('role', 'button')
            .attr('tabindex', '0')
            .attr('data-id', id)
            .attr('data-action', 'clearLink')
            .addClass('pull-right')
            .append(
                $('<span>').addClass('fas fa-times')
            );

        let $left = $('<div>').addClass('pull-left');
        let $right = $('<div>').append($remove);

        let $name = $('<div>')
            .addClass('link-item-name')
            .text(name)
            .append('&nbsp;')

        let $role;

        if (this.roleType === this.ROLE_TYPE_ENUM) {
            $role = this.getJQSelect(id, role);
        }
        else {
            let text = this.rolePlaceholderText || this.translate(this.roleField, 'fields', this.roleFieldScope);

            $role = $('<input>')
                .addClass('role form-control input-sm')
                .attr('maxlength', this.roleMaxLength) // @todo Get the value from metadata.
                .attr('placeholder', text)
                .attr('data-id', id)
                .attr('value', role || '');
        }

        if ($role) {
            $left.append($('<span>')
                .addClass('link-item-column')
                .addClass('link-item-column-' + $role.get(0).tagName.toLowerCase())
                .append($role)
            );
        }

        $left.append($name);
        $el.append($left).append($right);
        $container.append($el);

        if ($role && $role.get(0).tagName === 'SELECT') {
            Select.init($role);
        }

        if (this.isEditMode() && $role) {
            let fetch = ($target) => {
                if (!$target || !$target.length) {
                    return;
                }

                if ($target.val() === null) {
                    return;
                }

                let value = $target.val().toString().trim();
                let id = $target.data('id');

                if (value === '') {
                    value = null;
                }

                this.columns[id] = this.columns[id] || {};
                this.columns[id][this.columnName] = value;
            };

            $role.on('change', e => {
                fetch($(e.currentTarget));
                this.trigger('change');
            });

            fetch($role);
        }

        return $el;
    }

    fetch() {
        let data = super.fetch();

        if (!this.skipRoles) {
            data[this.columnsName] = Espo.Utils.cloneDeep(this.columns);
        }

        return data;
    }
}

// noinspection JSDeprecatedSymbols
export default LinkMultipleWithRoleFieldView;

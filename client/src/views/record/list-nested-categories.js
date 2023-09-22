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

/** @module views/record/list-nested-categories */

import View from 'view';

class ListNestedCategoriesRecordView extends View {

    template = 'record/list-nested-categories'

    isLoading = false

    events = {
        'click .action': function (e) {
            Espo.Utils.handleAction(this, e.originalEvent, e.currentTarget);
        },
    }

    data() {
        let data = {};

        if (!this.isLoading) {
            data.list = this.getDataList();
        }

        data.scope = this.collection.entityType;
        data.isLoading = this.isLoading;
        data.currentId = this.collection.currentCategoryId;
        data.currentName = this.collection.currentCategoryName;
        data.categoryData = this.collection.categoryData;

        data.hasExpandedToggler = this.options.hasExpandedToggler;
        data.showEditLink = this.options.showEditLink;
        data.hasNavigationPanel = this.options.hasNavigationPanel;

        let categoryData = this.collection.categoryData || {};

        data.upperLink = categoryData.upperId ?
            '#' + this.subjectEntityType + '/list/categoryId=' + categoryData.upperId:
            '#' + this.subjectEntityType;

        return data;
    }

    getDataList() {
        var list = [];

        this.collection.forEach(model => {
            let o = {
                id: model.id,
                name: model.get('name'),
                recordCount: model.get('recordCount'),
                isEmpty: model.get('isEmpty'),
                link: '#' + this.subjectEntityType + '/list/categoryId=' + model.id,
            };

            list.push(o);
        });

        return list;
    }

    setup() {
        this.listenTo(this.collection, 'sync', () => {
            this.reRender();
        });

        this.subjectEntityType = this.options.subjectEntityType;
    }

    actionShowMore() {
        this.$el.find('.category-item.show-more').addClass('hidden');

        this.collection.fetch({
            remove: false,
            more: true,
        });
    }
}

export default ListNestedCategoriesRecordView;

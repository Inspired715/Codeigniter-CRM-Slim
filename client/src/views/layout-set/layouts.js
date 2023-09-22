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

import LayoutIndexView from 'views/admin/layouts/index';

class LayoutsView extends LayoutIndexView {

    setup() {
        let setId = this.setId = this.options.layoutSetId;
        this.baseUrl = '#LayoutSet/editLayouts/id=' + setId;

        super.setup();

        this.wait(
            this.getModelFactory()
                .create('LayoutSet')
                .then(m => {
                    this.sModel = m;
                    m.id = setId;

                    return m.fetch();
                })
        );
    }

    getLayoutScopeDataList() {
        let dataList = [];
        let list = this.sModel.get('layoutList') || [];

        let scopeList = [];

        list.forEach(item => {
            let arr = item.split('.');
            let scope = arr[0];

            if (~scopeList.indexOf(scope)) {
                return;
            }

            scopeList.push(scope);
        });

        scopeList.forEach(scope => {
            let o = {};

            o.scope = scope;
            o.url = this.baseUrl + '&scope=' + scope;
            o.typeDataList = [];

            let typeList = [];

            list.forEach(item => {
                let [scope, type] = item.split('.');

                if (scope !== o.scope) {
                    return;
                }

                typeList.push(type);
            });

            typeList.forEach(type => {
                o.typeDataList.push({
                    type: type,
                    url: this.baseUrl + '&scope=' + scope + '&type=' + type,
                    label: this.translateLayoutName(type, scope),
                });
            });

            o.typeList = typeList;

            dataList.push(o);
        });

        return dataList;
    }

    getHeaderHtml() {
        const separatorHtml = ' <span class="breadcrumb-separator"><span class="chevron-right"></span></span> ';

        return $('<span>')
            .append(
                $('<a>')
                    .attr('href', '#LayoutSet')
                    .text(this.translate('LayoutSet', 'scopeNamesPlural')),
                separatorHtml,
                $('<a>')
                    .attr('href', '#LayoutSet/view/' + this.sModel.id)
                    .text(this.sModel.get('name')),
                separatorHtml,
                $('<span>')
                    .text(this.translate('Edit Layouts', 'labels', 'LayoutSet'))
            )
            .get(0).outerHTML;
    }

    navigate(scope, type) {
        let url = '#LayoutSet/editLayouts/id=' + this.setId + '&scope=' + scope + '&type=' + type;

        this.getRouter().navigate(url, {trigger: false});
    }
}

export default LayoutsView;

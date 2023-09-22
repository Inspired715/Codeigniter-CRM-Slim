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

define('views/admin/integrations/index', ['view'], function (Dep) {

    return Dep.extend({

        template: 'admin/integrations/index',

        integrationList: null,
        integration: null,

        data: function () {
            return {
                integrationList: this.integrationList,
                integration: this.integration,
            };
        },

        events: {
            'click #integrations-menu a.integration-link': function (e) {
                let name = $(e.currentTarget).data('name');

                this.openIntegration(name);
            },
        },

        setup: function () {
            this.integrationList = Object
                .keys(this.getMetadata().get('integrations') || {})
                .sort((v1, v2) => this.translate(v1, 'titles', 'Integration')
                    .localeCompare(this.translate(v2, 'titles', 'Integration'))
                );

            this.integration = this.options.integration || null;

            this.on('after:render', () => {
                this.renderHeader();

                if (!this.integration) {
                    this.renderDefaultPage();
                } else {
                    this.openIntegration(this.integration);
                }
            });
        },

        openIntegration: function (integration) {
            this.integration = integration;

            this.getRouter().navigate('#Admin/integrations/name=' + integration, {trigger: false});

            var viewName = this.getMetadata().get('integrations.' + integration + '.view') ||
                'views/admin/integrations/' +
                Espo.Utils.camelCaseToHyphen(this.getMetadata().get('integrations.' + integration + '.authMethod'));

            Espo.Ui.notify(' ... ');

            this.createView('content', viewName, {
                fullSelector: '#integration-content',
                integration: integration,
            }, view => {
                this.renderHeader();

                view.render();

                Espo.Ui.notify(false);

                $(window).scrollTop(0);
            });
        },

        renderDefaultPage: function () {
            $('#integration-header').html('').hide();

            let msg;

            if (this.integrationList.length) {
                msg = this.translate('selectIntegration', 'messages', 'Integration');
            } else {
                msg = '<p class="lead">' + this.translate('noIntegrations', 'messages', 'Integration') + '</p>';
            }

            $('#integration-content').html(msg);
        },

        renderHeader: function () {
            if (!this.integration) {
                $('#integration-header').html('');

                return;
            }

            $('#integration-header').show().html(this.translate(this.integration, 'titles', 'Integration'));
        },

        updatePageTitle: function () {
            this.setPageTitle(this.getLanguage().translate('Integrations', 'labels', 'Admin'));
        },
    });
});

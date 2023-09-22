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

import RelationshipPanelView from 'views/record/panels/relationship';
import MultiCollection from 'multi-collection';

class ActivitiesPanelView extends RelationshipPanelView {

    name = 'activities'
    orderBy = 'dateStart'
    serviceName = 'Activities'
    order = 'desc'
    rowActionsView = 'crm:views/record/row-actions/activities'
    relatedListFiltersDisabled = true
    buttonMaxCount = null

    actionList = [
        {
            action: 'composeEmail',
            label: 'Compose Email',
            acl: 'create',
            aclScope: 'Email',
        },
    ]

    listLayout = {}

    defaultListLayout = {
        rows: [
            [
                {name: 'ico', view: 'crm:views/fields/ico'},
                {name: 'name', link: true, view: 'views/event/fields/name-for-history'},
            ],
            [
                {name: 'assignedUser'},
                {name: 'dateStart'},
            ],
        ]
    }

    BUTTON_MAX_COUNT = 3

    setup() {
        this.scopeList = this.getConfig().get(this.name + 'EntityList') || [];

        this.buttonMaxCount = this.getConfig().get('activitiesCreateButtonMaxCount');

        if (typeof this.buttonMaxCount === 'undefined') {
            this.buttonMaxCount = this.BUTTON_MAX_COUNT;
        }

        this.listLayout = Espo.Utils.cloneDeep(this.listLayout);

        this.defs.create = true;

        this.createAvailabilityHash = {};
        this.entityTypeLinkMap = {};
        this.createEntityTypeStatusMap = {};

        this.setupActionList();
        this.setupFinalActionList();
        this.setupSorting();

        this.scopeList.forEach(item => {
            if (!(item in this.listLayout)) {
                this.listLayout[item] = this.defaultListLayout;
            }
        });

        this.url = this.serviceName + '/' + this.model.entityType + '/' + this.model.id + '/' + this.name;

        this.seeds = {};

        this.wait(true);

        let i = 0;

        this.scopeList.forEach(scope => {
            this.getModelFactory().create(scope, seed => {
                this.seeds[scope] = seed;

                i++;

                if (i === this.scopeList.length) {
                    this.wait(false);
                }
            });
        });

        if (this.scopeList.length === 0) {
            this.wait(false);
        }

        this.filterList = [];

        this.scopeList.forEach(item => {
            if (!this.getAcl().check(item)) {
                return;
            }

            if (!this.getAcl().check(item, 'read')) {
                return;
            }

            if (this.getMetadata().get(['scopes', item, 'disabled'])) {
                return;
            }

            this.filterList.push(item);
        });

        if (this.filterList.length) {
            this.filterList.unshift('all');
        }

        if (this.filterList && this.filterList.length) {
            this.filter = this.getStoredFilter();
        }

        this.setupFilterActions();

        this.setupTitle();

        this.collection = new MultiCollection();
        this.collection.seeds = this.seeds;
        this.collection.url = this.url;
        this.collection.orderBy = this.orderBy;
        this.collection.order = this.order;
        this.collection.maxSize = this.getConfig().get('recordsPerPageSmall') || 5;

        this.setFilter(this.filter);

        this.once('show', () => {
            if (!this.isRendered() && !this.isBeingRendered()) {
                this.collection.fetch();
            }
        });
    }

    translateFilter(name) {
        if (name === 'all') {
            return this.translate(name, 'presetFilters');
        }

        return this.translate(name, 'scopeNamesPlural');
    }

    isCreateAvailable(scope) {
        return this.createAvailabilityHash[scope];
    }

    setupActionList() {
        if (this.name === 'activities' && this.buttonMaxCount) {
            this.buttonList.push({
                action: 'composeEmail',
                title: 'Compose Email',
                acl: 'create',
                aclScope: 'Email',
                html: $('<span>')
                    .addClass(this.getMetadata().get(['clientDefs', 'Email', 'iconClass']))
                    .get(0).outerHTML,
            });
        }

        this.scopeList.forEach(scope => {
            if (!this.getMetadata().get(['clientDefs', scope, 'activityDefs', this.name + 'Create'])) {
                return;
            }

            if (!this.getAcl().checkScope(scope, 'create')) {
                return;
            }

            let label = (this.name === 'history' ? 'Log' : 'Schedule') + ' ' + scope;

            let o = {
                action: 'createActivity',
                text: this.translate(label, 'labels', scope),
                data: {},
                acl: 'create',
                aclScope: scope,
            };

            let link = this.getMetadata().get(['clientDefs', scope, 'activityDefs', 'link'])

            if (link) {
                o.data.link = link;

                this.entityTypeLinkMap[scope] = link;

                if (!this.model.hasLink(link)) {
                    return;
                }
            } else {
                o.data.scope = scope;

                if (
                    this.model.entityType !== 'User' &&
                    !this.checkParentTypeAvailability(scope, this.model.entityType)
                ) {
                    return;
                }
            }

            this.createAvailabilityHash[scope] = true;

            o.data = o.data || {};

            if (!o.data.status) {
                let statusList = this.getMetadata().get(['scopes', scope, this.name + 'StatusList']);

                if (statusList && statusList.length) {
                    o.data.status = statusList[0];
                }
            }

            this.createEntityTypeStatusMap[scope] = o.data.status;
            this.actionList.push(o);

            if (
                this.name === 'activities' &&
                this.buttonList.length < this.buttonMaxCount
            ) {
                let ob = Espo.Utils.cloneDeep(o);

                let iconClass = this.getMetadata().get(['clientDefs', scope, 'iconClass']);

                if (iconClass) {
                    ob.title = label;
                    ob.html = $('<span>').addClass(iconClass).get(0).outerHTML;

                    this.buttonList.push(ob);
                }
            }
        });
    }

    setupFinalActionList() {
        this.scopeList.forEach((scope, i) => {
            if (i === 0 && this.actionList.length) {
                this.actionList.push(false);
            }

            if (!this.getAcl().checkScope(scope, 'read')) {
                return;
            }

            let o = {
                action: 'viewRelatedList',
                html: $('<span>')
                    .append(
                        $('<span>').text(this.translate('View List')),
                        ' &middot; ',
                        $('<span>').text(this.translate(scope, 'scopeNamesPlural')),
                    )
                    .get(0).innerHTML,
                data: {
                    scope: scope,
                },
                acl: 'read',
                aclScope: scope,
            };

            this.actionList.push(o);
        });
    }

    setFilter(filter) {
        this.filter = filter;

        this.collection.data.entityType = null;

        if (filter && filter !== 'all') {
            this.collection.data.entityType = this.filter;
        }
    }

    afterRender() {
        let afterFetch = () => {
            this.createView('list', 'views/record/list-expanded', {
                selector: '> .list-container',
                pagination: false,
                type: 'listRelationship',
                rowActionsView: this.rowActionsView,
                checkboxes: false,
                collection: this.collection,
                listLayout: this.listLayout,
            }, (view) => {
                view.render();

                this.listenTo(view, 'after:save', () => {
                    this.fetchActivities();
                    this.fetchHistory();
                });
            });
        };

        if (!this.disabled) {
            this.collection
                .fetch()
                .then(() => afterFetch());
        }
        else {
            this.once('show', () => {
                this.collection
                    .fetch()
                    .then(() => afterFetch())
            });
        }
    }

    fetchHistory() {
        let parentView = this.getParentView();

        if (parentView) {
            if (parentView.hasView('history')) {
                let collection = parentView.getView('history').collection;

                if (collection) {
                    collection.fetch();
                }
            }
        }
    }

    fetchActivities() {
        let parentView = this.getParentView();

        if (parentView) {
            if (parentView.hasView('activities')) {
                let collection = parentView.getView('activities').collection;

                if (collection) {
                    collection.fetch();
                }
            }
        }
    }

    getCreateActivityAttributes(scope, data, callback) {
        data = data || {};

        let attributes = {
            status: data.status,
        };

        if (this.model.entityType === 'User') {
            let model = /** @type {module:models/user} */this.model;

            if (model.isPortal()) {
                attributes.usersIds = [model.id];

                let usersIdsNames = {};
                usersIdsNames[model.id] = model.get('name')

                attributes.usersIdsNames = usersIdsNames;
            }
            else {
                attributes.assignedUserId = model.id;
                attributes.assignedUserName = model.get('name');
            }
        }
        else {
            if (this.model.entityType === 'Contact') {
                if (this.model.get('accountId') && !this.getConfig().get('b2cMode')) {
                    attributes.parentType = 'Account';
                    attributes.parentId = this.model.get('accountId');
                    attributes.parentName = this.model.get('accountName');
                    if (
                        scope &&
                        !this.getMetadata().get(['entityDefs', scope, 'links', 'contacts']) &&
                        !this.getMetadata().get(['entityDefs', scope, 'links', 'contact'])
                    ) {
                        delete attributes.parentType;
                        delete attributes.parentId;
                        delete attributes.parentName;
                    }
                }
            }
            else if (this.model.entityType === 'Lead') {
                attributes.parentType = 'Lead';
                attributes.parentId = this.model.id;
                attributes.parentName = this.model.get('name');
            }

            if (this.model.entityType !== 'Account' && this.model.has('contactsIds')) {
                attributes.contactsIds = this.model.get('contactsIds');
                attributes.contactsNames = this.model.get('contactsNames');
            }

            if (scope) {
                if (!attributes.parentId) {
                    if (this.checkParentTypeAvailability(scope, this.model.entityType)) {
                        attributes.parentType = this.model.entityType;
                        attributes.parentId = this.model.id;
                        attributes.parentName = this.model.get('name');
                    }
                }
                else {
                    if (attributes.parentType && !this.checkParentTypeAvailability(scope, attributes.parentType)) {
                        attributes.parentType = null;
                        attributes.parentId = null;
                        attributes.parentName = null;
                    }
                }
            }
        }

        callback.call(this, Espo.Utils.cloneDeep(attributes));
    }

    checkParentTypeAvailability(scope, parentType) {
        return ~(
            this.getMetadata().get(['entityDefs', scope, 'fields', 'parent', 'entityList']) || []
        ).indexOf(parentType);
    }

    // noinspection JSUnusedGlobalSymbols
    actionCreateRelated(data) {
        data.link = this.entityTypeLinkMap[data.scope];

        if (this.createEntityTypeStatusMap[data.scope]) {
            data.status = this.createEntityTypeStatusMap[data.scope];
        }

        this.actionCreateActivity(data);
    }

    actionCreateActivity(data) {
        let link = data.link;
        let foreignLink;
        let scope;

        if (link) {
            scope = this.model.getLinkParam(link, 'entity');
            foreignLink = this.model.getLinkParam(link, 'foreign');
        }
        else {
            scope = data.scope;
        }

        let o = {
            scope: scope
        };

        if (link) {
            o.relate = {
                model: this.model,
                link: foreignLink
            };
        }

        Espo.Ui.notify(' ... ');

        let viewName = this.getMetadata().get('clientDefs.' + scope + '.modalViews.edit') ||
            'views/modals/edit';

        this.getCreateActivityAttributes(scope, data, attributes => {
            o.attributes = attributes;

            this.createView('quickCreate', viewName, o, (view) => {
                view.render();
                view.notify(false);

                this.listenToOnce(view, 'after:save', () => {
                    this.model.trigger('after:relate');
                    this.collection.fetch();
                    this.fetchHistory();
                });
            });
        });
    }

    getComposeEmailAttributes(scope, data, callback) {
        let attributes = {
            status: 'Draft',
            to: this.model.get('emailAddress')
        };

        if (this.model.entityType === 'Contact') {
            if (this.getConfig().get('b2cMode')) {
                attributes.parentType = 'Contact';
                attributes.parentName = this.model.get('name');
                attributes.parentId = this.model.id;
            }
            else {
                if (this.model.get('accountId')) {
                    attributes.parentType = 'Account';
                    attributes.parentId = this.model.get('accountId');
                    attributes.parentName = this.model.get('accountName');
                }
            }
        }
        else if (this.model.entityType === 'Lead') {
            attributes.parentType = 'Lead';
            attributes.parentId = this.model.id;
            attributes.parentName = this.model.get('name');
        }

        if (~['Contact', 'Lead', 'Account'].indexOf(this.model.entityType) && this.model.get('emailAddress')) {
            attributes.nameHash = {};
            attributes.nameHash[this.model.get('emailAddress')] = this.model.get('name');
        }

        if (scope) {
            if (!attributes.parentId) {
                if (this.checkParentTypeAvailability(scope, this.model.entityType)) {
                    attributes.parentType = this.model.entityType;
                    attributes.parentId = this.model.id;
                    attributes.parentName = this.model.get('name');
                }
            }
            else {
                if (attributes.parentType && !this.checkParentTypeAvailability(scope, attributes.parentType)) {
                    attributes.parentType = null;
                    attributes.parentId = null;
                    attributes.parentName = null;
                }
            }
        }

        let emailKeepParentTeamsEntityList = this.getConfig().get('emailKeepParentTeamsEntityList') || [];

        if (
            attributes.parentType &&
            attributes.parentType === this.model.entityType &&
            ~emailKeepParentTeamsEntityList.indexOf(attributes.parentType) &&
            this.model.get('teamsIds') &&
            this.model.get('teamsIds').length
        ) {
            attributes.teamsIds = Espo.Utils.clone(this.model.get('teamsIds'));
            attributes.teamsNames = Espo.Utils.clone(this.model.get('teamsNames') || {});

            let defaultTeamId = this.getUser().get('defaultTeamId');

            if (defaultTeamId && !~attributes.teamsIds.indexOf(defaultTeamId)) {
                attributes.teamsIds.push(defaultTeamId);
                attributes.teamsNames[defaultTeamId] = this.getUser().get('defaultTeamName');
            }

            attributes.teamsIds = attributes.teamsIds
                .filter(teamId => {
                    return this.getAcl().checkTeamAssignmentPermission(teamId);
                });
        }

        callback.call(this, attributes);
    }

    // noinspection JSUnusedGlobalSymbols
    actionComposeEmail(data) {
        let scope = 'Email';

        let relate = null;

        if ('emails' in this.model.defs['links']) {
            relate = {
                model: this.model,
                link: this.model.defs['links']['emails'].foreign
            };
        }

        Espo.Ui.notify(' ... ');

        this.getComposeEmailAttributes(scope, data, attributes => {
            this.createView('quickCreate', 'views/modals/compose-email', {
                relate: relate,
                attributes: attributes,
            }, (view) => {
                view.render();
                view.notify(false);

                this.listenToOnce(view, 'after:save', () => {
                    this.collection.fetch();
                    this.model.trigger('after:relate');
                    this.fetchHistory();
                });
            });
        });
    }

    actionRefresh() {
        this.collection.fetch();
    }

    actionSetHeld(data) {
        let id = data.id;

        if (!id) {
            return;
        }

        let model = this.collection.get(id);

        model.save({status: 'Held'}, {patch: true})
            .then(() => {
                this.collection.fetch();
                this.fetchHistory();
            });
    }

    actionSetNotHeld(data) {
        let id = data.id;

        if (!id) {
            return;
        }

        let model = this.collection.get(id);

        model.save({status: 'Not Held'}, {patch: true})
            .then(() => {
                this.collection.fetch();
                this.fetchHistory();
            });
    }

    actionViewRelatedList(data) {
        data.url = 'Activities/' + this.model.entityType + '/' +
            this.model.id + '/' + this.name + '/list/' + data.scope;

        data.title = this.translate(this.defs.label) +
            ' @right ' + this.translate(data.scope, 'scopeNamesPlural');

        data.viewOptions = data.viewOptions || {};
        data.viewOptions.massUnlinkDisabled = true;
        data.viewOptions.fullFormUrl = '#' + this.model.entityType + '/' + this.name + '/' +
            this.model.id + '/' + data.scope;

        super.actionViewRelatedList(data);
    }
}

export default ActivitiesPanelView;

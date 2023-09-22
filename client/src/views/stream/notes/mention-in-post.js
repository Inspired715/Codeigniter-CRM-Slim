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

import NoteStreamView from 'views/stream/note';

class MentionInPostNoteStreamView extends NoteStreamView {

    template = 'stream/notes/post'
    messageName = 'mentionInPost'

    data() {
        return {
            ...super.data(),
            showAttachments: !!(this.model.get('attachmentsIds') || []).length,
            showPost: !!this.model.get('post'),
        };
    }

    setup() {
        if (this.model.get('post')) {
            this.createField('post', null, null, 'views/stream/fields/post');
        }

        if ((this.model.get('attachmentsIds') || []).length) {
            this.createField('attachments', 'attachmentMultiple', {}, 'views/stream/fields/attachment-multiple', {
                previewSize: this.options.isNotification ? 'small' : null
            });
        }

        this.messageData['mentioned'] = this.options.userId;

        if (!this.model.get('parentId')) {
            this.messageName = 'mentionInPostTarget';
        }

        if (!this.isUserStream || this.options.userId !== this.getUser().id) {
            this.createMessage();

            return;
        }

        if (this.model.get('parentId')) {
            this.messageName = 'mentionYouInPost';

            this.createMessage();

            return;
        }

        this.messageName = 'mentionYouInPostTarget';

        if (this.model.get('isGlobal')) {
            this.messageName = 'mentionYouInPostTargetAll';

            this.createMessage();

            return;
        }

        this.messageName = 'mentionYouInPostTarget';

        if (this.model.has('teamsIds') && this.model.get('teamsIds').length) {
            let teamIdList = this.model.get('teamsIds');
            let teamNameHash = this.model.get('teamsNames') || {};

            let teamHtmlList = [];

            teamIdList.forEach(teamId => {
                let teamName = teamNameHash[teamId];

                if (!teamName) {
                    return;
                }

                teamHtmlList.push(
                    $('<a>')
                        .attr('href', '#Team/view/' + teamId)
                        .text(teamName)
                        .get(0).outerHTML
                );
            });

            this.messageData['html:target'] = teamHtmlList.join(', ');

            this.createMessage();

            return;
        }

        if (this.model.has('usersIds') && this.model.get('usersIds').length) {
            var userIdList = this.model.get('usersIds');
            var userNameHash = this.model.get('usersNames') || {};

            if (userIdList.length === 1 && userIdList[0] === this.model.get('createdById')) {
                this.messageName = 'mentionYouInPostTargetNoTarget';
                this.createMessage();

                return;
            }

            let userHtmlList = [];

            userIdList.forEach(userId => {
                let userName = userNameHash[userId];

                if (!userName) {
                    return;
                }

                userHtmlList.push(
                    $('<a>')
                        .attr('href', '#User/view/' + userId)
                        .text(userName)
                        .get(0).outerHTML
                );
            });

            this.messageData['html:target'] = userHtmlList.join(', ');

            this.createMessage();

            return;
        }

        if (this.model.get('targetType') === 'self') {
            this.messageName = 'mentionYouInPostTargetNoTarget';
        }

        this.createMessage();
    }
}

// noinspection JSUnusedGlobalSymbols
export default MentionInPostNoteStreamView;

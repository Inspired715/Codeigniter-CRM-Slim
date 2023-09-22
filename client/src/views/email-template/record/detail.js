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

define('views/email-template/record/detail', ['views/record/detail'], function (Dep) {

    return Dep.extend({

        duplicateAction: true,

        saveAndContinueEditingAction: true,

        setup: function () {
            Dep.prototype.setup.call(this);
            this.listenToInsertField();


            this.hideField('insertField');

            this.on('before:set-edit-mode', function () {
                this.showField('insertField');
            }, this);

            this.on('before:set-detail-mode', function () {
                this.hideField('insertField');
            }, this);
        },

        listenToInsertField: function () {
            this.listenTo(this.model, 'insert-field', function (o) {
                var tag = '{' + o.entityType + '.' + o.field + '}';

                var bodyView = this.getFieldView('body');
                if (!bodyView) return;

                if (this.model.get('isHtml')) {
                    var $anchor = $(window.getSelection().anchorNode);
                    if (!$anchor.closest('.note-editing-area').length) return;
                    bodyView.$summernote.summernote('insertText', tag);
                } else {
                    var $body = bodyView.$element;
                    var text = $body.val();
                    text += tag;
                    $body.val(text);
                }
            }, this);
        },
    });
});

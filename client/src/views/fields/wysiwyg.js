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

/** @module views/fields/wysiwyg */

import TextFieldView from 'views/fields/text';

/**
 * A wysiwyg field.
 */
class WysiwygFieldView extends TextFieldView {

    type = 'wysiwyg'

    listTemplate = 'fields/wysiwyg/detail'
    detailTemplate = 'fields/wysiwyg/detail'
    editTemplate = 'fields/wysiwyg/edit'

    height = 250
    rowsDefault = 10000
    fallbackBodySideMargin = 5
    fallbackBodyTopMargin = 4
    seeMoreDisabled = true
    fetchEmptyValueAsNull = false
    validationElementSelector = '.note-editor'
    htmlPurificationDisabled = false

    events = {
        /** @this WysiwygFieldView */
        'click .note-editable': function () {
            this.fixPopovers();
        },
        /** @this WysiwygFieldView */
        'focus .note-editable': function () {
            this.$noteEditor.addClass('in-focus');
        },
        /** @this WysiwygFieldView */
        'blur .note-editable': function () {
            this.$noteEditor.removeClass('in-focus');
        },
    }

    setup() {
        super.setup();

        this.wait(
            Espo.loader.requirePromise('lib!summernote')
                .then(() => {
                    if (!$.summernote.options || 'espoImage' in $.summernote.options) {
                        return;
                    }

                    this.initEspoPlugin();
                })
        );

        this.hasBodyPlainField = !!~this.getFieldManager()
            .getEntityTypeFieldList(this.model.entityType)
            .indexOf(this.name + 'Plain');

        if ('height' in this.params) {
            this.height = this.params.height;
        }

        if ('minHeight' in this.params) {
            this.minHeight = this.params.minHeight;
        }

        this.useIframe = this.params.useIframe || this.useIframe;

        this.setupToolbar();

        this.listenTo(this.model, 'change:isHtml', (model, value, o) => {
            if (o.ui && this.isEditMode()) {
                if (!this.isRendered()) {
                    return;
                }

                if (!model.has('isHtml') || model.get('isHtml')) {
                    let value = this.plainToHtml(this.model.get(this.name));

                    if (
                        this.lastHtmlValue &&
                        this.model.get(this.name) === this.htmlToPlain(this.lastHtmlValue)
                    ) {
                        value = this.lastHtmlValue;
                    }

                    this.model.set(this.name, value, {skipReRender: true});
                    this.enableWysiwygMode();

                    return;
                }

                this.lastHtmlValue = this.model.get(this.name);

                let value = this.htmlToPlain(this.model.get(this.name));

                this.disableWysiwygMode();

                this.model.set(this.name, value);

                return;
            }

            if (this.isDetailMode()) {
                if (this.isRendered()) {
                    this.reRender();
                }
            }
        });

        this.once('remove', () => {
            this.destroySummernote();
        });

        this.on('inline-edit-off', () => {
            this.destroySummernote();
        });

        this.on('render', () => {
            this.destroySummernote();
        });

        this.once('remove', () => {
            $(window).off('resize.' + this.cid);

            if (this.$scrollable) {
                this.$scrollable.off('scroll.' + this.cid + '-edit');
            }
        });
    }

    data() {
        let data = super.data();

        data.useIframe = this.useIframe;
        data.isPlain = this.isPlain();

        return data;
    }

    setupToolbar() {
        this.buttons = {};

        this.toolbar = this.params.toolbar || this.toolbar || [
            ['style', ['style']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table', 'espoLink', 'espoImage', 'hr']],
            ['misc', ['codeview', 'fullscreen']],
        ];

        if (this.params.toolbar) {
            return;
        }

        if (!this.params.attachmentField) {
            return;
        }

        this.toolbar.push(['attachment', ['attachment']]);

        this.buttons['attachment'] = () => {
            let ui = $.summernote.ui;

            let button = ui.button({
                contents: '<i class="fas fa-paperclip"></i>',
                tooltip: this.translate('Attach File'),
                click: () => {
                    this.attachFile();

                    this.listenToOnce(this.model, 'attachment-uploaded:attachments', () => {
                        if (this.isEditMode()) {
                            Espo.Ui.success(this.translate('Attached'));
                        }
                    });
                }
            });

            return button.render();
        };
    }

    isPlain() {
        return this.model.has('isHtml') && !this.model.get('isHtml');
    }

    fixPopovers() {
        $('body > .note-popover').removeClass('hidden');
    }

    getValueForDisplay() {
        let value = super.getValueForDisplay();

        if (this.isPlain()) {
            return value;
        }

        return this.sanitizeHtml(value);
    }

    sanitizeHtml(value) {
        if (value) {
            if (!this.htmlPurificationDisabled) {
                value = this.getHelper().sanitizeHtml(value);
            } else {
                value = this.sanitizeHtmlLight(value);
            }
        }

        return value || '';
    }

    sanitizeHtmlLight(value) {
       return this.getHelper().moderateSanitizeHtml(value);
    }

    getValueForEdit() {
        let value = this.model.get(this.name) || '';

        if (this.htmlPurificationForEditDisabled) {
            return this.sanitizeHtmlLight(value);
        }

        return this.sanitizeHtml(value);
    }

    afterRender() {
        super.afterRender();

        if (this.isEditMode()) {
            this.$summernote = this.$el.find('.summernote');
        }

        let language = this.getConfig().get('language');

        if (!(language in $.summernote.lang)) {
            $.summernote.lang[language] = this.getLanguage().translate('summernote', 'sets');
        }

        if (this.isEditMode()) {
            if (!this.model.has('isHtml') || this.model.get('isHtml')) {
                this.enableWysiwygMode();
            }
            else {
                this.$element.removeClass('hidden');
            }
        }

        if (this.isReadMode()) {
            this.renderDetail();
        }
    }

    renderDetail() {
        if (this.model.has('isHtml') && !this.model.get('isHtml')) {
            this.$el.find('.plain').removeClass('hidden');

            return;

        }

        if (!this.useIframe) {
            this.$element = this.$el.find('.html-container');

            return;
        }

        this.$el.find('iframe').removeClass('hidden');

        let $iframe = this.$el.find('iframe');

        let iframeElement = this.iframe = $iframe.get(0);

        if (!iframeElement) {
            return;
        }

        $iframe.on('load', () => {
            $iframe.contents().find('a').attr('target', '_blank');
        });

        let documentElement = iframeElement.contentWindow.document;

        let body = this.sanitizeHtml(this.model.get(this.name) || '');

        let useFallbackStylesheet = this.getThemeManager().getParam('isDark') && this.htmlHasColors(body);

        let $iframeContainer = $iframe.parent();

        useFallbackStylesheet ?
            $iframeContainer.addClass('fallback') :
            $iframeContainer.removeClass('fallback');

        let linkElement = iframeElement.contentWindow.document.createElement('link');

        linkElement.type = 'text/css';
        linkElement.rel = 'stylesheet';
        linkElement.href = this.getBasePath() + (
            useFallbackStylesheet ?
            this.getThemeManager().getIframeFallbackStylesheet() :
            this.getThemeManager().getIframeStylesheet()
        );

        body = linkElement.outerHTML + body;

        documentElement.write(body);
        documentElement.close();

        let $body = $iframe.contents().find('html body');

        $body.find('img').each((i, img) => {
            let $img = $(img);

            if ($img.css('max-width') !== 'none') {
                return;
            }

            $img.css('max-width', '100%');
        });

        let $document = $(documentElement);

        // Make dropdowns closed.
        $document.on('click', () => {
            let event = new MouseEvent('click', {
                bubbles: true,
            });

            $iframe[0].dispatchEvent(event);
        });

        // Make notifications & global-search popup closed.
        $document.on('mouseup', () => {
            let event = new MouseEvent('mouseup', {
                bubbles: true,
            });

            $iframe[0].dispatchEvent(event);
        });

        // Make shortcuts working.
        $document.on('keydown', e => {
            /** @var {KeyboardEvent} originalEvent */
            let originalEvent = e.originalEvent;

            let event = new KeyboardEvent('keydown', {
                bubbles: true,
                code: originalEvent.code,
                ctrlKey: originalEvent.ctrlKey,
                metaKey: originalEvent.metaKey,
                altKey: originalEvent.altKey,
            });

            $iframe[0].dispatchEvent(event);
        });

        let processWidth = function () {
            let bodyElement = $body.get(0);

            if (bodyElement) {
                if (bodyElement.clientWidth !== iframeElement.scrollWidth) {
                    iframeElement.style.height = (iframeElement.scrollHeight + 20) + 'px';
                }
            }
        };

        if (useFallbackStylesheet) {
            $iframeContainer.css({
                paddingLeft: this.fallbackBodySideMargin + 'px',
                paddingRight: this.fallbackBodySideMargin + 'px',
                paddingTop: this.fallbackBodyTopMargin + 'px',
            });
        }

        let increaseHeightStep = 10;

        let processIncreaseHeight = function (iteration, previousDiff) {
            $body.css('height', '');

            iteration = iteration || 0;

            if (iteration > 200) {
                return;
            }

            iteration ++;

            let diff = $document.height() - iframeElement.scrollHeight;

            if (typeof previousDiff !== 'undefined') {
                if (diff === previousDiff) {
                    $body.css('height', (iframeElement.clientHeight - increaseHeightStep) + 'px');
                    processWidth();

                    return;
                }
            }

            if (diff) {
                let height = iframeElement.scrollHeight + increaseHeightStep;

                iframeElement.style.height = height + 'px';
                processIncreaseHeight(iteration, diff);
            }
            else {
                processWidth();
            }
        };

        let processBg = () => {
            let color = iframeElement.contentWindow.getComputedStyle($body.get(0)).backgroundColor;

            $iframeContainer.css({
                backgroundColor: color,
            });
        };

        let processHeight = function (isOnLoad) {
            if (!isOnLoad) {
                $iframe.css({
                    overflowY: 'hidden',
                    overflowX: 'hidden'
                });

                iframeElement.style.height = '0px';
            }
            else {
                if (iframeElement.scrollHeight >= $document.height()) {
                    return;
                }
            }

            let $body = $iframe.contents().find('html body');
            let height = $body.height();

            if (height === 0) {
                height = $body.children(0).height() + 100;
            }

            iframeElement.style.height = height + 'px';

            processIncreaseHeight();

            if (!isOnLoad) {
                $iframe.css({
                    overflowY: 'hidden',
                    overflowX: 'scroll'
                });
            }
        };

        $iframe.css({
            visibility: 'hidden'
        });

        setTimeout(() => {
            processHeight();

            $iframe.css({
                visibility: 'visible'
            });

            $iframe.on('load', () => {
                processHeight(true);

                if (useFallbackStylesheet) {
                    processBg();
                }
            });
        }, 40);

        if (!this.model.get(this.name)) {
            $iframe.addClass('hidden');
        }

        let windowWidth = $(window).width();

        $(window).off('resize.' + this.cid);
        $(window).on('resize.' + this.cid, () => {
            if ($(window).width() !== windowWidth) {
                processHeight();
                windowWidth = $(window).width();
            }
        });
    }

    enableWysiwygMode() {
        if (!this.$element) {
            return;
        }

        this.$element.addClass('hidden');
        this.$summernote.removeClass('hidden');

        let contents = this.getValueForEdit();

        this.$summernote.html(contents);

        this.$summernote.find('style').remove();
        this.$summernote.find('link[ref="stylesheet"]').remove();

        let keyMap = Espo.Utils.cloneDeep($.summernote.options.keyMap);

        keyMap.pc['CTRL+K'] = 'espoLink.show';
        keyMap.mac['CMD+K'] = 'espoLink.show';
        keyMap.pc['CTRL+DELETE'] = 'removeFormat';
        keyMap.mac['CMD+DELETE']  = 'removeFormat';

        delete keyMap.pc['CTRL+ENTER'];
        delete keyMap.mac['CMD+ENTER'];
        delete keyMap.pc['CTRL+BACKSLASH'];
        delete keyMap.mac['CMD+BACKSLASH'];

        let toolbar = this.toolbar;

        let lastChangeKeydown = new Date();
        const changeKeydownInterval = this.changeInterval * 1000;

        let options = {
            espoView: this,
            lang: this.getConfig().get('language'),
            keyMap: keyMap,
            callbacks: {
                onImageUpload: (files) =>  {
                    let file = files[0];

                    Espo.Ui.notify(this.translate('Uploading...'));

                    this.uploadInlineAttachment(file)
                        .then(attachment => {
                            let url = '?entryPoint=attachment&id=' + attachment.id;
                            this.$summernote.summernote('insertImage', url);

                            Espo.Ui.notify(false);
                        });
                },
                onBlur: () => {
                    this.trigger('change');
                },
                onKeydown: () => {
                    if (Date.now() - lastChangeKeydown > changeKeydownInterval) {
                        this.trigger('change');
                        lastChangeKeydown = Date.now();
                    }
                },
            },
            onCreateLink(link) {
                return link;
            },
            toolbar: toolbar,
            buttons: this.buttons,
            dialogsInBody: this.$el,
            codeviewFilter: true,
        };

        if (this.height) {
            options.height = this.height;
        }
        else {
            let $scrollable = this.$el.closest('.modal-body');

            if (!$scrollable.length) {
                $scrollable = $(window);
            }

            this.$scrollable = $scrollable;

            $scrollable.off('scroll.' + this.cid + '-edit');
            $scrollable.on('scroll.' + this.cid + '-edit', (e) => {
                this.onScrollEdit(e);
            });
        }

        if (this.minHeight) {
            options.minHeight = this.minHeight;
        }

        this.destroySummernote();

        this.$summernote.summernote(options);
        this.summernoteIsInitialized = true;

        this.$toolbar = this.$el.find('.note-toolbar');
        this.$area = this.$el.find('.note-editing-area');

        this.$noteEditor = this.$el.find('> .note-editor');
    }

    focusOnInlineEdit() {
        if (this.$noteEditor)  {
            this.$summernote.summernote('focus');

            return;
        }

        super.focusOnInlineEdit();
    }

    uploadInlineAttachment(file) {
        return new Promise((resolve, reject) => {
            this.getModelFactory().create('Attachment', attachment => {
                let fileReader = new FileReader();

                fileReader.onload = (e) => {
                    attachment.set('name', file.name);
                    attachment.set('type', file.type);
                    attachment.set('role', 'Inline Attachment');
                    attachment.set('global', true);
                    attachment.set('size', file.size);

                    if (this.model.id) {
                        attachment.set('relatedId', this.model.id);
                    }

                    attachment.set('relatedType', this.model.entityType);
                    attachment.set('file', e.target.result);
                    attachment.set('field', this.name);

                    attachment
                        .save()
                        .then(() => resolve(attachment))
                        .catch(() => reject());
                };

                fileReader.readAsDataURL(file);
            });
        });
    }

    destroySummernote() {
        if (this.summernoteIsInitialized && this.$summernote) {
            this.$summernote.summernote('destroy');
            this.summernoteIsInitialized = false;
        }
    }

    plainToHtml(html) {
        html = html || '';

        return html.replace(/\n/g, '<br>');
    }

    htmlToPlain(text) {
        text = text || '';

        let value = text
            .replace(/<br\s*\/?>/mg, '\n')
            .replace(/<\/p\s*\/?>/mg, '\n\n');

        let $div = $('<div>').html(value);

        $div.find('style').remove();
        $div.find('link[ref="stylesheet"]').remove();

        value =  $div.text();

        return value;
    }

    disableWysiwygMode() {
        this.destroySummernote();

        this.$noteEditor = null;

        if (this.$summernote) {
            this.$summernote.addClass('hidden');
        }

        this.$element.removeClass('hidden');

        if (this.$scrollable) {
            this.$scrollable.off('scroll.' + this.cid + '-edit');
        }
    }

    fetch() {
        let data = {};

        if (!this.model.has('isHtml') || this.model.get('isHtml')) {
            let code = this.$summernote.summernote('code');

            if (code === '<p><br></p>') {
                code = '';
            }

            let imageTagString = '<img src="' + window.location.origin + window.location.pathname +
                '?entryPoint=attachment';

            code = code.replace(
                new RegExp(imageTagString.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1"), 'g'),
                '<img src="?entryPoint=attachment'
            );
            data[this.name] = code;
        }
        else {
            data[this.name] = this.$element.val();

            if (this.fetchEmptyValueAsNull) {
                if (!data[this.name]) {
                    data[this.name] = null;
                }
            }
        }

        if (this.model.has('isHtml') && this.hasBodyPlainField) {
            if (this.model.get('isHtml')) {
                data[this.name + 'Plain'] = this.htmlToPlain(data[this.name]);
            }
            else {
                data[this.name + 'Plain'] = data[this.name];
            }
        }

        return data;
    }

    onScrollEdit(e) {
        let $target = $(e.target);
        let toolbarHeight = this.$toolbar.height();
        let toolbarWidth = this.$toolbar.parent().width();
        let edgeTop, edgeTopAbsolute;

        if ($target.get(0) === window.document) {
            let $buttonContainer = $target.find('.detail-button-container:not(.hidden)');
            let offset = $buttonContainer.offset();

            if (offset) {
                edgeTop = offset.top + $buttonContainer.height();
                edgeTopAbsolute = edgeTop - $(window).scrollTop();
            }
        }
        else {
            let offset = $target.offset();

            if (offset) {
                edgeTop = offset.top;
                edgeTopAbsolute = edgeTop - $(window).scrollTop();
            }
        }

        let top = this.$el.offset().top;
        let bottom = top + this.$el.height() - toolbarHeight;

        let toStick = false;

        if (edgeTop > top && bottom > edgeTop) {
            toStick = true;
        }

        if (toStick) {
            this.$toolbar.css({
                top: edgeTopAbsolute + 'px',
                width: toolbarWidth + 'px',
            });

            this.$toolbar.addClass('sticked');

            this.$area.css({
                marginTop: toolbarHeight + 'px',
                backgroundColor: ''
            });

            return;
        }

        this.$toolbar.css({
            top: '',
            width: '',
        });

        this.$toolbar.removeClass('sticked');

        this.$area.css({
            marginTop: '',
        });
    }

    attachFile() {
        let $form = this.$el.closest('.record');

        $form.find('.field[data-name="' + this.params.attachmentField + '"] input.file').click();
    }

    initEspoPlugin() {
        let langSets = this.getLanguage().get('Global', 'sets', 'summernote') || {
            image: {},
            link: {},
            video: {},
        };

        $.extend($.summernote.options, {
            espoImage: {
                icon: '<i class="note-icon-picture"/>',
                tooltip: langSets.image.image,
            },
            espoLink: {
                icon: '<i class="note-icon-link"/>',
                tooltip: langSets.link.link,
            },
        });

        $.extend($.summernote.plugins, {
            'espoImage': function (context) {
                let ui = $.summernote.ui;
                let options = context.options;
                let self = options.espoView;
                let lang = options.langInfo;

                if (!self) {
                    return;
                }

                context.memo('button.espoImage', () => {
                    let button = ui.button({
                        contents: options.espoImage.icon,
                        tooltip: options.espoImage.tooltip,
                        click() {
                            context.invoke('espoImage.show');
                        },
                    });

                    return button.render();
                });

                this.initialize = function () {};

                this.destroy = function () {
                    if (!self) {
                        return;
                    }

                    self.clearView('insertImageDialog');
                };

                this.show = function () {
                    self.createView('insertImageDialog', 'views/wysiwyg/modals/insert-image', {
                        labels: {
                            insert: lang.image.insert,
                            url: lang.image.url,
                            selectFromFiles: lang.image.selectFromFiles,
                        },
                    }, view => {
                        view.render();

                        self.listenToOnce(view, 'upload', (target) => {
                            self.$summernote.summernote('insertImagesOrCallback', target);
                        });

                        self.listenToOnce(view, 'insert', (target) => {
                            self.$summernote.summernote('insertImage', target);
                        });

                        self.listenToOnce(view, 'close', () => {
                            self.clearView('insertImageDialog');
                            self.fixPopovers();
                        });
                    });
                };
            },

            'linkDialog': function (context) {
                let options = context.options;
                let self = options.espoView;
                let lang = options.langInfo;

                if (!self) {
                    return;
                }

                this.show = function () {
                    let linkInfo = context.invoke('editor.getLinkInfo');

                    self.createView('dialogInsertLink', 'views/wysiwyg/modals/insert-link', {
                        labels: {
                            insert: lang.link.insert,
                            openInNewWindow: lang.link.openInNewWindow,
                            url: lang.link.url,
                            textToDisplay: lang.link.textToDisplay,
                        },
                        linkInfo: linkInfo,
                    }, view => {
                        view.render();

                        self.listenToOnce(view, 'insert', (data) => {
                            self.$summernote.summernote('createLink', data);
                        });

                        self.listenToOnce(view, 'close', () => {
                            self.clearView('dialogInsertLink');
                            self.fixPopovers();
                        });
                    });
                };
            },

            'espoLink': function (context) {
                let ui = $.summernote.ui;
                let options = context.options;
                let self = options.espoView;
                let lang = options.langInfo;

                if (!self) {
                    return;
                }

                let isMacLike = /(Mac|iPhone|iPod|iPad)/i.test(navigator.platform);

                context.memo('button.espoLink', function () {
                    let button = ui.button({
                        contents: options.espoLink.icon,
                        tooltip: options.espoLink.tooltip + ' (' + (isMacLike ? 'CMD+K': 'CTRL+K') +')',
                        click() {
                            context.invoke('espoLink.show');
                        },
                    });

                    return button.render();
                });

                this.initialize = function () {
                    this.$modalBody = self.$el.closest('.modal-body');

                    this.isInModal = this.$modalBody.length > 0;
                };

                this.destroy = function () {
                    if (!self) {
                        return;
                    }

                    self.clearView('dialogInsertLink');
                };

                this.show = function () {
                    let linkInfo = context.invoke('editor.getLinkInfo');

                    let container = this.isInModal ? this.$modalBody.get(0) : window;

                    self.createView('dialogInsertLink', 'views/wysiwyg/modals/insert-link', {
                        labels: {
                            insert: lang.link.insert,
                            openInNewWindow: lang.link.openInNewWindow,
                            url: lang.link.url,
                            textToDisplay: lang.link.textToDisplay,
                        },
                        linkInfo: linkInfo,
                    }, (view) => {
                        view.render();

                        self.listenToOnce(view, 'insert', (data) => {
                            let scrollY = ('scrollY' in container) ?
                                container.scrollY :
                                container.scrollTop;

                            self.$summernote.summernote('createLink', data);

                            setTimeout(() => container.scroll(0, scrollY), 20);
                        });

                        self.listenToOnce(view, 'close', () => {
                            self.clearView('dialogInsertLink');
                            self.fixPopovers();
                        });
                    });
                };
            },

            'fullscreen': function (context) {
                let options = context.options;
                let self = options.espoView;
                //let lang = options.langInfo;
                //let ui = $.summernote.ui;

                if (!self) {
                    return;
                }

                this.$window = $(window);
                this.$scrollbar = $('html, body');

                this.initialize = function () {
                    this.$editor = context.layoutInfo.editor;
                    this.$toolbar = context.layoutInfo.toolbar;
                    this.$editable = context.layoutInfo.editable;
                    this.$codable = context.layoutInfo.codable;

                    this.$modal = self.$el.closest('.modal');
                    this.isInModal = this.$modal.length > 0;
                };

                this.resizeTo = function (size) {
                    this.$editable.css('height', size.h);
                    this.$codable.css('height', size.h);

                    if (this.$codable.data('cmeditor')) {
                        this.$codable.data('cmeditor').setsize(null, size.h);
                    }
                };

                this.onResize = function () {
                    this.resizeTo({
                        h: this.$window.height() - this.$toolbar.outerHeight(),
                    });
                };

                this.isFullscreen = function () {
                    return this.$editor.hasClass('fullscreen');
                };

                this.destroy = function () {
                    this.$window.off('resize.summernote' + self.cid);

                    if (this.isInModal) {
                        this.$modal.css('overflow-y', '');
                    }
                    else {
                        this.$scrollbar.css('overflow', '');
                    }
                };

                this.toggle = function () {
                    this.$editor.toggleClass('fullscreen');

                    if (this.isFullscreen()) {
                        this.$editable.data('orgHeight', this.$editable.css('height'));
                        this.$editable.data('orgMaxHeight', this.$editable.css('maxHeight'));
                        this.$editable.css('maxHeight', '');

                        this.$window
                            .on('resize.summernote' + self.cid, this.onResize.bind(this))
                            .trigger('resize');

                        if (this.isInModal) {
                            this.$modal.css('overflow-y', 'hidden');
                        }
                        else {
                            this.$scrollbar.css('overflow', 'hidden');
                        }

                        this._isFullscreen = true;
                    }
                    else {
                        this.$window.off('resize.summernote'  + self.cid);
                        this.resizeTo({ h: this.$editable.data('orgHeight') });
                        this.$editable.css('maxHeight', this.$editable.css('orgMaxHeight'));

                        if (this.isInModal) {
                            this.$modal.css('overflow-y', '');
                        } else {
                            this.$scrollbar.css('overflow', '');
                        }

                        this._isFullscreen = false;
                    }

                    context.invoke('toolbar.updateFullscreen', this.isFullscreen());
                };
            },
        });
    }

    htmlHasColors(string) {
        if (~string.indexOf('background-color:')) {
            return true;
        }

        if (~string.indexOf('color:')) {
            return true;
        }

        if (~string.indexOf('<font color="')) {
            return true;
        }

        return false;
    }
}

export default WysiwygFieldView;

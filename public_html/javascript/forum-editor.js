(function () {
    'use strict';

    function closestButton(target) {
        while (target && target !== document) {
            if (target.getAttribute && target.getAttribute('data-forum-command')) {
                return target;
            }
            target = target.parentNode;
        }
        return null;
    }

    function initEditor(editor) {
        var source = document.getElementById('forum-editor-source');
        var htmlField = document.getElementById('forum-editor-html');
        var dirtyField = document.getElementById('forum-editor-dirty');
        var transport = document.getElementById('forum-media-transport');
        var toolbar = document.querySelector('.forum-visual-toolbar');
        var form = editor.closest ? editor.closest('form') : null;
        if (!form && document.forms) {
            form = document.forms['forumpost'];
        }
        var renderUrl = editor.getAttribute('data-render-url');
        var savedRange = null;

        // Use semantic paragraphs for Enter. Shift+Enter remains a line break.
        // This also makes the editor's live view match the stored/rendered post.
        try {
            document.execCommand('defaultParagraphSeparator', false, 'p');
        } catch (ignore) {}

        function rememberSelection() {
            var selection = window.getSelection ? window.getSelection() : null;
            if (!selection || selection.rangeCount === 0) {
                return;
            }

            var range = selection.getRangeAt(0);
            if (editor.contains(range.commonAncestorContainer)) {
                savedRange = range.cloneRange();
            }
        }

        function restoreSelection() {
            var selection;
            if (!savedRange || !window.getSelection) {
                editor.focus();
                return;
            }

            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(savedRange);
        }

        function markDirty() {
            dirtyField.value = '1';
            htmlField.value = editor.innerHTML;
            if (source) {
                source.value = editor.innerText || editor.textContent || '';
            }
            rememberSelection();
        }

        function insertTextAtSelection(text) {
            var selection;
            var range;
            var node;

            restoreSelection();
            selection = window.getSelection ? window.getSelection() : null;

            if (selection && selection.rangeCount) {
                range = selection.getRangeAt(0);
                range.deleteContents();
                node = document.createTextNode(text);
                range.insertNode(node);
                range.setStartAfter(node);
                range.collapse(true);
                selection.removeAllRanges();
                selection.addRange(range);
                savedRange = range.cloneRange();
            } else {
                editor.appendChild(document.createTextNode(text));
            }

            markDirty();
            editor.focus();
        }

        window.forumVisualEditorInsertText = insertTextAtSelection;

        function runCommand(command) {
            restoreSelection();

            if (command === 'link') {
                var url = window.prompt('URL');
                if (!url) {
                    return;
                }
                document.execCommand('createLink', false, url);
            } else if (command === 'quote') {
                document.execCommand('formatBlock', false, 'blockquote');
            } else if (command === 'code') {
                document.execCommand('formatBlock', false, 'pre');
            } else {
                document.execCommand(command, false, null);
            }

            markDirty();
            editor.focus();
        }

        function insertEmbed(token, html) {
            var span = document.createElement('span');
            var selection;
            var range;

            span.className = 'forum-editor-embed';
            span.setAttribute('contenteditable', 'false');
            span.setAttribute('data-forum-autotag', token);
            span.innerHTML = html;

            restoreSelection();
            selection = window.getSelection ? window.getSelection() : null;

            if (selection && selection.rangeCount) {
                range = selection.getRangeAt(0);
                range.deleteContents();
                range.insertNode(span);
                range.setStartAfter(span);
                range.collapse(true);
                selection.removeAllRanges();
                selection.addRange(range);
                savedRange = range.cloneRange();
            } else {
                editor.appendChild(span);
            }

            editor.appendChild(document.createTextNode(' '));
            markDirty();
        }

        function renderAutotag(token) {
            if (!renderUrl || !window.fetch) {
                insertEmbed(token, '<span class="forum-editor-embed-label">Media</span>');
                return;
            }

            fetch(renderUrl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                body: 'token=' + encodeURIComponent(token)
            })
                .then(function (response) { return response.json(); })
                .then(function (data) {
                    insertEmbed(token, data && data.html ? data.html : '<span class="forum-editor-embed-label">Media</span>');
                })
                .catch(function () {
                    insertEmbed(token, '<span class="forum-editor-embed-label">Media</span>');
                });
        }

        editor.addEventListener('keydown', function (event) {
            if (event.key !== 'Enter') {
                return;
            }

            rememberSelection();

            if (event.shiftKey) {
                event.preventDefault();
                restoreSelection();

                var selection = window.getSelection ? window.getSelection() : null;
                var range = selection && selection.rangeCount ? selection.getRangeAt(0) : null;
                if (!range) {
                    return;
                }

                var br = document.createElement('br');
                br.setAttribute('data-forum-soft-break', '1');
                range.deleteContents();
                range.insertNode(br);
                range.setStartAfter(br);
                range.collapse(true);
                selection.removeAllRanges();
                selection.addRange(range);
                savedRange = range.cloneRange();
                markDirty();
                return;
            }

            // A normal Enter is a paragraph boundary. Browsers do not behave
            // consistently for contenteditable, so force insertParagraph.
            event.preventDefault();
            restoreSelection();
            document.execCommand('insertParagraph', false, null);
            markDirty();
        });

        editor.addEventListener('input', markDirty);
        editor.addEventListener('keyup', rememberSelection);
        editor.addEventListener('mouseup', rememberSelection);
        editor.addEventListener('focus', rememberSelection);

        document.addEventListener('selectionchange', function () {
            if (document.activeElement === editor || editor.contains(document.activeElement)) {
                rememberSelection();
            }
        });

        if (toolbar) {
            toolbar.addEventListener('mousedown', function (event) {
                var button = closestButton(event.target);
                if (button) {
                    event.preventDefault();
                }
            });

            toolbar.addEventListener('click', function (event) {
                var button = closestButton(event.target);
                if (!button) {
                    return;
                }
                event.preventDefault();
                runCommand(button.getAttribute('data-forum-command'));
            });
        }

        if (transport) {
            transport.addEventListener('input', function () {
                var token = transport.value;
                if (!token) {
                    return;
                }
                transport.value = '';
                renderAutotag(token);
            });
        }

        if (form) {
            form.addEventListener('submit', function () {
                if (dirtyField.value === '1') {
                    htmlField.value = editor.innerHTML;
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        var editor = document.getElementById('forum-visual-editor');
        if (editor) {
            initEditor(editor);
        }
    });
}());

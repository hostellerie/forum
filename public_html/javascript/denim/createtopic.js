(function () {
    'use strict';

    function getEditorText() {
        var editor = document.getElementById('forum-visual-editor');
        var source = document.querySelector('textarea[name="comment"]');

        if (editor) {
            return (editor.innerText || editor.textContent || '').replace(/^\s+|\s+$/g, '');
        }

        return source ? source.value.replace(/^\s+|\s+$/g, '') : '';
    }

    window.checkForm = function () {
        if (getEditorText().length < 2) {
            window.alert('You must enter a message when posting.');
            return false;
        }

        return true;
    };

    window.emoticon = function (text) {
        var editor = document.getElementById('forum-visual-editor');
        var source = document.querySelector('textarea[name="comment"]');

        text = ' ' + text + ' ';

        if (editor) {
            if (typeof window.forumVisualEditorInsertText === 'function') {
                window.forumVisualEditorInsertText(text);
            } else {
                editor.focus();
                document.execCommand('insertText', false, text);
                editor.dispatchEvent(new Event('input', {bubbles: true}));
            }
            return;
        }

        if (source) {
            var start = typeof source.selectionStart === 'number' ? source.selectionStart : source.value.length;
            var end = typeof source.selectionEnd === 'number' ? source.selectionEnd : start;
            source.value = source.value.substring(0, start) + text + source.value.substring(end);
            source.focus();
        }
    };

    window.AddRowsToTable = function () {
        var table = document.getElementById('tblforumfile');
        var lastRow;
        var row;
        var cell;
        var input;

        if (!table) {
            return;
        }

        lastRow = table.rows.length;
        row = table.insertRow(lastRow);
        cell = row.insertCell(0);
        input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('name', 'mfile_forum[]');
        input.setAttribute('size', '40');
        cell.appendChild(input);
    };

    window.RemoveRowFromTable = function () {
        var table = document.getElementById('tblforumfile');
        if (table && table.rows.length > 0) {
            table.deleteRow(table.rows.length - 1);
        }
    };
}());

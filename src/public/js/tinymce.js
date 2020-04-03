var getContentLength = function(tinymce) {
    return tinymce.activeEditor.getContent().replace(/(<([^>]+)>)/ig,"").length;
}

var updateCharCounter = function(el, len) {
    $('#' + el.id)
    	.siblings('.tox-tinymce')
		.find('.tox-editor-container')
    	.find('.char_count').text(len + '/' + el.settings.max_chars);
}


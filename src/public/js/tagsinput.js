$(document).ready(function(){
	var tagsInput = $('[data-tagsinput]'),
	elTagsInput = [];

	var initTagsInput = function(element, index) {
		var config = $(element).data('tagsinputConfig'),
			id = $(element).attr('id'),
			isMultiple = (typeof config.isMultiple !== 'undefined') ? config.isMultiple : true;

		elTagsInput[index] = new Bloodhound({
		  datumTokenizer: Bloodhound.tokenizers.obj.whitespace(config.fieldName),
		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		  remote: {
			url: config.apiUrl
				 + ((typeof config.fields !== 'undefined') ? '?fields=' + config.fields : ''),
			wildcard: '%QUERY%',
			rateLimitBy: 'debounce',
	        rateLimitWait: 300,
	        replace: function(url, query) {
	        	return url+'&q='+query;
	        },
			filter: function(item) {
				return item.data;
			}
		  }
		});

		elTagsInput[index].initialize();

		$(element).tagsinput({
		  	typeaheadjs: {
				name: config.name,
				displayKey: config.fieldName,
				valueKey: config.fieldName,
				source: elTagsInput[index].ttAdapter()
			}
		});

		if (!isMultiple) {
			$(element).on('beforeItemAdd', function(e) {
	            $(this).tagsinput('removeAll');
	            $(this).prev().find('.tt-input').hide();
	            $(this).parent().find('.btnadd').attr('disabled','disabled');
	        });

	        $(element).on('beforeItemRemove', function(e) {
	            $(this).prev().find('.tt-input').show();
	            $(this).parent().find('.btnadd').removeAttr('disabled');
	        });
		}

	}

	tagsInput.each(function(index, element) {
	    initTagsInput(element, index);
	});

});

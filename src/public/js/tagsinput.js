$(document).ready(function(){
	var tagsInput = $('[data-tagsinput]'),
	elTagsInput = [];

	var setTagsInput = function(target, data) {
	    $.each(data, function(index, value){
	        if ($.trim(value) != '' && $.trim(value) != '[""]') {
	            $(target).tagsinput('add', value);
	        }
	    });
	}


	var initTagsInput = function(element, index) {
		var config = $(element).data('tagsinputConfig'),
			id = $(element).attr('id'),
			isMultiple = (typeof config.isMultiple !== 'undefined') ? config.isMultiple : true,
			options = settings = {};

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

		options = {
				name: config.name,
				displayKey: config.fieldName,
				source: elTagsInput[index].ttAdapter()
			};

		settings = {
			typeaheadjs: [{preventPost: true}, options]
		};

		$.extend(settings, {
				itemValue: config.fieldName,
	            itemText: config.fieldName,
	        });


		$(element).tagsinput(settings);

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

		var target = $('#'+config.name+'List');
		$(element).change(function() {
			target.val(JSON.stringify($(element).tagsinput('items')));
		});

		if (target.val() !== '') {
	        var selected = target.val();
	        selected = $.parseJSON(selected);
	        setTagsInput(element, selected);
	    }
	}

	tagsInput.each(function(index, element) {
	    initTagsInput(element, index);
	});



});

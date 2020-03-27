var tagsInput = $('[data-tagsinput]'),
	elTagsInput = [];

$(document).ready(function(){
	tagsInput.each(function(index, element) {
	    initTagsInput(element, index);
	});
});

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
		options = settings = {},
		urlQueryKeyword = (typeof config.urlQueryKeyword !== 'undefined') ? config.urlQueryKeyword : '&q';

	elTagsInput[index] = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace(config.fieldName),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  remote: {
		url: config.apiUrl
			 + ((typeof config.fields !== 'undefined') ? '?fields=' + config.fields : '')
			 + ((typeof config.visibility !== 'undefined') ? '&visibility=' + config.visibility : ''),
		wildcard: '%QUERY%',
		rateLimitBy: 'debounce',
        rateLimitWait: 300,
        replace: function(url, query) {
        	return url+urlQueryKeyword+'='+query;
        },
		filter: function(item) {
			if (typeof getSeoTopic !== 'undefined' && config.name == 'seo_topic') {
				return (item) ? getSeoTopic(item) : {};
			} else {
				return item.data;
			}
		}
	  }
	});

	elTagsInput[index].initialize();

	options = {
			name: config.name,
			displayKey: config.fieldName,
			source: elTagsInput[index].ttAdapter(),
			templates: {
	            suggestion: function(data){
	                if(!config.isObj) {
	                    return '<ul><li class="text-left"><span>' + data[config.fieldName] +'</span>'+
	                    '<span class="pull-right">' + data[config.fieldCountName] + '</span></li></ul>';
	                }else{
	                    return '<div class="text-left"><span>' + data[config.fieldName] + '</span></div>';
	                }
	            }
	        }
		};

	if (!config.isObj) {
		$.extend(options, {valueKey: config.fieldName});
	}

	settings = {
		typeaheadjs: [{preventPost: true}, options]
	};

	if (config.isObj) {
		$.extend(settings, {
			itemValue: config.fieldName,
            itemText: config.fieldName,
        });
	}

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
		var items = config.isObj
                ? JSON.stringify($(element).tagsinput('items'))
                : $(element).tagsinput('items');
		target.val(items);
	});

	if (target.val() !== '') {
        var selected = target.val();
        if (!config.isObj) {
        	selected = selected.split(',');
        } else {
        	selected = $.parseJSON(selected);
        }
        setTagsInput(element, selected);
    }
}

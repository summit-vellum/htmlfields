$(document).on('change', '[toggle-field]', function(){
	if ($(this).prop('checked') == true) {
       $('input[name="'+$(this).attr('id')+'"]').val(1);
    } else {
    	$('input[name="'+$(this).attr('id')+'"]').val(0);
    }
});


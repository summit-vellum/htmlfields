$(document).ready(function(){
	var dateTimePicker = $('[date-time-picker]');

	dateTimePicker.each(function(index, datetimepicker) {
		var element = '#'+$(datetimepicker).attr('id'),
		dateNow = moment(new Date()).format('YYYY-MM-DD hh:mm A'),
		date = $(element).val(),
		startDate = (date) ? date : dateNow,
		attributes = $(element).data('config');

		attributes['element'] = element;

		if (typeof attributes.startDate !== 'undefined' && attributes.startDate != '') {
			attributes['startDate'] = attributes.startDate;
	    } else {
	    	attributes['startDate'] = moment(startDate).format('YYYY-MM-DD hh:mm A');
	    }

		attributes['datetimepicker'] = datetimepicker;

		loadDatePicker(attributes);
	});

	// prevent popup from closing when user clicks apply on date picker
	$(document).on('click', '.datepicker-container, .daterangepicker, .next.available, .prev.available',
		function(event){
			event.stopPropagation();
		}
	);
});

var loadDatePicker = function(attr) {
	var settings = {},
		el = $(attr.datetimepicker).parents().find('[time-picker-'+$(attr.datetimepicker).attr('id')+']');

	settings = {
		startDate: attr.startDate,
		alwaysShowCalendars: true,
	 	locale: {'format': 'YYYY-MM-DD hh:mm A'},
	 	opens: 'left',
	 	autoUpdateInput: false,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
	};

	if (typeof attr.minDate !== 'undefined' && attr.minDate != '') {
        $.extend(settings, {
            minDate:attr.minDate
        });
    }

	if (typeof attr.endDate !== 'undefined' && attr.endDate != '') {
        $.extend(settings, {
            endDate:attr.endDate
        });
    }

    if (typeof attr.localeFormat !== 'undefined' && attr.localeFormat != '') {
        $.extend(settings, {
            locale: {'format': attr.localeFormat}
        });
    }

	if (typeof attr.single !== 'undefined' && attr.single === true) {
		$.extend(settings, {
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
        });
        delete settings.ranges;
	}

	el.daterangepicker(settings);

	el.on('apply.daterangepicker', function(ev, picker) {
		$(attr.element).val(picker.startDate.format(attr.dateFormat) + '-' + picker.endDate.format(attr.dateFormat));
		if (typeof attr.single !== 'undefined' && attr.single === true) {
            var options = {
                weekday: "short", year: "numeric", month: "short",
                day: "numeric", hour: "2-digit", minute: "2-digit"
            };

            if (typeof attr.copyOn !== 'undefined' && attr.copyOn != '') {
            	$(attr.copyOn).val(picker.startDate.format(attr.dateFormat));
            }

            $(attr.element).val(picker.startDate.format(attr.dateFormat));
        }
	});

}

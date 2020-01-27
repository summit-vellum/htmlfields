@input(['id' => $attributes['id'], 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

{{-- // data-target-input="nearest" --}}

    @form

		<div class="input-group date input-group-sm">
          <input
            name="{{ $attributes['id'] }}"
            type="{{ isset($attributes['hideOnForms']) ? 'hidden' : 'text' }}"
            value="{{ old($attributes['id'], $value) }}"
            id="{{ $attributes['id'] }}"
            @isset($attributes['required']) {{ 'required' }} @endisset
            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}">
            <span class="input-group-btn">
	            <span class="btn btn-default border-left-0">
					@icon(['icon' => 'filter-calendar', 'classes'=>'pull-left'])
	            </span>
	        </span>
        </div>

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


@push('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

	<script type="text/javascript">
	$(document).ready(function(){
		var element = '#{{ $attributes['id'] }}',
			dateNow = moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
			date = '{{ old($attributes['id'], $value) }}',
			actualDate = (date) ? date : dateNow;

		$(element).val(actualDate);
		loadDatePicker(actualDate);

		function loadDatePicker(date) {
			$('.input-group.date').daterangepicker({
			 	singleDatePicker: true,
			 	timePicker: true,
			 	startDate: date,
			 	locale: {"format": 'YYYY-MM-DD HH:mm:ss'},
			}, function(start) {
			 	dateSelected = start.format('YYYY-MM-DD HH:mm:ss');
	       		$(element).val(dateSelected);
			});
		}
	});
	</script>
@endpush

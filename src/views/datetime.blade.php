


@input(['id' => $attributes['id']])
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
            type="text"
            value="{{ old($attributes['id'], $value) }}"
            id="{{ $attributes['id'] }}"
            @isset($attributes['required']) {{ 'required' }} @endisset
            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}">
          <!-- <div class="">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M17 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h2V3a1 1 0 1 1 2 0v1h6V3a1 1 0 0 1 2 0v1zm-2 2H9v1a1 1 0 1 1-2 0V6H5v4h14V6h-2v1a1 1 0 0 1-2 0V6zm4 6H5v8h14v-8z"/></svg>
          </div> -->
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

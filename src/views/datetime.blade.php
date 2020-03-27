@form
	@input(['id' => $attributes['id'],
	'hidden' => isset($attributes['hideOnForms']) ? 'hide' : '',
	'attributes' => ($attributes ?? '')])
	@slot('label')
	    {{ $attributes['name'] }}
	@endslot

	@slot('help')
	    {{ $attributes['help'] ?? '' }}
	@endslot

	@slot('customLabelClasses')
        {{ $attributes['customLabelClasses'] ?? '' }}
    @endslot

    @slot('labelClasses')
        {{ $attributes['labelClasses'] ?? '' }}
    @endslot

    @slot('yieldAt')
    	{{ $attributes['yieldAt'] ?? '' }}
    @endslot

	<div class="input-group date input-group-sm" time-picker-{{ $attributes['id'] }}>
	  <input
	    name="{{ $attributes['id'] }}"
	    type="{{ isset($attributes['hideOnForms']) ? 'hidden' : 'text' }}"
	    value="@if($data)@include('vellum::cell', ['attributes' => $attributes, 'data' => $data])@else{{old($attributes['id'], $value)}}@endif"
	    id="{{ $attributes['id'] }}"
	    @isset($attributes['required']) {{ 'required' }} @endisset
	    class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
	    date-time-picker
	    data-config="{{ $attributes['data-config'] ?? '' }}"
	    />
	    <span class="input-group-btn">
	        <span class="btn btn-default border-left-0">
				@icon(['icon' => 'filter-calendar', 'classes'=>'pull-left'])
	        </span>
	    </span>
	</div>

	@endinput
@else

	<div class='input-group date input-group-sm mb-2' time-picker-{{ $attributes['id'] }}>
		<input
			name='{{ $attributes["id"] }}'
			type=''
			value='{{ $value }}'
			id='{{ $attributes["id"] }}'
			class='{{ $attributes["classes"] ?? "" }}'
			date-time-picker
			data-config='{{ $attributes["data-config"] ?? '' }}'
		/>
		<span class='input-group-btn'>
	        <span class='btn btn-default border-left-0'>
				@icon(['icon' => 'filter-calendar', 'classes'=>'pull-left'])
	        </span>
	    </span>
	</div>

@endform


@push('css')
@endpush

@push('scripts')

@endpush

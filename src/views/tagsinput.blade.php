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
        <input
            name="{{ $attributes['id'] }}"
            type="{{ isset($attributes['hideOnForms']) ? 'hidden' : 'text' }}"
            value="{{ old($attributes['id'], $value) }}"
            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
            id="{{ $attributes['id'] }}"
            autocomplete="off"
            placeholder="{{ isset($attributes['placeholder']) ? $attributes['placeholder'] : '' }}"
            @if(isset($attributes['tagsinput'])) {{ $attributes['tagsinput'] }} @endif
            @if(isset($attributes['tagsinput-config'])) data-tagsinput-config="{{ $attributes['tagsinput-config'] }}" @endif
            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
            />


        <input type="hidden" id="{{ $attributes['id'] }}List" name="{{ $attributes['id'] }}" value="@if($data)@include('vellum::cell', ['attributes' => $attributes, 'data' => $data])@else{{ old($attributes['id'], $value) }}@endif">
    @endinput
@else
	<div class="mb-2">
	   	<input
	        type='text'
	        value=''
	        class='{{ (isset($attributes["classes"])) ? $attributes["classes"] : "" }}'
	        id='{{ $attributes["id"] }}'
	        placeholder='{{ $attributes["placeholder"] }}'
	        data-tagsinput
	    	data-tagsinput-config='{{ $attributes["tagsinput-config"] }}'
	    />
		<input type="hidden" id="{{ $attributes['id'] }}List" name="{{ $attributes['id'] }}" value='{{ $value }}'>
	</div>
@endform




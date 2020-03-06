
@input(['id' => $attributes['id'], 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @form

      @if(isset($attributes['container']) && $attributes['container']['sectionName'])
		@section($attributes['container']['sectionName'])
	  @endif

	      <input
	        name="{{ $attributes['id'] }}-uploader"
	        type="file"
	        id="{{ $attributes['id'] }}-uploader"
	        onchange="readURL(this);"
	        @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
	        class="hidden"
	        >

	      <label for="{{ $attributes['id'] }}-uploader"
	        class="btn btn-success btn-block cf-button"
	        >
	        <span>{{ $attributes['label'] }}</span>
	      </label>

	        <input type="text" name="{{ $attributes['id'] }}" id="{{ $attributes['id'] }}" value="{{ old($attributes['id'], $value) }}"
	            class="py-2 px-3 border-none w-64 focus:border-none hidden"
	            readonly
	        >

        @if(isset($attributes['container']) && $attributes['container']['sectionName'])
        	@stop
        @endif

        @if(isset($attributes['container']) && $attributes['container']['view'])
        	{!! $attributes['container']['view'] !!}
        @endif



    @endform

    @slot('extra')
        @includeIf('field::imagePreview', [
            'id' => $attributes['id'],
            'image' => $value ]
            )
    @endslot

@endinput

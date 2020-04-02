
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

    @form

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
	        <span>{{ $attributes['label'] ?? '' }}</span>
	      </label>

	        <input type="text" name="{{ $attributes['id'] }}" id="{{ $attributes['id'] }}" value="{{ old($attributes['id'], $value) }}"
	            class="py-2 px-3 border-none w-64 focus:border-none hidden"
	            readonly
	        >

    @endform

    @slot('extra')
        @includeIf('field::imagePreview', [
            'id' => $attributes['id'],
            'image' => $value ]
            )
    @endslot

@endinput

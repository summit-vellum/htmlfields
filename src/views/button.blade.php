@input(['id' => $attributes['id'],
'hidden' => isset($attributes['hideOnForms']) ? 'hide' : '',
'attributes' => ($attributes ?? '')])

	@slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('labelClasses')
        {{ $attributes['labelClasses'] ?? '' }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @form

       <button
       		id="{{ $attributes['id'] }}"
       		name="{{ $attributes['id'] }}"
       		type="button"
       		class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
       		{!! $attributes['dataAttributes'] ?? '' !!}>
       	{{ (isset($attributes['staticValue'])) ? $attributes['staticValue'] : '' }}</button>

    @else

    @endform

@endinput


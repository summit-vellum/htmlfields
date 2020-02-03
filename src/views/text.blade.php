
@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot


    @form

        <input
            name="{{ $attributes['id'] }}"
            type="{{ isset($attributes['hideOnForms']) ? 'hidden' : 'text' }}"
            value="{{ old($attributes['id'], $value) }}"
            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
            id="{{ $attributes['id'] }}"
            autocomplete="off"
            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
            />

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


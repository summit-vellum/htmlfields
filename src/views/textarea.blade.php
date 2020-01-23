
@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot


    @form

        <textarea
            name="{{  $attributes['id'] }}"
            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
            id="{{  $attributes['id'] }}"
            {{-- @isset($attributes['required']) {{ 'required' }} @endisset --}}
            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
            />{{ old($attributes['id'], $value) }}</textarea>

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput

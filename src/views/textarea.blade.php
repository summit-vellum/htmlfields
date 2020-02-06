
@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @slot('maxCharacters')
        {{ $attributes['max-characters'] ?? '' }}
    @endslot

    @slot('maxCharactersHelp')
        {{ $attributes['max-characters-help'] ?? '' }}
    @endslot


    @form

        <textarea
            name="{{  $attributes['id'] }}"
            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
            id="{{  $attributes['id'] }}"
            max-characters="{{ isset($attributes['max-characters']) ? $attributes['max-characters'] : '' }}"
            {{-- @isset($attributes['required']) {{ 'required' }} @endisset --}}
            {{ isset($attributes['autoslug-src']) ? 'autoslug='.$attributes['autoslug-src'] : '' }}
            {{ isset($attributes['autoslug']) ? 'autoslug-' . $attributes['autoslug'] . '=' . $attributes['autoslug-once'] : '' }}
            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
            />{{ old($attributes['id'], $value) }}</textarea>

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput

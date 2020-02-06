
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

        <input
            name="{{ $attributes['id'] }}"
            type="{{ isset($attributes['hideOnForms']) ? 'hidden' : 'text' }}"
            value="{{ old($attributes['id'], $value) }}"
            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
            id="{{ $attributes['id'] }}"
            max-characters="{{ isset($attributes['max-characters']) ? $attributes['max-characters'] : '' }}"
            {{ isset($attributes['autoslug-src']) ? 'autoslug='.$attributes['autoslug-src'] : '' }}
            autocomplete="off"
            {{ isset($attributes['autoslug']) ? 'autoslug-' . $attributes['autoslug'] . '=' . $attributes['autoslug-once'] : '' }}
            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
            />

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


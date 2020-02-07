
@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @slot('maxCount')
        {{ $attributes['max-count'] ?? '' }}
    @endslot

    @slot('maxCountHelp')
        {{ $attributes['max-count-help'] ?? '' }}
    @endslot

    @slot('required')
        {{ isset($attributes['required']) ? true : '' }}
    @endslot
    
    @form

        <input
            name="{{ $attributes['id'] }}"
            type="{{ isset($attributes['hideOnForms']) ? 'hidden' : 'text' }}"
            value="{{ old($attributes['id'], $value) }}"
            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
            id="{{ $attributes['id'] }}"
            min-count="{{ isset($attributes['min-count']) ? $attributes['min-count'] : '' }}"
            max-count="{{ isset($attributes['max-count']) ? $attributes['max-count'] : '' }}"
            {{ isset($attributes['autoslug-src']) ? 'autoslug='.$attributes['autoslug-src'] : '' }}
            autocomplete="off"
            {{ isset($attributes['autoslug']) ? 'autoslug-' . $attributes['autoslug'] . '=' . $attributes['autoslug-once'] : '' }}
            {{ isset($attributes['required']) ? 'required' : '' }}
            />

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


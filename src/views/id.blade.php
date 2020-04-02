
@input(['id' => $attributes['id'], 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])
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
            name="{{ $attributes['name'] }}"
            type="{{ isset($attributes['hideOnForms']) ? 'hidden' : 'text' }}"
            value="{{ old($attributes['name'], $value) }}"
            class="form-control"
            id="{{ $attributes['name'] }}"
            autocomplete="off"
            @isset($attributes['required']) {{ 'required' }} @endisset
            />

    @else

        <div>
            {!! $value !!}
        </div>

    @endform

@endinput

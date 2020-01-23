
@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot


    @form

        <input
            name="{{ $attributes['name'] }}"
            type="text"
            value="{{ old($attributes['name'], $value) }}"
            class="form-control"
            id="{{ $attributes['name'] }}"
            autocomplete="off"
            @isset($attributes['required']) {{ 'required' }} @endisset
            @isset($attributes['hideOnForms']) {{ 'hidden' }} @endisset
            />

    @else

        <div>
            {!! $value !!}
        </div>

    @endform

@endinput

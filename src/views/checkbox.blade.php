
@input(['id' => $attributes['id'], 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @slot('required')
        {{ isset($attributes['required']) ? true : '' }}
    @endslot

    @slot('customLabelClasses')
        {{ $attributes['customLabelClasses'] ?? '' }}
    @endslot


    @form

        <input
            name="{{ $attributes['id'] }}"
            type="checkbox"
            value="{{ old($attributes['id'], $value) }}"
            class="w-full rounded py-2 px-3 border shadow"
            id="{{ $attributes['id'] }}"
            autocomplete="off"

            @foreach(config('form.attributes') as $attr)
                {{ isset($attributes[$attr]) ? $attr : '' }}
            @endforeach
            />

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput

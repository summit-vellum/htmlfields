
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
            type="text"
            value="{{ old($attributes['id'], $value) }}"
            class="w-full rounded py-2 px-3 border shadow"
            id="{{ $attributes['id'] }}"
            autocomplete="off"
            @if(isset($attributes['tagsinput'])) {{ $attributes['tagsinput'] }} @endif
            @if(isset($attributes['tagsinput-config'])) data-tagsinput-config="{{ $attributes['tagsinput-config'] }}" @endif
            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
            />

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


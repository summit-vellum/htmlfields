@input(['id' => $name, 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])
    @slot('label')
        {{ $data['label'] }}
    @endslot

    @slot('help')
        {{ $data['help'] ?? '' }}
    @endslot

    @slot('required')
        {{ isset($attributes['required']) ? true : '' }}
    @endslot

    @slot('customLabelClasses')
        {{ $attributes['customLabelClasses'] ?? '' }}
    @endslot

    @slot('labelClasses')
        {{ $attributes['labelClasses'] ?? '' }}
    @endslot

    <select
        name="{{ $name }}"
        class="custom-select"
        id="{{ $name }}"
        style="width: auto;"

        @foreach(config('form.attributes') as $attr)
            {{ isset($attributes[$attr]) ? $attr : '' }}
        @endforeach
        >
        <option value=""> -- </option>

        @foreach($data['values'] as $id => $val)
            <option value="{{ $id }}" {{ (old($name, $value) == $id) ? "selected" : "" }}>{{ $val }}</option>
        @endforeach
    </select>
@endinput

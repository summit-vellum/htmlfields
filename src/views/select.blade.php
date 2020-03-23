
@input(['id' => $attributes['id'],
'hidden' => isset($attributes['hideOnForms']) ? 'hide' : '',
'attributes' => ($attributes ?? '')])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @slot('required')
        {{ isset($attributes['required']) ? true : '' }}
    @endslot

    @slot('customLabel')
        {{ $attributes['label-classes'] ?? '' }}
    @endslot

    @form

      <select
        name="{{ $attributes['id'] }}"
        id="{{ $attributes['id'] }}"
        class="selectpicker {{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
        data-style="cf-input flat"
		@foreach(config('form.attributes') as $attr)
			{{ isset($attributes[$attr]) ? $attr : '' }}
		@endforeach
        >

        <option value=""> -- </option>
        <!--  add selected function to helpers.php --- selected($attributes, $value, $id)  -->
        @foreach($attributes['options'] as $id => $val)
            <option value="{{ $id }}" {{ selected($attributes, $value, $id) }}>{{ $val }}</option>
        @endforeach

      </select>


    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


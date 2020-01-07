
@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @form

        <div class="inline-block w-auto relative">
          <select
            name="{{ $attributes['id'] }}"
            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
            id="{{ $attributes['id'] }}"
            class="block appearance-none w-auto bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">

            <option value=""> -- </option>

            @foreach($attributes['options'] as $id => $val)
                <option value="{{ $id }}" {{ selected($attributes, $value, $id) }}>{{ $val }}</option>
            @endforeach

          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          	@icon(['icon' => 'chevron-down'])
          </div>
        </div>

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput

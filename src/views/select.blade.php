
@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @form

        <div class="row">
        	<div class="col-md-6 cf-select-container">
	          <select
	            name="{{ $attributes['id'] }}"
	            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
	            id="{{ $attributes['id'] }}"
	            class="selectpicker {{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
	            data-style="cf-input flat">

	            <option value=""> -- </option>
	            <!--  add selected function to helpers.php --- selected($attributes, $value, $id)  -->
	            @foreach($attributes['options'] as $id => $val)
	                <option value="{{ $id }}">{{ $val }}</option>
	            @endforeach

	          </select>
	      	</div>
        </div>

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


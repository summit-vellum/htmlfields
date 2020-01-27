
@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @form


    		@if(isset($attributes['container']) && $attributes['container']['sectionName'])
    			@section($attributes['container']['sectionName'])
    		@endif

	          <select
	            name="{{ $attributes['id'] }}"
	            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
	            id="{{ $attributes['id'] }}"
	            class="selectpicker {{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
	            data-style="cf-input flat">

	            <option value=""> -- </option>
	            <!--  add selected function to helpers.php --- selected($attributes, $value, $id)  -->
	            @foreach($attributes['options'] as $id => $val)
	                <option value="{{ $id }}" {{ selected($attributes, $value, $id) }}>{{ $val }}</option>
	            @endforeach

	          </select>

	        @if(isset($attributes['container']) && $attributes['container']['sectionName'])
	        	@stop
	        @endif

	        @if(isset($attributes['container']) && $attributes['container']['view'])
	        	{!! $attributes['container']['view'] !!}
	        @endif


    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


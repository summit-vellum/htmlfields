@input(['id' => $attributes['id'], 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])

    @form
    	@if(isset($attributes['labelElement']))
        	<{{$attributes['labelElement']}}>{{ old($attributes['name'], $value) }}</{{$attributes['labelElement']}}>
        @endif
    @else
        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>
    @endform

@endinput


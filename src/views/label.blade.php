@input(['id' => $attributes['id'],
'hidden' => isset($attributes['hideOnForms']) ? 'hide' : '',
'attributes' => ($attributes ?? '')])

    @form

       	@if(isset($attributes['staticValue']) && isset($attributes['labelElement']))
       		<{{$attributes['labelElement']}} class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}">{{ $attributes['staticValue'] }}</{{$attributes['labelElement']}}>
       	@elseif(isset($attributes['labelElement']))
        	<{{$attributes['labelElement']}} class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}">@if($data)@include('vellum::cell', ['attributes' => $attributes, 'data' => $data])@else{{ old($attributes['id'], $value) }}@endif</{{$attributes['labelElement']}}>
       	@else
       		<label>@if($data)@include('vellum::cell', ['attributes' => $attributes, 'data' => $data])@else{{ old($attributes['id'], $value) }}@endif</label>
        @endif

    @else
        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>
    @endform

@endinput


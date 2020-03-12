
@input(['id' => $attributes['id'], 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @slot('maxCount')
        {{ $attributes['max-count'] ?? '' }}
    @endslot

    @slot('maxCountHelp')
        {{ $attributes['max-count-help'] ?? '' }}
    @endslot

    @slot('required')
        {{ isset($attributes['required']) ? true : '' }}
    @endslot

    @slot('customLabel')
        {{ $attributes['label-classes'] ?? '' }}
    @endslot

    @slot('uniqueMsg')
        {{ $attributes['unique-message'] ?? '' }}
    @endslot

    @form

    	  @if(isset($attributes['container']) && $attributes['container']['sectionName'])
			@section($attributes['container']['sectionName'])
		  @endif

	        <input
	            name="{{ $attributes['id'] }}"
	            type="{{ isset($attributes['hideOnForms']) ? 'hidden' : 'text' }}"
	            value="@if($data)@include('vellum::cell', ['attributes' => $attributes, 'data' => $data])@else{{old($attributes['id'], $value)}}@endif"
	            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
	            id="{{ $attributes['id'] }}"
	            min-count="{{ isset($attributes['min-count']) ? $attributes['min-count'] : '' }}"
	            max-count="{{ isset($attributes['max-count']) ? $attributes['max-count'] : '' }}"
	            placeholder="{{ isset($attributes['placeholder']) ? $attributes['placeholder'] : '' }}"
	            unique-message="{{ isset($attributes['unique-message']) ? $attributes['unique-message'] : '' }}"
	            {{ isset($attributes['unique-message']) ? 'unique-message='.$attributes['unique-message'] : '' }}
	            {{ isset($attributes['autoslug-src']) ? 'autoslug='.$attributes['autoslug-src'] : '' }}
	            autocomplete="off"

	            @foreach(config('form.attributes') as $attr)
	                {{ isset($attributes[$attr]) ? $attr : '' }}
	            @endforeach

	            {{ isset($attributes['autoslug']) ? 'autoslug-' . $attributes['autoslug'] . '=' . $attributes['autoslug-once'] : '' }}
	            />

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


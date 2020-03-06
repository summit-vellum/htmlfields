
@input(['id' => $attributes['id'], 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot


    @form
    	@php
    		$relationshipData = '';
    	@endphp

    	@if($data)
	    	@if(array_key_exists('relation', $attributes))
			    @if(array_key_exists('modify', $attributes))

			        <?php $relationshipData = call_user_func_array($attributes['modify'], [
			            $data->getRelationshipObject($attributes['relation']),
			            $data
			            ]) ?>
			    @endif
		    @endif
	    @endif

        <input
            name="{{ $attributes['id'] }}"
            type="{{ isset($attributes['hideOnForms']) ? 'hidden' : 'text' }}"
            value="{{ old($attributes['id'], $value) }}"
            class="{{ (isset($attributes['classes'])) ? $attributes['classes'] : '' }}"
            id="{{ $attributes['id'] }}"
            autocomplete="off"
            placeholder="{{ isset($attributes['placeholder']) ? $attributes['placeholder'] : '' }}"
            @if(isset($attributes['tagsinput'])) {{ $attributes['tagsinput'] }} @endif
            @if(isset($attributes['tagsinput-config'])) data-tagsinput-config="{{ $attributes['tagsinput-config'] }}" @endif
            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
            />


        <input type="hidden" id="{{ $attributes['id'] }}List" name="{{ $attributes['id'] }}" value="{{ (!empty($relationshipData)) ? $relationshipData : old($attributes['id'], $value) }}">
    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


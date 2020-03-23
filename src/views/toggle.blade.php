@input(['id' => $attributes['id'], 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])

	@slot('label')
        {{ $attributes['name'] }}
    @endslot

    @form

        <div class="bg-text">
            <span class="pl-3 py-3 inline-block">{{ $attributes['name'] }}</span>
            <input type="hidden" name="{{ $attributes['id'] }}" value={{old($attributes['id'], $value)}}>
            <span class="pr-3 py-2 pull-right inline-block">
                <input type="checkbox" class="form-check-input pull-right" id="{{ $attributes['id'] }}" value="1" data-toggle="toggle" data-size="small" data-onstyle="success" data-style="ios" toggle-field {{ (old($attributes['id'], $value)) ? 'checked' : '' }}>
            </span>
        </div>

    @else

    @endform

@endinput


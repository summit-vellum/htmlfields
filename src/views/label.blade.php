@input(['id' => $attributes['id'], 'hidden' => isset($attributes['hideOnForms']) ? 'hide' : ''])

    @form

        <h1>{{ old($attributes['name'], $value) }}</h1>

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


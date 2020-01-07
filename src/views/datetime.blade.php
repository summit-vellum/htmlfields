


@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

{{-- // data-target-input="nearest" --}}

    @form

       {{--  <div class="input-group date" style="max-width: 18rem;">
            <input
                name="{{ $attributes['id'] }}"
                type="text"
                value="{{ old($attributes['id'], $value) }}"
                class="form-control"
                id="{{ $attributes['id'] }}"
                style="width: auto;"
                @isset($attributes['required']) {{ 'required' }} @endisset
                />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
        </div> --}}

        <div class="inline-block w-auto relative">
          <input
            name="{{ $attributes['id'] }}"
            type="text"
            value="{{ old($attributes['id'], $value) }}"
            id="{{ $attributes['id'] }}"
            @isset($attributes['required']) {{ 'required' }} @endisset
            class="block appearance-none w-auto bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" >
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 py-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M17 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h2V3a1 1 0 1 1 2 0v1h6V3a1 1 0 0 1 2 0v1zm-2 2H9v1a1 1 0 1 1-2 0V6H5v4h14V6h-2v1a1 1 0 0 1-2 0V6zm4 6H5v8h14v-8z"/></svg>
          </div>
        </div>

    @else

        <div>
            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </div>

    @endform

@endinput


@push('css')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script type="text/javascript">
        // $('.input-group.date').datepicker({
        //     format: "M dd, yyyy",
        //     maxViewMode: 2,
        //     todayBtn: "linked",
        //     clearBtn: true
        // });
        $(function () {
            // $('#{{ $attributes['id'] }}').datetimepicker();
        });
    </script>
@endpush

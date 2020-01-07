
@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @form
    
      {{--   <div class="custom-file" style="width: auto;">
            <input type="text" name="{{ $attributes['id'] }}" value="{{ old($attributes['id'], $value) }}" >
            <input 
                type="file" 
                class="custom-file-input" 
                id="{{ $attributes['id'] }}" 
                style="width: auto;"
                @isset($attributes['required']) {{ 'required' }} @endisset
                onchange="readURL(this);"
                >
            <label class="custom-file-label" for="{{ $attributes['id'] }}">Choose file...</label>
        </div> --}}

        <div class="">
          <input 
            name="{{ $attributes['id'] }}-uploader"
            type="file" 
            {{-- value="{{ old($attributes['id'], $value) }}"  --}}
            id="{{ $attributes['id'] }}-uploader" 
            onchange="readURL(this);"
            {{-- @isset($attributes['required']) {{ 'required' }} @endisset --}}
            @if(isset($attributes['required']) && $attributes['required'] === 1) {{ 'required' }} @endif
            class="hidden" 
            {{-- class="block appearance-none w-auto bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"  --}}
            >
            <div class="inline-block">
              <label for="{{ $attributes['id'] }}-uploader" 
                class="flex item-center cursor-pointer rounded px-4 py-2 bg-blue-500 w-auto text-white font-semibold"
                {{-- class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 py-2 text-gray-700" --}}
                >
                <svg class="fill-current h-4 w-4 mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="heroicon-ui" d="M13 5.41V17a1 1 0 0 1-2 0V5.41l-3.3 3.3a1 1 0 0 1-1.4-1.42l5-5a1 1 0 0 1 1.4 0l5 5a1 1 0 1 1-1.4 1.42L13 5.4zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"/></svg>
                <span>Upload</span>
              </label>
            </div>
            <input type="text" name="{{ $attributes['id'] }}" id="{{ $attributes['id'] }}" value="{{ old($attributes['id'], $value) }}" 
                class="py-2 px-3 border-none w-64 focus:border-none"
                readonly 
            >
        </div>


    @endform

    @slot('extra')
        @includeIf('field::imagePreview', [
            'id' => $attributes['id'],
            'image' => $value ]
            )
    @endslot

@endinput

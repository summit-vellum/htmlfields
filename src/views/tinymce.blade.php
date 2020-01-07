

@input(['id' => $attributes['id']])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot


    @form


        <textarea
            name="{{ $attributes['id'] }}"
            class="form-control"
            id="{{ $attributes['id'] }}"
            @isset($attributes['required']) {{ 'required' }} @endisset
            />{{ old($attributes['id'], $value) }}</textarea>

    @else

        <details>
            <summary class="text-primary mb-2">Show Post Content</summary>

            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </details>

    @endform

@endinput


@form

    @push('scripts')
        <script src="{{ url('vendor/tinymce/tinymce.min.js') }}"></script>

        <script>
            @stack('shortcode_scripts')
        </script>

        <script>

        	function closeModal(){
        		$('#modal').addClass('hidden');
        	}

            tinymce.init({
                selector:'#{{ $attributes['id'] }}',
                height: 500,
                width: '100%',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help | shortcodes' ,
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tiny.cloud/css/codepen.min.css'
                ],
                setup: function(editor) {

                    {{-- var app = @json($shortcodes); --}}
                    @if(!empty($shortcodes))

                    editor.ui.registry.addIcon('shortcodes', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M17 22a2 2 0 0 1-2-2v-1a1 1 0 0 0-1-1 1 1 0 0 0-1 1v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-3H5a3 3 0 1 1 0-6h1V8c0-1.11.9-2 2-2h3V5a3 3 0 1 1 6 0v1h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1a1 1 0 0 0-1 1 1 1 0 0 0 1 1h1a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3zm3-2v-3h-1a3 3 0 1 1 0-6h1V8h-3a2 2 0 0 1-2-2V5a1 1 0 0 0-1-1 1 1 0 0 0-1 1v1a2 2 0 0 1-2 2H8v3a2 2 0 0 1-2 2H5a1 1 0 0 0-1 1 1 1 0 0 0 1 1h1a2 2 0 0 1 2 2v3h3v-1a3 3 0 1 1 6 0v1h3z"/></svg>');


                        @foreach($shortcodes as $shortcode)

                            editor.ui.registry.addIcon('{{$shortcode->settings()['text']}}', '{!! $shortcode->settings()['icon'] !!}');

                        @endforeach



                    editor.ui.registry.addMenuButton('shortcodes', {
                        text: 'Shortcodes',
                        icon: 'shortcodes',
                        fetch: function(callback) {

                            var items = [
                            @foreach($shortcodes as $shortcode)
                            {
                                type: 'menuitem',
                                text: '{{ ucfirst($shortcode->settings()['label']) }}',
                                icon: '{{ $shortcode->settings()['text'] }}',
                                onAction: {!! view($shortcode->settings()['text'].'::shortcode',
                                			['shortcode' => $shortcode->settings()])->render() !!}
                            }
                            @endforeach
                            ];

                            callback(items);
                        }
                    });

                    @endif
                }
            });

            document.querySelector('#insert-shortcode').addEventListener('click', function(event){
        		var iframe = document.querySelector('[name="modal"]');

        		var shortcode = iframe.contentWindow.document.querySelector('#shortcode').value;
        		tinymce.get('content').execCommand('mceInsertContent', false, shortcode);

        		closeModal();

            	event.preventDefault();
            });

        </script>
    @endpush

@endform

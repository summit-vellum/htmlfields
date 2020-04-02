@input(['id' => $attributes['id'],
'hidden' => isset($attributes['hideOnForms']) ? 'hide' : '',
'attributes' => ($attributes ?? '')])
    @slot('label')
        {{ $attributes['name'] }}
    @endslot

    @slot('required')
        {{ isset($attributes['required']) ? true : '' }}
    @endslot

    @slot('help')
        {{ $attributes['help'] ?? '' }}
    @endslot

    @slot('labelClasses')
        {{ $attributes['labelClasses'] ?? '' }}
    @endslot

    @form

    	<textarea
    	rows="{{ isset($attributes['tinymceRows']) ? $attributes['tinymceRows'] : '' }}"
        name="{{ $attributes['id'] }}{{ isset($attributes['anArrayField']) ? '[]' : ''}}"
        class="form-control"
        id="{{ $attributes['id'] }}"
        @isset($attributes['required']) {{ 'required' }} @endisset
        {!! $attributes['dataAttributes'] ?? '' !!}
        />{!! old($attributes['id'], $value) !!}</textarea>

    @else

        <details>
            <summary class="text-primary mb-2">Show Post Content</summary>

            @include('vellum::cell', ['attributes' => $attributes, 'data' => $data])
        </details>

    @endform

@endinput

@form
    @push('scripts')
        <script>
            @stack('shortcode_scripts')
        </script>
        <script>
        	var tools = 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | customBullist customNumlist | link code | shortcodes | fullscreen';

        	$(document).ready(function(){

        		var settings = {
	                selector:'#{{ $attributes['id'] }}',
	                // height: 500,
	                width: '100%',
	                menubar: false,
	                plugins: [
	                    'advlist autolink lists link image charmap print preview anchor',
	                    'searchreplace visualblocks code fullscreen',
	                    'insertdatetime media table paste code help wordcount'
	                ],
	                content_css: [
	                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
	                    '//www.tiny.cloud/css/codepen.min.css'
	                ],
	                setup: function(editor) {

	                	@if(isset($attributes['tinyMceAttr']) && isset($attributes['tinyMceAttr']['charCount']))
		                	editor.on('keyup', function (e) {
		                		updateCharCounter(this, getContentLength(tinymce));
				            });
				        @endif

				        @if(isset($attributes['tinyMceAttr']) && isset($attributes['tinyMceAttr']['maxChars']))
				        	var allowedKeys = [8, 37, 38, 39, 40, 46]; // backspace, delete and cursor keys
				            editor.on('keydown', function (e) {
				                if (allowedKeys.indexOf(e.keyCode) != -1) return true;
				                if (getContentLength(tinymce) + 1 > this.settings.max_chars) {
				                    e.preventDefault();
				                    e.stopPropagation();
				                    return false;
				                }
				                return true;
				            });
				        @endif


	                    @if(!empty($shortcodes))

	                    editor.ui.registry.addIcon('shortcodes', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M17 22a2 2 0 0 1-2-2v-1a1 1 0 0 0-1-1 1 1 0 0 0-1 1v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-3H5a3 3 0 1 1 0-6h1V8c0-1.11.9-2 2-2h3V5a3 3 0 1 1 6 0v1h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1a1 1 0 0 0-1 1 1 1 0 0 0 1 1h1a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3zm3-2v-3h-1a3 3 0 1 1 0-6h1V8h-3a2 2 0 0 1-2-2V5a1 1 0 0 0-1-1 1 1 0 0 0-1 1v1a2 2 0 0 1-2 2H8v3a2 2 0 0 1-2 2H5a1 1 0 0 0-1 1 1 1 0 0 0 1 1h1a2 2 0 0 1 2 2v3h3v-1a3 3 0 1 1 6 0v1h3z"/></svg>');


	                        @foreach($shortcodes as $shortcode)
	                            editor.ui.registry.addIcon('{{$shortcode['text']}}', '{!! $shortcode['icon'] !!}');

	                        @endforeach

	                    editor.ui.registry.addMenuButton('shortcodes', {
	                        text: 'Shortcodes',
	                        icon: 'shortcodes',
	                        fetch: function (callback) {
	                            var items = [
	                            @foreach($shortcodes as $shortcode)
	                            {
	                                type: 'menuitem',
	                                text: '{{ ucfirst($shortcode['label']) }}',
	                                icon: '{{ $shortcode['text'] }}',
	                                onAction: {!! view($shortcode['text'].'::shortcode',
	                                			['shortcode' => $shortcode])->render() !!}
	                            },
	                            @endforeach
	                            ];

	                            callback(items);
	                        }
	                    });

	                    @endif
	                }
	            };

	            @if(isset($attributes['tinyMceAttr']) && isset($attributes['tinyMceAttr']['tools']))
	            	var customTools = '{{ $attributes['tinyMceAttr']['tools'] }}';
		            $.extend(settings, {
		            	toolbar: customTools
		            });
		        @else
		        	$.extend(settings, {
		            	toolbar: tools
		            });
	            @endif

	            @if(isset($attributes['tinyMceAttr']) && isset($attributes['tinyMceAttr']['hideStatusBar']))
	            	$.extend(settings, {
	            		statusbar: false
	            	});
	            @endif

	            @if(isset($attributes['tinyMceAttr']) && isset($attributes['tinyMceAttr']['charCount']) && isset($attributes['tinyMceAttr']['maxChars']))
	            	$.extend(settings, {
	            		max_chars: '{{ $attributes['tinyMceAttr']['maxChars'] }}',
	            		init_instance_callback: function () {
	            			// initializes counter div with max char count
				            $('#' + this.id).siblings('.tox-tinymce')
				            				.find('.tox-editor-container')
				            				.append($('<div class="char_count" style="text-align:right;color:#999;padding:4px;"></div>'));
				            updateCharCounter(this, getContentLength(tinymce));
				        },
				        paste_preprocess: function (plugin, args) {
				            var activeEditor = tinymce.get(tinymce.activeEditor.id);
				            var len = activeEditor.contentDocument.body.innerText.length;
				            var text = $(args.content).text();
				            if (len + text.length > activeEditor.settings.max_chars) {
				                alert('Pasting this exceeds the maximum allowed number of ' + activeEditor.settings.max_chars + ' characters.');
				                args.content = '';
				            } else {
				                updateCharCounter(activeEditor, len + text.length);
				            }
				        }
	            	});
	            @endif

        		tinymce.init(settings);
        	});
        </script>
    @endpush

@endform

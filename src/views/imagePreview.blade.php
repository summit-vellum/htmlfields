<div class="py-3
	@form
		hidden
	@endform
    ">

    @if(empty($image))
        <img
            src="https://fakeimg.pl/250x100/"
            class="w-full"
            alt="..."
            id="imagePreview-{{ $id }}-uploader" width="675" height="380">
    @else
        <img src="{{ asset($image) ?? 'https://fakeimg.pl/250x100/' }}" class="card-img-top" alt="..." id="imagePreview-{{ $id }}-uploader" width="675" height="380">
    @endif

    <a href="{{ asset($image) ?? 'https://fakeimg.pl/250x100/' }}" download class="flex item-center mt-3 text-sm text-blue-500 hidden">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 fill-current mr-1"><path class="heroicon-ui" d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"/></svg>
        <span>Download</span>
    </a>

</div>

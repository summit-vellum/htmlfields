<?php

namespace Quill\Html\Fields;

use Quill\Html\Fields\BaseField;
use Quill\Html\Contracts\Asset;

class TagsinputField extends BaseField implements Asset
{

    public function getStyle()
    {
        return [
            'vendor/html/css/bootstrap-tagsinput.css'
        ];
    }

    public function getScript()
    {
        return [
            'vendor/html/js/tagsinput/typeahead.bundle.js', //src: visit http://twitter.github.io/typeahead.js/examples/
            'vendor/html/js/tagsinput/bootstrap-tagsinput.min.js', //src: https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/
            'vendor/html/js/tagsinput.js'
        ];
    }
}

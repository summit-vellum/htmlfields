<?php

namespace Quill\Html\Fields;

use Quill\Html\Fields\BaseField;
use Quill\Html\Contracts\Asset;

class TinymceField extends BaseField implements Asset
{
    public function getStyle()
    {
        return   [
            //
        ];
    }

    public function getScript()
    {
        return   [
           'vendor/html/js/tinymce/tinymce.min.js',
           'vendor/html/js/tinymce.js'
        ];
    }
}

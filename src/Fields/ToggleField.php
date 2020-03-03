<?php

namespace Quill\Html\Fields;

use Quill\Html\Fields\BaseField;
use Quill\Html\Contracts\Asset;

class ToggleField extends BaseField implements Asset
{

    public function getStyle()
    {
        return [
            'vendor/html/css/bootstrap-toggle.min.css'
        ];
    }

    public function getScript()
    {
        return [
            'vendor/html/js/bootstrap-toggle.min.js',
            'vendor/html/js/toggle.js'
        ];
    }
}

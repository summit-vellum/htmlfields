<?php

namespace Quill\Html\Fields;

use Quill\Html\Fields\BaseField;
use Quill\Html\Contracts\Asset;

class DatetimeField extends BaseField implements Asset
{
    public function getStyle()
    {
        return   [
            'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',
            'https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css'
        ];
    }

    public function getScript()
    {
        return   [
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js',
            'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
            'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
            'vendor/html/js/datetime.js'
        ];
    }
}

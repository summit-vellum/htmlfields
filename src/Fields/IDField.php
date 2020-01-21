<?php

namespace Quill\Html\Fields;

use Quill\Html\Fields\BaseField;
use Illuminate\Support\Str;


class IDField extends BaseField
{
    public function make($name = 'id', $slug = false)
    {
        parent::make($name);

        return $this;
    }
}

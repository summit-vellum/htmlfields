<?php

namespace Quill\Html\Fields;

use Quill\Html\Fields\BaseField;
use Illuminate\Support\Str;
use Quill\Html\Contracts\Asset;

class IDField extends BaseField implements Asset
{
    public function make($name = 'id', $slug = false)
    {
        parent::make($name);

        return $this;
    }

    public function getStyle()
    {
        return [
            //
        ];
    }

    public function getScript()
    {
        return [
            //
        ];
    }
}

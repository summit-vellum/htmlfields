<?php

namespace Quill\Html\Fields;

use Closure;
use Quill\Html\Fields\BaseField;
use Quill\Html\Contracts\Asset;

class ImageField extends BaseField implements Asset
{
    public function disk($disk)
    {
        $this->setAttribute('disk', $disk);

        return $this;
    }

    public function storeAs(Closure $closure)
    {
        $this->setAttribute('storeAs', $closure);

        return $this;
    }

    public function getStyle()
    {
        return   [
            //
        ];
    }

    public function getScript()
    {
        return   [
            //
        ];
    }
}

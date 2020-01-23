<?php

namespace Quill\Html\Fields;

use Closure;
use Quill\Html\Fields\BaseField;

class ImageField extends BaseField
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
}

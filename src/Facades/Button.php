<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Facade;


class Button extends Facade
{
    protected static function getFacadeAccessor() { return 'button'; }
}

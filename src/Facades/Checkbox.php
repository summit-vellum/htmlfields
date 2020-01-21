<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Facade;


class Checkbox extends Facade
{
    protected static function getFacadeAccessor() { return 'checkbox'; }
}

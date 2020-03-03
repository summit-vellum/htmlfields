<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Facade;


class Toggle extends Facade
{
    protected static function getFacadeAccessor() { return 'toggle'; }
}

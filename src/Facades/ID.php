<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Facade;


class ID extends Facade
{
    protected static function getFacadeAccessor() { return 'id'; }
}

<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Facade;


class Datetime extends Facade
{
    protected static function getFacadeAccessor() { return 'datetime'; }
}
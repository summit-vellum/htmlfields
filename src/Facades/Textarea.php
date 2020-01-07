<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Facade;


class Textarea extends Facade
{
    protected static function getFacadeAccessor() { return 'textarea'; }
}
<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Facade;


class Image extends Facade
{
    protected static function getFacadeAccessor() { return 'image'; }
}
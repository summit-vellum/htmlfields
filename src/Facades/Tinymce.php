<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Facade;


class Tinymce extends Facade
{
    protected static function getFacadeAccessor() { return 'tinymce'; }
}
<?php

namespace Quill\Html;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class FieldsServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'field');
        $this->mergeConfigFrom(__DIR__ . '/config/html.php', 'html');

        $this->registerFields();
    }

    public function register()
    {
        $file = __DIR__ . '/Helpers/Helpers.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }

    /**
     * Bind all fields registered in the config/html.php file
     * 
     * @return void
     */
    public function registerFields()
    {
        $fields = config('html.fields');

        foreach ($fields as $field) {
            $bindName = last(explode('\\',$field));
            $bindName = str_replace('Field','', $bindName);
            $this->app->bind(strtolower($bindName), function() use($field){
                return new $field;
            });
        }
    }
}
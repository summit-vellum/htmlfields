<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Cache;
use Quill\Html\Fields\BaseField;
use Vellum\Contracts\Form\Renderable;
use Quill\Html\Contracts\Asset;

class SelectField extends BaseField implements Asset
{

    public function options($options)
    {
        $values = $options;

        if(!is_array($options) && class_exists($options)) {
        	$key = 'select_'.$this->getAttribute('id');
            $values = Cache::remember($key, 60, function() use($options){
            	return (new $options)->all()->pluck('name', 'id')->toArray();
            });
        }

        $this->setAttribute('options', $values);

        return $this;
    }

    public function getStyle()
    {
       return   [
        ];
    }

    public function getScript()
    {
        return   [
        	'vendor/vellum/js/vendor/bootstrap-select.min.js'
       ];
    }

}

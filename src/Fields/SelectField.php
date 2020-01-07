<?php

namespace Quill\Html\Fields;

use Illuminate\Support\Facades\Cache;
use Quill\Html\Fields\BaseField;
use Vellum\Contracts\Form\Renderable;


class SelectField extends BaseField
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

}

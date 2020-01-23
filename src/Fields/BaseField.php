<?php

namespace Quill\Html\Fields;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;
use Quill\Html\Contracts\Field;

class BaseField implements Field
{
    protected $attributes = [];
    protected $htmlAttributes = [];
    protected $sortableFields = [];
    public static $searchable = [];

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($property)
    {
        return $this->attributes[$property] ?? null;
    }

    public function setAttribute($property, $value)
    {
        return $this->attributes[$property] = $value;
    }

    public function getElementByNameByClass()
    {
        $class = strtolower(get_called_class());
        $element = last(explode('\\', $class));

        $this->setAttribute('element', str_replace('field','', $element));
    }

    public function tagsInput($options=[])
    {
    	//$apiUrl, $fields, $fieldName, $isMultiple=false
    	$this->setAttribute('tagsinput', 'data-tagsinput');
    	$this->setAttribute('tagsinput-config', json_encode($options));

    	return $this;
    }

    public function make($name, $slug = false)
    {
        $this->attributes = [];

        $id = $slug ? $slug : Str::snake($name);
        $this->setAttribute('id', $id);
        $this->setAttribute('name', $name);

        $this->getElementByNameByClass();

        /**
         * clearResolvedInstance will make sure that the last value
         * of the attributes will not be kept in all of the fields.`
         */
        Facade::clearResolvedInstance($this->getAttribute('element'));

        return $this;
    }

    public function rules()
    {
        $args = func_get_args() ?? false;

        $this->setAttribute('rules', implode('|', $args));
        $this->setAttribute('required', (bool)in_array('required', $args));

        return $this;
    }

    public function createRules()
    {
        $args = func_get_args() ?? false;

        $this->setAttribute('createRules', implode('|', $args));
        $this->setAttribute('required', (bool)in_array('required', $args));

        return $this;
    }

    public function updateRules()
    {
        $args = func_get_args() ?? false;

        $this->setAttribute('updateRules', implode('|', $args));
        $this->setAttribute('required', (bool)in_array('required', $args));

        return $this;
    }

    public function rulesMessages($message = false)
    {
        $this->setAttribute('messages', $message);

        return $this;
    }

    public function help($help = false)
    {
        $this->setAttribute('help', $help);

        return $this;
    }

    public function hideFromIndex()
    {
        $this->setAttribute('hideFromIndex', true);

        return $this;
    }

    public function hideFromDetail()
    {
        $this->setAttribute('hideFromDetail', true);

        return $this;
    }

    public function sortable()
    {
        $this->setAttribute('sortable', true);

        return $this;
    }

    public function searchable()
    {
        $this->setAttribute('searchable', true);

        return $this;
    }

    public function relation($relation)
    {
        $this->setAttribute('relation', $relation);

        return $this;
    }

    public function modify(Closure $closure)
    {
        $this->setAttribute('modify', $closure);

        return $this;
    }

    public function hideWhenCreating()
    {
        $this->setAttribute('hideWhenCreating', true);

        return $this;
    }

    public function hideWhenUpdating()
    {
        $this->setAttribute('hideWhenUpdating', true);

        return $this;
    }

    public function onlyOnDetail()
    {
        $this->setAttribute('hideToCatalog', true);

        return $this;
    }

    public function onlyOnForms()
    {
        $this->setAttribute('onlyOnForms', true);

        return $this;
    }

    public function exceptOnForms()
    {
        $this->setAttribute('exceptOnForms', true);

        return $this;
    }

    public function hideOnForms()
    {
        $this->setAttribute('hideOnForms', true);

        return $this;
    }

    public function getAllSortableFields()
    {
        return $this->sortableFields;
    }

    public function setHtmlAttributes($property, $value)
    {
        $this->htmlAttributes[$property] = $value;
    }

    public function render()
    {
        // $class = strtolower(get_called_class());
        // $element = last(explode('\\', $class));

        // return str_replace('field','', $element);

        $element = $this->getElementByNameByClass('element');

        return view(
            'field::' . $element,
            [
                'attributes' => $this->attributes,
                'value' => ''//($data[$field] ?? '')
            ]
        );
    }

    public function handle($request, Closure $next)
    {
        $attributes = $next($request);

        $property = $this->getAttribute('id');

        foreach ($this->getAttributes() as $key => $value) {
            if ($attr = $this->getAttribute($key) !== null) {
                $attributes['collections'][$property][$key] = $value;

                if (gettype($value) === 'boolean') {
                    $attributes[$key][] = $property;
                } else {
                    $attributes[$key][$property] = $value;
                }
            }
        }

        return $attributes;
    }
}

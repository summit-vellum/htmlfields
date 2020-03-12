<?php

namespace Quill\Html\Fields;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
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

        $this->setAttribute('element', str_replace('field', '', $element));
    }

    public function dashboardContainerClass($classes)
    {
    	/**
    	 * Sets class of field's container in dashboard - targeted on <td></td>
    	 */
    	$this->setAttribute('dashboardContainerClass', $classes);

    	return $this;
    }

    public function tinymceRows($rows)
    {
    	$this->setAttribute('tinymceRows', $rows);

    	return $this;
    }

    public function displayAsEdit()
    {
    	/**
    	 * makes a field an entry point for edit in dashboard
    	 */
    	$this->setAttribute('displayAsEdit', true);

    	return $this;
    }

    public function displayDashboardNotif()
    {
    	$this->setAttribute('displayDashboardNotif', true);

        return $this;
    }

    public function setJs($jrArray =[])
    {
    	$this->setAttribute('js', $jrArray);

    	return $this;
    }

    /**
     * Table header width
     *
     * @param      <type>  $width  The width
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function thWidthAttribute($width)
    {
    	$this->setAttribute('thWidth', $width);

    	return $this;
    }

    public function classes($classes)
    {
    	$this->setAttribute('classes', $classes);

    	return $this;
    }

    public function setStaticValue($value)
    {
    	$this->setAttribute('staticValue', $value);

    	return $this;
    }

    public function setLabelElement($element)
    {
    	/**
    	 * $element = label, h2 so on
    	 */
    	$this->setAttribute('labelElement', $element);

    	return $this;
    }

    public function container($container = [])
    {
    	/*
    	container array e.g
    	[
    		'sectionName'=>'two',
    		'view'=> view('vellum::containers.render-select', ['yieldName'=>'two'])
    	]
    	*/
    	$this->setAttribute('container', $container);

    	return $this;
    }

    public function tagsInput($options=[])
    {
    	/*
    	options array
   		[
   		 'apiUrl' => '',
		 'fields' => '',
		 'fieldName' => '',
		 'name' => ''
		]
		*/
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
        $attributes = config('form.attributes');

        $this->setAttribute('rules', implode('|', $args));

        foreach ($attributes as $attr) {
            if (in_array($attr, $args)) {
                $this->setAttribute($attr, (bool) in_array($attr, $args));
            }
        }

        return $this;
    }

    public function createRules()
    {
        $args = func_get_args() ?? false;

        $this->setAttribute('createRules', implode('|', $args));
        $this->setAttribute('required', (bool) in_array('required', $args));

        return $this;
    }

    public function updateRules()
    {
        $args = func_get_args() ?? false;

        $this->setAttribute('updateRules', implode('|', $args));
        $this->setAttribute('required', (bool) in_array('required', $args));

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
    	/**
    		If this does not hide the whole container try checking the view file
    		'hidden' => isset($attributes['hideOnForms']) ? 'hide' : '' should be appended to @input()
    	**/
        $this->setAttribute('hideOnForms', true);

        return $this;
    }

    public function characterCount($min= false, $max = false, $help = false)
    {
        $this->setAttribute('min-count', $min);
        $this->setAttribute('max-count', $max);
        $this->setAttribute('max-count-help', $help);

        return $this;
    }

    public function autoSlug()
    {
        $this->setAttribute('autoslug-src', $this->attributes['id']);

        return $this;
    }

    public function autoSlugSource($id = false, $trigger = 'on')
    {
        $this->setAttribute('autoslug', $id);
        $this->setAttribute('autoslug-once', $trigger);

        return $this;
    }

    public function placeholder($text = false)
    {
        $this->setAttribute('placeholder', $text);

        return $this;
    }

    public function uniqueChecker($text = false)
    {
        $this->setAttribute('unique-message', $text);

        return $this;
    }

    public function label($label)
    {
    	$this->setAttribute('label', $label);

    	return $this;
    }

    public function customLabelClasses($classes = false)
    {
        $this->setAttribute('label-classes', $classes);

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

    /**
     * Usage: shortcode modal
     * Add this to the field you want be shown in selected list when a row is clicked in a modal
     */
    public function fieldSelected()
    {
    	$this->setAttribute('fieldSelected', true);

    	return $this;
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
                'value' => '' //($data[$field] ?? '')
            ]
        );
    }

    public function handle($request, Closure $next)
    {
        $attributes = $next($request);

        $property = $this->getAttribute('id');

        $js = ($this->getAttribute('js'))?:[];

        foreach ($this->getAttributes() as $key => $value) {
            if($attr = $this->getAttribute($key) !== null) {
                $attributes['assets']['style'][$property] = $this->getStyle();
                $attributes['assets']['script'][$property] = array_merge($this->getScript(), $js);
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

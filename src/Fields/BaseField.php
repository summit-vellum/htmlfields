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

    public function inputClass($classes)
    {
    	/** sets classes for div container of input.blade.php * */
    	$this->setAttribute('inputClass', $classes);

    	return $this;
    }

    public function dashboardContainerClass($classes)
    {
    	/**
    	 * Sets class of field's container in dashboard - targeted on <td></td>
    	 */
    	$this->setAttribute('dashboardContainerClass', $classes);

    	return $this;
    }

    public function tinyMceAttributes($attr = [])
    {
    	$this->setAttribute('tinyMceAttr', $attr);

    	return $this;
    }

    public function tinymceRows($rows)
    {
    	/** sets number of rows in tinymce; changes height */
    	$this->setAttribute('tinymceRows', $rows);

    	return $this;
    }

    public function setInputType($type)
    {
    	$this->setAttribute('inputType', $type);

    	return $this;
    }

    public function disabled()
    {
    	$this->setAttribute('disabled', true);

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
    	/**
    	 * set to fields where you'd like to show autosave and resource lock dashboard notification
    	 * e.g You are currently editing this post
    	 */
    	$this->setAttribute('displayDashboardNotif', true);

        return $this;
    }

    public function setDataAttributes($data = [])
    {
    	$this->setAttribute('dataAttributes', arrayToHtmlAttributes($data));

    	return $this;
    }

    public function setStyle($cssArray =[])
    {
    	/**
    	 * renders css per html field
    	 */
    	$this->setAttribute('css', $cssArray);

    	return $this;
    }

    public function setJs($jsArray =[])
    {
    	/**
    	 * renders js per html field
    	 * can be validation or set of functions
    	 */
    	$this->setAttribute('js', $jsArray);

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

    public function anArrayField($boolean = true)
    {
    	$this->setAttribute('anArrayField', $boolean);

    	return $this;
    }

    public function classes($classes)
    {
    	/**
    	 * sets classes to an html field declared under {Module}Resource.php
    	 */
    	$this->setAttribute('classes', $classes);

    	return $this;
    }

    public function setStaticValue($value)
    {
    	/**
    	 * use this when you want to declare a static value in an html field.
    	 * currenlty used in label.blade.php
    	 */
    	$this->setAttribute('staticValue', $value);

    	return $this;
    }

    public function setLabelElement($element)
    {
    	/**
    	 * $element = label, h2 so on.
    	 * currenlty used in label.blade.php
    	 */
    	$this->setAttribute('labelElement', $element);

    	return $this;
    }

    public function template($template)
    {
    	/**
    	 * sets html template for your fields.
    	 * templates are saved under /templates folder
    	 * must use yieldAt(), yieldLabelSectionAt(), or yieldInfoTextSectionAt() attribute
    	 * in your field to be pulled in the template
    	 *
    	 * check Post/views/templates/form.blade.php for reference
    	 */
    	$this->setAttribute('template', $template);

    	return $this;
    }

    public function yieldLabelSectionAt($section)
    {
    	/* Yields input.blade.php's label to a desired page location */

    	$this->setAttribute('labelSection', $section);

    	return $this;
    }
    public function yieldInfoTextSectionAt($section)
    {
    	/* Yields input.blade.php's info text to a desired page location */
    	$this->setAttribute('infotextSection', $section);

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

    public function yieldAt($yieldName)
    {
    	/* Yields html field to a desired page location */
    	$this->setAttribute('yieldAt', $yieldName);

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

    public function dateConfig($config)
    {
    	/**
    	 * Data config for datatime.blade.php
    	 * e.g ->dateConfig(['single' => true, 'dateFormat' => 'ddd, MMM DD, YYYY, hh:mm A'])
    	 */
    	$this->setAttribute('data-config', json_encode($config));

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

    public function labelClasses($classes)
    {
    	/**
    	 * sets class to input.blade.php's label
    	 */
    	$this->setAttribute('labelClasses', $classes);

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

    public function uniqueChecker($text = [])
    {
    	/**
    	 * Sample usage
    	 *  [
            	'unique' => 'Nice! You have a unique title!',
            	'hasDuplicate' => 'Sorry, That title is already taken. Please provide another one.'
            ]
    	 */
        $this->setAttribute('unique-message', json_encode($text));

        return $this;
    }

    public function label($label)
    {
    	$this->setAttribute('label', $label);

    	return $this;
    }

    public function customLabel($label)
    {
    	/**
    	 * custom label used in input.blade.php
    	 */
    	$this->setAttribute('customLabel', $label);

    	return $this;
    }
    public function customLabelClasses($classes = false)
    {
    	/**
    	 * sets custom label's class in input.blade.php
    	 */
    	//previously label-classes
        $this->setAttribute('customLabelClasses', $classes);

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
        $css = ($this->getAttribute('css'))?:[];

        foreach ($this->getAttributes() as $key => $value) {
            if($attr = $this->getAttribute($key) !== null) {
                $attributes['assets']['style'][$property] = array_merge($this->getStyle(), $css);
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

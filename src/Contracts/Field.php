<?php

namespace Quill\Html\Contracts;


interface Field
{
    /**
     * Quill will "snake case" the displayable name of the field to determine 
     * the underlying database column. However, if necessary, you may pass the 
     * column name as the second argument to the field's `make` method.
     * 
     * @param  string  $name Fields label name
     * @param  boolean $slug Optional field snake_case name
     * @return static        
     */
    public function make($name, $slug = false);

}
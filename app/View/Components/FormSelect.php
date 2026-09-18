<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSelect extends Component
{
    public $name;
    public $label;
    public $required;
    public $placeholder;
    public $id;
    public $autofocus;
    public $horizontal;
    public $options;
    public $useLabel;
    public $class;
    public $bintang;
    public $box;
    public $multiple;
    public $value;

    public function __construct(
        $name, 
        $label = null, 
        $required = false, 
        $placeholder = '', 
        $id = null, 
        $autofocus = false, 
        $horizontal = true, 
        $useLabel = true, 
        $options = [], 
        $class = 'form-control select2', 
        $bintang = false, 
        $box = false, 
        $multiple = false, 
        $value = null
    )
    {
        $this->name        = $name;
        $this->label       = $label;
        $this->required    = $required;
        $this->placeholder = $placeholder;
        $this->id          = $id ?? $name;
        $this->autofocus   = $autofocus;
        $this->horizontal  = $horizontal;
        $this->options     = $options;
        $this->useLabel    = $useLabel;
        $this->class       = $class;
        $this->bintang     = $bintang;
        $this->box         = $box;
        $this->multiple    = $multiple;
        $this->value       = $value;
    }

    public function render()
    {
        return view('components.form-select');
    }
}

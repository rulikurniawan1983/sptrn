<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $name;
    public $label;
    public $required;
    public $placeholder;
    public $id;
    public $autofocus;
    public $horizontal;
    public $type;
    public $useLabel;
    public $class;
    public $accept;
    public $value;
    public $tabindex;
    public $bintang;
    public $rows;
    public $box;
    public $afterLabel;
    public $readonly;
    public $disabled;

    public function __construct(
        $name, 
        $label = null, 
        $type = 'text', 
        $required = false, 
        $placeholder = '', 
        $id = null, 
        $autofocus = false, 
        $horizontal = true, 
        $useLabel = true, 
        $class = 'form-control', 
        $accept = null, 
        $value = null, 
        $tabindex = null, 
        $bintang = false, 
        $rows = null, 
        $box = false, 
        $afterLabel = '', 
        $readonly = false, 
        $disabled = false
    )
    {
        $this->name        = $name;
        $this->label       = $label;
        $this->type        = $type;
        $this->required    = $required;
        $this->placeholder = $placeholder;
        $this->id          = $id ?? $name;
        $this->autofocus   = $autofocus;
        $this->horizontal  = $horizontal;
        $this->useLabel    = $useLabel;
        $this->class       = $class;
        $this->accept      = $accept;
        $this->value       = $value;
        $this->tabindex    = $tabindex;
        $this->bintang     = $bintang;
        $this->rows        = $rows;
        $this->box         = $box;
        $this->afterLabel  = $afterLabel;
        $this->readonly    = $readonly;
        $this->disabled    = $disabled;
    }

    public function render()
    {
        return view('components.form-input');
    }
}

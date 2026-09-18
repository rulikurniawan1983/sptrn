<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInputCheckbox extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $value;
    public $checked;

    public function __construct($name, $value, $checked = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input-checkbox');
    }
}

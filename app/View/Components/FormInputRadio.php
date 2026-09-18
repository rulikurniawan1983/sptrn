<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInputRadio extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $value;
    public $isChecked;

    public function __construct($name, $value, $isChecked = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->isChecked = $isChecked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input-radio');
    }
}

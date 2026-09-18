<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DetailItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $value;
    public $isList;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $value = null, $isList = false)
    {
        $this->label  = $label;
        $this->value  = $value;
        $this->isList = $isList;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.detail-item');
    }
}

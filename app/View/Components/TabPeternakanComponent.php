<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TabPeternakanComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $item;
    public $activeTab;
    public $isLock;
    public $route = "peternakan";

    public function __construct($item = null, $activeTab = null, $isLock = true)
    {
        $this->item      = $item;
        $this->activeTab = $activeTab;
        $this->isLock    = $isLock;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tab-peternakan-component');
    }
}

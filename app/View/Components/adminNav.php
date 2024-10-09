<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class adminNav extends Component
{
    /**
     * Create a new component instance.
     */

    public $items;

    public function __construct()
    {
        $this->items = config('adminnav');

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.admin-nav');
    }
}

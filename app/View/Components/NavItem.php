<?php

namespace App\View\Components;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class NavItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $href;
    public $activeRoutes;
    public $svg;
    public $title;
    public $svgSecondary;

    public function __construct($href, $activeRoutes, $svg, $title, $svgSecondary = null)
    {
        $this->href = $href;
        $this->activeRoutes = $activeRoutes;
        $this->svg = $svg;
        $this->title = $title;
        $this->svgSecondary = $svgSecondary;

    }


    public function isActive()
    {
        return in_array(Route::currentRouteName(), explode(',', $this->activeRoutes));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-item');
    }
}

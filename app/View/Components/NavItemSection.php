<?php

namespace App\View\Components;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class NavItemSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $href;

    public $svg;
    public $title;
    public function __construct($href, $svg, $title)
    {
        $this->href = $href;
        $this->svg = $svg;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-item-section');
    }
}

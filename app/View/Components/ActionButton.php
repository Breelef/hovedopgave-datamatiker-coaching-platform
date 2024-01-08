<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ActionButton extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $type;
    public $value;
    public $click;
    public function __construct($title, $type, $value = null, $click = null)
    {
        $this->title = $title;
        $this->type = $type;
        $this->value = $value;
        $this->click = $click;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}

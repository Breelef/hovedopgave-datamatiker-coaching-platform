<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AllTrainingSessions extends Component
{
    /**
     * Create a new component instance.
     */
    public $sessionGroup;
    public $size;
    public function __construct($sessionGroup, $size = null)
    {
        $this->sessionGroup = $sessionGroup;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.all-training-sessions');
    }
}

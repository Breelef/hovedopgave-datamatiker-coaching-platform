<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ShowExercises extends Component
{
    /**
     * Create a new component instance.
     */
    public $exercises;
    public function __construct($exercises)
    {
        $this->exercises = $exercises;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show-exercises');
    }
}

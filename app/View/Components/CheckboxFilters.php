<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CheckboxFilters extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $name;
    public $value;
    public $ifCondition;
    public $title;
    public function __construct($id, $name, $value, $title, $ifCondition = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->ifCondition = $ifCondition;
        $this->title = $title;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.checkbox-filters');
    }
}

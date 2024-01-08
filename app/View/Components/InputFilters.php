<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class InputFilters extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $type;
    public $value;
    public $placeholder;
    public $name;
    public $id;
    public $min;
    public $max;
    public function __construct($title, $type, $placeholder, $name, $id, $value = null, $min = null, $max = null)
    {
        $this->title = $title;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-filters');
    }
}

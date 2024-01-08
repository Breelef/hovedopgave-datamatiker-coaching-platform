<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DropdownSelectFilters extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $name;
    public $options;
    public $selectedOption;
    public $defaultText;
    public function __construct($title, $name, $options = [], $selectedOption = null, $defaultText = null)
    {
        $this->title = $title;
        $this->name = $name;
        $this->options = $options;
        $this->selectedOption = $selectedOption;
        $this->defaultText = $defaultText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown-select-filters');
    }
}

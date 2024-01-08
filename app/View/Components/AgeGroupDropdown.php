<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AgeGroupDropdown extends Component
{
    /**
     * Create a new component instance.
     */

    public $selectedAgeGroupId;
    public $ageGroups;
    public function __construct($ageGroups, $selectedAgeGroupId = null)
    {
        $this->ageGroups = $ageGroups;
        $this->selectedAgeGroupId = $selectedAgeGroupId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.age-group-dropdown');
    }
}

<?php

namespace App\Livewire;

use App\Models\AgeGroup;
use App\Models\Club;
use Livewire\Component;

class GetClubs extends Component
{
    public function render()
    {
        $clubs = Club::isActive()->orderBy('name')->get();
        $ageGroups = AgeGroup::All();

        return view('livewire.get-clubs', ['clubs' => $clubs, 'ageGroups' => $ageGroups]);
    }
}

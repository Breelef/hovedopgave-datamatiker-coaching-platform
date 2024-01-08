<?php

namespace App\Livewire;

use App\Models\AgeGroup;
use App\Models\TrainingPlan;
use Livewire\Component;

class ShowTrainingPlans extends Component
{
    public $user;

    public $trainingPlans;

    public $ageGroup;

    public $ageGroups;

    public $selectedAgeGroupId;

    public function render()
    {

        return view('livewire.show-training-plans', ['trainingPlans' => $this->trainingPlans, 'ageGroups'=>$this->ageGroups]);
    }

    public function mount()
    {

        $this->user = auth()->user();
        $this->getAgeGroups();
        $this->selectedAgeGroupId = $this->user->ageGroup ? $this->user->ageGroup->id : null;
        if ($this->selectedAgeGroupId) {
            $this->trainingPlans = TrainingPlan::where('age_group_id', $this->selectedAgeGroupId)->get();
        }
    }
    public function handleAgeGroupChange() {
        $this->ageGroup = $this->selectedAgeGroupId;
        if (!$this->ageGroup && $this->user->ageGroup) {
            $this->ageGroup = $this->user->ageGroup->id;
        }
        if ($this->ageGroup) {
            $this->trainingPlans = TrainingPlan::where('age_group_id', $this->ageGroup)->get();
        }

    }

    public function getAgeGroups(){
        $this->ageGroups = AgeGroup::all();
    }


}

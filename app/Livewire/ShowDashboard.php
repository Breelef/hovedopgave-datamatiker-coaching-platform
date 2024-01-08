<?php

namespace App\Livewire;

use App\Models\AgeGroup;
use App\Models\TrainingPlan;
use Livewire\Component;

class ShowDashboard extends Component
{
    public $user;

    public $currentSessionGroup = 0;

    public $sessionGroup;

    public $ageGroup;

    public $ageGroups;

    public $minIndex = 0;

    public $maxIndex;

    public $trainingPlan;
    public $selectedAgeGroupId;

    public function render()
    {
        return view('livewire.show-dashboard', [
            'sessionGroup' => $this->sessionGroup,
            'ageGroup' => $this->ageGroup,
            'indexes' => ['minIndex' => $this->minIndex, 'maxIndex' => $this->maxIndex, 'currentIndex' => $this->currentSessionGroup],
            'ageGroups'=>$this->ageGroups,
        ]);
    }

    public function mount()
    {
        $this->getAgeGroups();
        $this->user = auth()->user();
        $this->selectedAgeGroupId = $this->user->ageGroup ? $this->user->ageGroup->id : null;
        $this->sessionGroup = $this->getThisSession();
    }

    public function getThisSession()
    {
        $this->user = auth()->user();
        $this->ageGroup = $this->selectedAgeGroupId;

        if (!$this->ageGroup && $this->user->ageGroup) {
            $this->ageGroup = $this->user->ageGroup->id;
        }

        if ($this->ageGroup) {
            $this->trainingPlan = TrainingPlan::where('age_group_id', $this->ageGroup)->first();
            $this->ageGroup = AgeGroup::find($this->ageGroup);
            $thisSessionGroup = null;
            if ($this->trainingPlan) {
                $sessionGroups = $this->trainingPlan->sessionGroups()->validEndDate()->orderBy('ends_at', 'asc')->get();
                $sessionGroup = $sessionGroups[$this->currentSessionGroup];
                if ($sessionGroup && !$thisSessionGroup) {
                    $thisSessionGroup = $sessionGroup;
                    $this->getMaxIndex();
                }

            }
            return $thisSessionGroup;
        } else {
            return false;
        }
    }

    public function getMaxIndex()
    {
        $this->maxIndex = $this->trainingPlan->sessionGroups->count();
        $this->maxIndex--;
    }

    public function getNextSession()
    {
        $this->currentSessionGroup++;
        $this->sessionGroup = $this->getThisSession();
    }

    public function getPreviousSession()
    {
        $this->currentSessionGroup--;
        $this->sessionGroup = $this->getThisSession();
    }
    public function getAgeGroups(){
        $this->ageGroups = AgeGroup::all();
    }

    public function handleAgeGroupChange() {
        $this->sessionGroup = $this->getThisSession();
    }
}

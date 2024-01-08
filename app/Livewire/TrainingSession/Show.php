<?php

namespace App\Livewire\TrainingSession;

use App\Models\Equipment;
use App\Models\TrainingSession;
use Livewire\Component;

class Show extends Component
{
    public TrainingSession $trainingSession;

    public $trainerCount = 3;

    public $playerCount = 24;

    public $sessionDuration = 90;

    public $equipmentList = [];

    public $trainingType = '';

    public $groups = [];

    public $groupedExercises = [];

    public $playerRecommendation = '';

    public function render()
    {
        return view('livewire.training-session.show');
    }

    public function mount()
    {
        $this->trainingType = 'stationstræning';
        $this->calculateSession();
    }

    public function calculateSession()
    {
        $this->playerRecommendation = '';
        $this->calculateGroups();
        if ($this->trainingType === 'stationstræning') {
            $this->makeStationsTraining();
        }
        $this->getEquipmentForExercises();
        foreach ($this->groups as $group) {
            if ($group['players'] > 8) {
                $this->playerRecommendation = 'Vi anbefaler generelt en trænernormering på 8 spillere pr. træner.';
            }
        }
    }

    public function calculateGroups()
    {
        $this->groups = [];

        $basePlayersPerGroup = intdiv($this->playerCount, $this->trainerCount);

        $remainderPlayers = $this->playerCount % $this->trainerCount;

        for ($i = 0; $i < $this->trainerCount; $i++) {
            $playersInCurrentGroup = $basePlayersPerGroup;

            if ($remainderPlayers > 0) {
                $playersInCurrentGroup++;
                $remainderPlayers--;
            }
            $this->groups[] = [
                'name' => 'Gruppe '.($i + 1),
                'players' => $playersInCurrentGroup,
            ];
        }
    }

    public function makeStationsTraining()
    {
        $exerciseCount = $this->trainingSession->exercises->count();
        $groupedExercises = [];

        foreach ($this->groups as $index => $group) {
            $startPoint = $index % $exerciseCount;
            $groupedExercises[$group['name']] = [];

            for ($i = 0; $i < $exerciseCount; $i++) {
                $exerciseIndex = ($startPoint + $i) % $exerciseCount;
                $groupedExercises[$group['name']][] = $this->trainingSession->exercises[$exerciseIndex];
            }
        }
        $this->groupedExercises = $groupedExercises;
    }

    public function getEquipmentForExercises()
    {
        $this->equipmentList = [];
        $exercises = $this->trainingSession->exercises;

        if ($this->trainingType === 'forløbstræning') {
            foreach ($exercises as $exercise) {
                foreach ($exercise->equipment as $equipment) {
                    $totalQuantity = $equipment->pivot->quantity * count($this->groups);
                    if (isset($this->equipmentList[$equipment->id])) {
                        $this->equipmentList[$equipment->id]['quantity'] = max($this->equipmentList[$equipment->id]['quantity'], $totalQuantity);
                    } else {
                        $this->equipmentList[$equipment->id] = [
                            'name' => $equipment->name,
                            'quantity' => $totalQuantity,
                            'image' => $equipment->image,
                        ];
                    }
                }
            }
        } elseif ($this->trainingType === 'stationstræning') {
            $maxEquipmentAcrossAllRounds = [];
            $exerciseCount = count($exercises);
            for ($i = 0; $i < $exerciseCount; $i++) {
                $currentRoundEquipment = [];
                foreach ($this->groups as $group) {
                    $exercise = $this->groupedExercises[$group['name']][$i];
                    foreach ($exercise->equipment as $equipment) {
                        if (! isset($currentRoundEquipment[$equipment->id])) {
                            $currentRoundEquipment[$equipment->id] = 0;
                        }
                        $currentRoundEquipment[$equipment->id] += $equipment->pivot->quantity;
                    }
                }
                foreach ($currentRoundEquipment as $equipmentId => $quantity) {
                    if (! isset($maxEquipmentAcrossAllRounds[$equipmentId])) {
                        $maxEquipmentAcrossAllRounds[$equipmentId] = 0;
                    }
                    $maxEquipmentAcrossAllRounds[$equipmentId] = max($maxEquipmentAcrossAllRounds[$equipmentId], $quantity);
                }
            }
            foreach ($maxEquipmentAcrossAllRounds as $equipmentId => $quantity) {
                if (isset($this->equipmentList[$equipmentId])) {
                    $this->equipmentList[$equipmentId]['quantity'] = max($this->equipmentList[$equipmentId]['quantity'], $quantity);
                } else {
                    $equipmentDetails = Equipment::find($equipmentId);
                    $this->equipmentList[$equipmentId] = [
                        'name' => $equipmentDetails->name,
                        'quantity' => $quantity,
                        'image' => $equipmentDetails->image,
                    ];
                }
            }
        }
    }
}

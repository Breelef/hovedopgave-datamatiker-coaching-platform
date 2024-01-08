<?php

namespace App\Livewire;

use App\Models\Exercise;
use Livewire\Component;

class UserExerciseBookmark extends Component
{
    public Exercise $exercise;

    public $isBookmarked = false;

    public function render()
    {
        return view('livewire.user-exercise-bookmark');
    }

    public function mount()
    {
        if ($this->exercise->isBookmarkedBy(auth()->user())) {
            $this->isBookmarked = true;
        }
    }

    public function removeBookmark()
    {
        auth()->user()->unBookmark($this->exercise);
        $this->isBookmarked = false;
    }

    public function addBookmark()
    {
        auth()->user()->bookmark($this->exercise);
        $this->isBookmarked = true;
    }
}

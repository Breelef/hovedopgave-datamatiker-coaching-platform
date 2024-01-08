<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class Show extends Component
{
    public $chosenCategory = null;

    public $parentCategories;

    public $exercises = [];

    public $openMenus = [];

    public function render()
    {
        return view('livewire.category.show');
    }

    public function mount()
    {
        $this->parentCategories =  Category::whereNull('category_id')->with('categories')->get();;
    }

    public function selectCategory($categoryId)
    {
        if ($this->chosenCategory === $categoryId) {
            $this->chosenCategory = null;
            $this->exercises = [];
            $this->openMenus = array_diff($this->openMenus, [$categoryId]);
        } else {
            $this->chosenCategory = $categoryId;
            $this->exercises = [];
            $this->loadExercisesForCategory($categoryId);
            if (! in_array($categoryId, $this->openMenus)) {
                $this->openMenus[] = $categoryId;
            }
        }
    }

    public function loadExercisesForCategory($categoryId)
    {
        $category = Category::with('exercises')->find($categoryId);
        $fetchedExercises = collect($category->allExercises);
        $this->exercises = collect($this->exercises)->merge($fetchedExercises)->unique('id');
    }

    public function toggleMenu($categoryId)
    {
        if (in_array($categoryId, $this->openMenus)) {
            $this->openMenus = array_diff($this->openMenus, [$categoryId]);
        } else {
            $this->openMenus[] = $categoryId;
        }
    }

    public function getParentCategory($categoryId)
    {
        $category = Category::find($categoryId);

        return $category->category;
    }

    public function handleSVGClick($categoryId)
    {
        $this->toggleMenu($categoryId);
        $this->selectCategory($categoryId);
    }
}

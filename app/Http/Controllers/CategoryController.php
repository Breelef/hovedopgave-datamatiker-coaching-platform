<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Category;
use App\Models\Exercise;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $parentCategories = Category::whereNull('category_id')->with('categories')->get();

        return view('categories-index', compact('parentCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        $ageGroups = AgeGroup::orderBy('age', 'asc')->get();

        $query = Exercise::query();
        $query->whereHas('categories', function ($q) use ($category) {
            $q->whereIn('category_exercise.category_id', [$category->id]);
        });

        //        $exercises = $category->exercises;

        // Age group
        if (is_numeric(app('request')->input('age_groups'))) {
            $query->where('age_from', '<=', app('request')->input('age_groups'));
            $query->where('age_to', '>=', app('request')->input('age_groups'));
        }

        // Players
        if (is_numeric(app('request')->input('players'))) {
            $query->where('players_from', '<=', app('request')->input('players'));
            $query->where('players_to', '>=', app('request')->input('players'));
        }

        // Exercise type
        //$query->where('exercise_type', app('request')->input('exercise_type'));

        // Activity type
        if (is_array(app('request')->input('activity_type')) && count(app('request')->input('activity_type')) > 0) {
            $query->whereIn('activity_type', app('request')->input('activity_type'));
        }

        // Search
        if (! empty(app('request')->input('search'))) {
            $query->where('name', 'like', '%'.app('request')->input('search').'%');
        }
        $query->orderBy('name', 'asc');
        $exercises = $query->get();

        return view('categories-show', compact('exercises', 'category', 'ageGroups'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

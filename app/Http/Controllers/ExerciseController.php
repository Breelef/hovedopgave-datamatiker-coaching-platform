<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Exercise;
use Spatie\Tags\Tag;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ageGroups = AgeGroup::orderBy('age', 'asc')->get();
        $tags = Tag::where('type', 'mental')->get();

        $query = Exercise::query();

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
        $query->where('exercise_type', app('request')->input('exercise_type'));

        // Activity type
        if (is_array(app('request')->input('activity_type')) && count(app('request')->input('activity_type')) > 0) {
            $query->whereIn('activity_type', app('request')->input('activity_type'));
        }

        // Mental
        if (is_array(app('request')->input('mental')) && count(app('request')->input('mental')) > 0) {
            $query->whereHas('tags', function ($q) {
                $q->whereIn('tag_id', app('request')->input('mental'));
            });
        }

        // Search
        if (! empty(app('request')->input('search'))) {
            $query->where('name', 'like', '%'.app('request')->input('search').'%');
        }

        $query->orderBy('name', 'asc');
        $exercises = $query->get();

        return view('exercises-index', compact('exercises', 'ageGroups', 'tags'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        $url = $exercise->video_url;
        $videoId = '';

        if (strpos($url, 'youtube.com') !== false) {
            $parts = parse_url($url);
            parse_str($parts['query'], $query);
            $videoId = $query['v'];
        } elseif (strpos($url, 'youtu.be') !== false) {
            $parts = parse_url($url);
            $pathComponents = explode('/', $parts['path']);
            $videoId = end($pathComponents);
        }

        if ($videoId) {
            $exercise->video_url = $videoId;
        }

        return view('exercises-show', compact('exercise'));
    }

    /**
     * Display User bookmarks.
     */
    public function bookmarks(Exercise $exercise)
    {

        $exerciseIds = auth()->user()->bookmarks()->pluck('bookmarkable_id')->toArray();
        $exercises = Exercise::whereIn('id', $exerciseIds)->get();

        return view('exercises-bookmarks', compact('exercises'));
    }
}

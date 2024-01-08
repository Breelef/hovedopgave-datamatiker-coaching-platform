<?php

namespace App\Http\Controllers;

use App\Models\Club;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clubs = Club::isActive()->orderBy('name')->get();

        return view('clubs', compact('clubs'));
    }
}

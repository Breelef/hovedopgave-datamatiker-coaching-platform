<?php

namespace App\Http\Controllers;

use App\Models\Guide;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::orderBy('created_at', 'desc')->get();

        return view('guides-index', compact('guides'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Guide $guide)
    {
        $url = $guide->video_url;
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
            $guide->video_url = $videoId;
        }
        return view('guides-show', compact('guide'));
    }
}

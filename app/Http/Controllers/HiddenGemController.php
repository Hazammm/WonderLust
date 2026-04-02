<?php

namespace App\Http\Controllers;

use App\Models\Destination;

class HiddenGemController extends Controller
{
    public function index()
    {
        $hiddenGems = Destination::with('category')
            ->hiddenGems()
            ->latest()
            ->get();

        $featuredGem = $hiddenGems->first();

        return view('hidden-gems', compact('hiddenGems', 'featuredGem'));
    }
}

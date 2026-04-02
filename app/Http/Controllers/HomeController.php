<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDestinations = Destination::with('category')
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('destinations')->get();

        $sliderDestinations = Destination::with('category')
            ->featured()
            ->take(4)
            ->get();

        return view('home', compact('featuredDestinations', 'categories', 'sliderDestinations'));
    }
}

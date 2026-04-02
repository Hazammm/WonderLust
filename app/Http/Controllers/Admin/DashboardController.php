<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_destinations' => Destination::count(),
            'featured' => Destination::where('is_featured', true)->count(),
            'hidden_gems' => Destination::where('is_hidden_gem', true)->count(),
            'categories' => Category::count(),
        ];

        $recentDestinations = Destination::with('category')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentDestinations'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json(['results' => []]);
        }

        $destinations = Destination::with('category')
            ->search($query)
            ->take(8)
            ->get()
            ->map(function ($destination) {
                return [
                    'id' => $destination->id,
                    'name' => $destination->name,
                    'location' => $destination->location,
                    'slug' => $destination->slug,
                    'category' => $destination->category->name,
                    'hero_image' => $destination->hero_image_url,
                    'url' => route('destinations.show', $destination->slug),
                ];
            });

        return response()->json(['results' => $destinations]);
    }
}

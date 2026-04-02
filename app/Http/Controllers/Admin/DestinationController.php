<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Destination;
use App\Models\Category;
use App\Mail\FeaturedDestinationNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('category')->latest()->paginate(15);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.destinations.create', compact('categories'));
    }

    public function store(StoreDestinationRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $filename = time() . '_' . Str::slug($data['name']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/destinations'), $filename);
            $data['hero_image'] = 'images/destinations/' . $filename;
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $gallery = [];
            foreach ($request->file('gallery_images') as $image) {
                $filename = time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/destinations'), $filename);
                $gallery[] = 'images/destinations/' . $filename;
            }
            $data['gallery'] = $gallery;
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['is_hidden_gem'] = $request->has('is_hidden_gem');

        $destination = Destination::create($data);

        // Send email notification for featured destinations
        if ($destination->is_featured) {
            try {
                Mail::to('admin@wanderlust.com')->send(new FeaturedDestinationNotification($destination));
            } catch (\Exception $e) {
                // Silently fail — email is optional
            }
        }

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully!');
    }

    public function edit(Destination $destination)
    {
        $categories = Category::all();
        return view('admin.destinations.edit', compact('destination', 'categories'));
    }

    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            // Delete old image if exists
            if ($destination->hero_image && file_exists(public_path($destination->hero_image))) {
                @unlink(public_path($destination->hero_image));
            }
            $file = $request->file('hero_image');
            $filename = time() . '_' . Str::slug($data['name']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/destinations'), $filename);
            $data['hero_image'] = 'images/destinations/' . $filename;
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $gallery = $destination->gallery ?? [];
            foreach ($request->file('gallery_images') as $image) {
                $filename = time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/destinations'), $filename);
                $gallery[] = 'images/destinations/' . $filename;
            }
            $data['gallery'] = $gallery;
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['is_hidden_gem'] = $request->has('is_hidden_gem');

        $wasFeatured = $destination->is_featured;
        $destination->update($data);

        // Send email if newly featured
        if (!$wasFeatured && $destination->is_featured) {
            try {
                Mail::to('admin@wanderlust.com')->send(new FeaturedDestinationNotification($destination));
            } catch (\Exception $e) {
                // Silently fail
            }
        }

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully!');
    }

    public function destroy(Destination $destination)
    {
        // Delete hero image
        if ($destination->hero_image && file_exists(public_path($destination->hero_image))) {
            @unlink(public_path($destination->hero_image));
        }

        // Delete gallery images
        if ($destination->gallery) {
            foreach ($destination->gallery as $image) {
                if (file_exists(public_path($image))) {
                    @unlink(public_path($image));
                }
            }
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully!');
    }
}

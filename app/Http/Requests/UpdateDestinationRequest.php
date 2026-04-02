<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDestinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:200',
            'description' => 'required|string',
            'short_description' => 'required|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'best_time' => 'nullable|string|max:100',
            'budget' => 'nullable|string|max:50',
            'language' => 'nullable|string|max:100',
            'currency' => 'nullable|string|max:50',
            'travel_tips' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_hidden_gem' => 'boolean',
            'rating' => 'nullable|numeric|between:0,5',
            'meta_title' => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:500',
        ];
    }
}

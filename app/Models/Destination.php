<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'location',
        'description',
        'short_description',
        'latitude',
        'longitude',
        'hero_image',
        'gallery',
        'best_time',
        'budget',
        'language',
        'currency',
        'travel_tips',
        'is_featured',
        'is_hidden_gem',
        'rating',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_hidden_gem' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'rating' => 'decimal:1',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeHiddenGems(Builder $query): Builder
    {
        return $query->where('is_hidden_gem', true);
    }

    public function scopeByCategory(Builder $query, $categorySlug): Builder
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    public function scopeSearch(Builder $query, $term): Builder
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('location', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhere('short_description', 'like', "%{$term}%");
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getHeroImageUrlAttribute(): string
    {
        if ($this->hero_image && file_exists(public_path($this->hero_image))) {
            return asset($this->hero_image);
        }
        return asset('images/default-destination.jpg');
    }

    public function getGalleryUrlsAttribute(): array
    {
        if (!$this->gallery) return [];
        return array_map(fn($img) => asset($img), $this->gallery);
    }

    public function similarDestinations($limit = 4)
    {
        return static::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }
}

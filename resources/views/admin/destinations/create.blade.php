@extends('layouts.admin')

@section('header', 'Create Destination')

@section('content')
    <div class="card" style="max-width: 900px;">
        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label">Destination Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Location (City, Country) *</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
                </div>
                
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label">Short Description (for cards) *</label>
                    <textarea name="short_description" class="form-control" style="min-height: 80px;" required>{{ old('short_description') }}</textarea>
                </div>
                
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label">Full Description *</label>
                    <textarea name="description" class="form-control" style="min-height: 200px;" required>{{ old('description') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Hero Image (Main Photo)</label>
                    <input type="file" name="hero_image" class="form-control" accept="image/*">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Gallery Images (Multiple allowed)</label>
                    <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Latitude (for Map)</label>
                    <input type="number" step="0.0000001" name="latitude" class="form-control" value="{{ old('latitude') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Longitude (for Map)</label>
                    <input type="number" step="0.0000001" name="longitude" class="form-control" value="{{ old('longitude') }}">
                </div>
                
                <h3 style="grid-column: span 2; margin-top: 20px; font-size: 18px; border-bottom: 1px solid var(--admin-border); padding-bottom: 10px;">Quick Facts</h3>
                
                <div class="form-group">
                    <label class="form-label">Best Time to Visit</label>
                    <input type="text" name="best_time" class="form-control" placeholder="e.g. May - September" value="{{ old('best_time') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Budget Range</label>
                    <select name="budget" class="form-control">
                        <option value="">Select Range</option>
                        <option value="$" {{ old('budget') == '$' ? 'selected' : '' }}>$ (Budget)</option>
                        <option value="$$" {{ old('budget') == '$$' ? 'selected' : '' }}>$$ (Moderate)</option>
                        <option value="$$$" {{ old('budget') == '$$$' ? 'selected' : '' }}>$$$ (Luxury)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Language</label>
                    <input type="text" name="language" class="form-control" value="{{ old('language') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Currency</label>
                    <input type="text" name="currency" class="form-control" value="{{ old('currency') }}">
                </div>
                
                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label">Travel Tips</label>
                    <textarea name="travel_tips" class="form-control">{{ old('travel_tips') }}</textarea>
                </div>
                
                <h3 style="grid-column: span 2; margin-top: 20px; font-size: 18px; border-bottom: 1px solid var(--admin-border); padding-bottom: 10px;">Status & SEO</h3>
                
                <div class="form-group" style="grid-column: span 2; display: flex; gap: 30px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        <span style="font-weight: 500;">Featured Destination</span>
                    </label>
                    
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_hidden_gem" value="1" {{ old('is_hidden_gem') ? 'checked' : '' }} style="width: 18px; height: 18px;">
                        <span style="font-weight: 500;">Hidden Gem</span>
                    </label>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Star Rating (0-5)</label>
                    <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control" value="{{ old('rating', '0.0') }}">
                </div>
                
                <div class="form-group" style="grid-column: span 2; display: flex; gap: 15px; margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">Save Destination</button>
                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline" style="padding: 12px 30px;">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection

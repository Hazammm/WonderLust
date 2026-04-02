<div class="destination-card" data-aos="fade-up" style="background: var(--white); border-radius: 12px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: transform var(--transition-normal), box-shadow var(--transition-normal); position: relative;">
    @if($destination->is_featured && !isset($hideFeaturedBadge))
        <div class="badge badge-featured">Featured</div>
    @endif
    
    <div class="card-img-wrapper" style="position: relative; height: 240px; overflow: hidden;">
        <img src="{{ $destination->hero_image_url }}" alt="{{ $destination->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform var(--transition-slow);">
        
        <div class="card-overlay" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; background: linear-gradient(to top, rgba(11,20,38,0.9), transparent);">
            @if($destination->category)
                <span class="badge badge-{{ $destination->category->slug }} mb-1" style="background: {{ $destination->category->color }}; color: #fff;">
                    <i class="fa-solid {{ $destination->category->icon }}"></i> {{ $destination->category->name }}
                </span>
            @endif
        </div>
    </div>
    
    <div class="card-body" style="padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
            <h3 style="margin: 0; font-size: 22px;">
                <a href="{{ route('destinations.show', $destination->slug) }}" style="color: var(--navy);">{{ $destination->name }}</a>
            </h3>
            @if($destination->rating > 0)
                <div style="display: flex; align-items: center; gap: 5px; color: var(--amber); font-weight: 600;">
                    <i class="fa-solid fa-star"></i> {{ $destination->rating }}
                </div>
            @endif
        </div>
        
        <p style="color: var(--gray-500); font-size: 14px; margin-bottom: 15px;">
            <i class="fa-solid fa-location-dot" style="color: var(--coral);"></i> {{ $destination->location }}
        </p>
        
        <p style="color: var(--gray-500); font-size: 15px; margin-bottom: 20px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $destination->short_description }}
        </p>
        
        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--gray-200); padding-top: 15px;">
            <div style="color: var(--gray-500); font-size: 13px;">
                <i class="fa-regular fa-calendar" style="margin-right: 5px;"></i> {{ $destination->best_time ?? 'All year' }}
            </div>
            <a href="{{ route('destinations.show', $destination->slug) }}" style="color: var(--teal); font-weight: 600; font-size: 14px;">
                Explore <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>
            </a>
        </div>
    </div>
</div>

@extends('layouts.app')

@section('title', 'Hidden Gems | Wanderlust Guides')
@section('body_class', 'dark-theme')

@section('content')
    <div style="padding: 120px 0 60px; text-align: center;">
        <div class="container">
            <div style="font-size: 50px; color: var(--amber); margin-bottom: 20px;">
                <i class="fa-regular fa-compass"></i>
            </div>
            <h1 data-aos="fade-up" style="font-size: clamp(32px, 5vw, 50px); margin-bottom: 15px; color: var(--white); font-family: var(--font-heading);">Hidden Gems - Offbeat Destinations</h1>
            <p data-aos="fade-up" data-aos-delay="100" style="color: var(--gray-400); max-width: 700px; margin: 0 auto; font-size: 18px;">
                Escape the crowds and discover the world's best-kept secrets. These extraordinary destinations offer authentic experiences far from the beaten path.
            </p>
        </div>
    </div>

    <!-- Featured Gem -->
    @if($featuredGem)
        <section class="section" style="padding-top: 0;">
            <div class="container">
                <div data-aos="fade-up" style="position: relative; border-radius: 20px; overflow: hidden; height: 60vh; min-height: 500px; box-shadow: 0 0 40px rgba(244, 162, 97, 0.1);">
                    <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(to top, rgba(11,20,38,1) 0%, rgba(11,20,38,0.3) 50%, transparent 100%); z-index: 1;"></div>
                    <img src="{{ $featuredGem->hero_image_url }}" alt="{{ $featuredGem->name }}" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top:0; left:0;">
                    
                    <div style="position: relative; z-index: 2; height: 100%; display: flex; flex-direction: column; justify-content: flex-end; padding: 50px;">
                        <span class="badge badge-gem mb-3" style="display: inline-flex; align-items: center; gap: 8px; align-self: flex-start; font-size: 14px; padding: 6px 16px;">
                            <i class="fa-solid fa-gem" style="color: var(--amber);"></i> Hidden Gem Spotlight
                        </span>
                        
                        <h2 style="font-size: clamp(30px, 4vw, 48px); color: var(--amber); margin-bottom: 10px;">{{ $featuredGem->name }}</h2>
                        <div style="color: var(--gray-300); font-size: 18px; margin-bottom: 20px;">
                            <i class="fa-solid fa-location-dot" style="color: var(--coral);"></i> {{ $featuredGem->location }}
                        </div>
                        
                        <p style="color: var(--gray-300); max-width: 800px; font-size: 18px; line-height: 1.6; margin-bottom: 30px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $featuredGem->short_description }}
                        </p>
                        
                        <div>
                            <a href="{{ route('destinations.show', $featuredGem->slug) }}" class="btn" style="background: rgba(244, 162, 97, 0.2); border: 1px solid var(--amber); color: var(--amber);">
                                Uncover the Secret
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Gems Grid -->
    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 40px;">
                @foreach($hiddenGems as $gem)
                    @if($loop->first) @continue @endif
                    
                    <div data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}" style="background: var(--navy-light); border: 1px solid rgba(244, 162, 97, 0.2); border-radius: 12px; overflow: hidden; transition: transform 0.3s, box-shadow 0.3s; position: relative;">
                        <!-- Sparkle effect accents -->
                        <div style="position: absolute; top: 10px; right: 10px; color: var(--amber); opacity: 0.5; z-index: 5;"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                        
                        <a href="{{ route('destinations.show', $gem->slug) }}" style="display: block; height: 250px; overflow: hidden; position: relative;">
                            <div style="position: absolute; inset: 0; background: linear-gradient(to top, var(--navy-light), transparent); z-index: 1;"></div>
                            <img src="{{ $gem->hero_image_url }}" alt="{{ $gem->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </a>
                        
                        <div style="padding: 25px; position: relative; z-index: 2; margin-top: -40px;">
                            <span class="badge" style="background: rgba(11,20,38,0.8); border: 1px solid var(--amber); color: var(--amber); margin-bottom: 15px;">
                                <i class="fa-solid fa-gem"></i> Hidden Gem
                            </span>
                            
                            <h3 style="font-size: 24px; color: var(--white); margin-bottom: 10px;">
                                <a href="{{ route('destinations.show', $gem->slug) }}">{{ $gem->name }}</a>
                            </h3>
                            
                            <p style="color: var(--gray-400); font-size: 14px; margin-bottom: 15px;">
                                <i class="fa-solid fa-location-dot" style="color: var(--coral);"></i> {{ $gem->location }}
                            </p>
                            
                            <p style="color: var(--gray-300); font-size: 15px; margin-bottom: 20px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $gem->short_description }}
                            </p>
                            
                            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px;">
                                <a href="{{ route('destinations.show', $gem->slug) }}" style="color: var(--amber); font-weight: 500; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
                                    Explore <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($hiddenGems->isEmpty())
                <div style="text-align: center; color: var(--gray-400); padding: 50px 0;">
                    <p>No hidden gems discovered yet. Check back soon!</p>
                </div>
            @endif
        </div>
    </section>
@endsection

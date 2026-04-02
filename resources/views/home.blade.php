@extends('layouts.app')

@section('title', 'Wanderlust Guides | Discover Your Next Adventure')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section" style="position: relative; height: 100vh; min-height: 600px; display: flex; align-items: center;">
        <!-- Swiper -->
        <div class="swiper hero-swiper" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;">
            <div class="swiper-wrapper">
                @forelse($sliderDestinations as $dest)
                    <div class="swiper-slide">
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(rgba(11,20,38,0.4), rgba(11,20,38,0.8)); z-index: 1;"></div>
                        <img src="{{ $dest->hero_image_url }}" alt="{{ $dest->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @empty
                    <div class="swiper-slide" style="background-color: var(--navy);"></div>
                @endforelse
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="container" style="position: relative; z-index: 2; text-align: center; color: var(--white); padding-top: 80px;">
            <h1 data-aos="fade-up" style="font-size: clamp(40px, 6vw, 70px); font-weight: 800; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px;">
                Discover Your<br><span style="color: var(--coral);">Next Adventure</span>
            </h1>
            <p data-aos="fade-up" data-aos-delay="100" style="font-size: clamp(16px, 2vw, 22px); max-width: 700px; margin: 0 auto 40px; font-weight: 300;">
                Curated travel guides, hidden gems, and unforgettable experiences across the globe.
            </p>
            
            <div data-aos="fade-up" data-aos-delay="200" style="max-width: 600px; margin: 0 auto; position: relative;">
                <form action="{{ route('destinations.index') }}" method="GET" style="display: flex; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 8px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.2);">
                    <input type="text" name="search" placeholder="Search destinations, activities, experiences..." style="flex: 1; background: transparent; border: none; padding: 10px 20px; color: var(--white); font-size: 16px; outline: none;">
                    <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 16px;">Explore Now</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Travel Categories</h2>
                <p class="section-subtitle">Find exactly what you're looking for, whether it's adrenaline, history, or culinary delights.</p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                @foreach($categories as $category)
                    <a href="{{ route('destinations.index', ['category' => $category->slug]) }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" style="background: var(--white); border-radius: 16px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform var(--transition-normal);">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: {{ $category->color }}22; color: {{ $category->color }}; display: flex; justify-content: center; align-items: center; font-size: 30px; margin: 0 auto 20px;">
                            <i class="fa-solid {{ $category->icon }}"></i>
                        </div>
                        <h3 style="font-size: 22px; margin-bottom: 10px;">{{ $category->name }}</h3>
                        <p style="color: var(--gray-500); margin-bottom: 0;">{{ $category->destinations_count }} Destinations</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="section" style="background-color: var(--navy-light); color: var(--white);">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" style="color: var(--white);">Featured Destinations</h2>
                <p class="section-subtitle" style="color: var(--gray-400);">Our hand-picked selection of the most extraordinary places on earth.</p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
                @foreach($featuredDestinations as $destination)
                    @include('partials.destination-card', ['destination' => $destination, 'hideFeaturedBadge' => true])
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('destinations.index') }}" class="btn btn-outline" data-aos="fade-up">View All Destinations</a>
            </div>
        </div>
    </section>
@endsection

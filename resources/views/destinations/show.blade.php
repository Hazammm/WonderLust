@extends('layouts.app')

@section('title', $destination->meta_title ?? $destination->name . ' | Wanderlust Guides')
@section('meta_description', $destination->meta_description ?? $destination->short_description)

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endsection

@section('content')
    <!-- Hero Image -->
    <div style="position: relative; height: 60vh; min-height: 400px; width: 100%;">
        <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(rgba(0,0,0,0.2), rgba(11,20,38,0.9)); z-index: 1;"></div>
        <img src="{{ $destination->hero_image_url }}" alt="{{ $destination->name }}" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top:0; left:0;">
        
        <div class="container" style="position: relative; z-index: 2; height: 100%; display: flex; flex-direction: column; justify-content: flex-end; padding-bottom: 50px;">
            @if($destination->category)
                <span class="badge" style="background: {{ $destination->category->color }}; color: #fff; align-self: flex-start; margin-bottom: 15px; font-size: 14px;">
                    <i class="fa-solid {{ $destination->category->icon }}"></i> {{ $destination->category->name }}
                </span>
            @endif
            <h1 style="color: var(--white); font-size: clamp(40px, 6vw, 70px); font-weight: 800; margin-bottom: 10px;">{{ $destination->name }}</h1>
            <div style="display: flex; align-items: center; gap: 20px; color: var(--gray-300); font-size: 18px;">
                <span><i class="fa-solid fa-location-dot" style="color: var(--coral);"></i> {{ $destination->location }}</span>
                @if($destination->rating > 0)
                    <span style="color: var(--amber);"><i class="fa-solid fa-star"></i> {{ $destination->rating }}</span>
                @endif
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div style="display: flex; flex-wrap: wrap; gap: 50px;">
                <!-- Main Content (Left) -->
                <div style="flex: 1; min-width: 60%;" data-aos="fade-up">
                    
                    @if($destination->gallery && count($destination->gallery) > 0)
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px; margin-bottom: 40px;">
                            @foreach($destination->gallery as $index => $img)
                                <a href="{{ asset($img) }}" data-lightbox="destination-gallery" data-title="{{ $destination->name }} - Image {{ $index + 1 }}" style="display: block; height: 150px; border-radius: 8px; overflow: hidden;">
                                    <img src="{{ asset($img) }}" alt="Gallery Image" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <h2 style="font-size: 28px; margin-bottom: 20px; color: var(--navy);">Overview</h2>
                    <div style="font-size: 16px; line-height: 1.8; color: var(--gray-500); margin-bottom: 40px;">
                        {!! nl2br(e($destination->description)) !!}
                    </div>

                    @if($destination->travel_tips)
                        <div style="background: var(--cream); border-left: 4px solid var(--amber); padding: 30px; border-radius: 0 12px 12px 0; margin-bottom: 40px;">
                            <h3 style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; color: var(--navy);">
                                <i class="fa-solid fa-lightbulb" style="color: var(--amber);"></i> Essential Travel Tips
                            </h3>
                            <div style="line-height: 1.7; color: var(--gray-500);">
                                {!! nl2br(e($destination->travel_tips)) !!}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar (Right) -->
                <div style="flex: 0 0 350px;" data-aos="fade-up" data-aos-delay="100">
                    <div style="position: sticky; top: 100px;">
                        
                        <!-- Quick Facts -->
                        <div style="background: var(--white); border-radius: 12px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-bottom: 30px;">
                            <h3 style="font-size: 20px; margin-bottom: 20px; border-bottom: 1px solid var(--gray-200); padding-bottom: 10px;">Quick Facts</h3>
                            
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="display: flex; align-items: flex-start; gap: 15px; margin-bottom: 15px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,107,107,0.1); color: var(--coral); display: flex; justify-content: center; align-items: center; font-size: 18px;">
                                        <i class="fa-regular fa-calendar"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 13px; color: var(--gray-500);">Best Time to Visit</div>
                                        <div style="font-weight: 600; color: var(--navy);">{{ $destination->best_time ?? 'Year-round' }}</div>
                                    </div>
                                </li>
                                
                                <li style="display: flex; align-items: flex-start; gap: 15px; margin-bottom: 15px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(46,196,182,0.1); color: var(--teal); display: flex; justify-content: center; align-items: center; font-size: 18px;">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 13px; color: var(--gray-500);">Budget</div>
                                        <div style="font-weight: 600; color: var(--navy);">{{ $destination->budget ?? 'Varies' }}</div>
                                    </div>
                                </li>
                                
                                <li style="display: flex; align-items: flex-start; gap: 15px; margin-bottom: 15px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(244,162,97,0.1); color: var(--amber); display: flex; justify-content: center; align-items: center; font-size: 18px;">
                                        <i class="fa-solid fa-language"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 13px; color: var(--gray-500);">Language</div>
                                        <div style="font-weight: 600; color: var(--navy);">{{ $destination->language ?? 'Local language' }}</div>
                                    </div>
                                </li>
                                
                                <li style="display: flex; align-items: flex-start; gap: 15px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(11,20,38,0.1); color: var(--navy); display: flex; justify-content: center; align-items: center; font-size: 18px;">
                                        <i class="fa-solid fa-coins"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 13px; color: var(--gray-500);">Currency</div>
                                        <div style="font-weight: 600; color: var(--navy);">{{ $destination->currency ?? 'Local currency' }}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Map -->
                        @if($destination->latitude && $destination->longitude)
                            <div style="background: var(--white); border-radius: 12px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                                <div id="map" style="width: 100%; height: 250px;"></div>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Similar Destinations Carousel -->
    @if($similarDestinations->count() > 0)
        <section class="section" style="background-color: var(--gray-100);">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Similar Destinations</h2>
                    <p class="section-subtitle">More incredible places in the same category.</p>
                </div>
                
                <div class="swiper similar-destinations-swiper" style="padding-bottom: 50px;">
                    <div class="swiper-wrapper">
                        @foreach($similarDestinations as $similar)
                            <div class="swiper-slide">
                                @include('partials.destination-card', ['destination' => $similar])
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    
    @if($destination->latitude && $destination->longitude)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var map = L.map('map').setView([{{ $destination->latitude }}, {{ $destination->longitude }}], 10);

                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                    subdomains: 'abcd',
                    maxZoom: 20
                }).addTo(map);

                var marker = L.marker([{{ $destination->latitude }}, {{ $destination->longitude }}]).addTo(map);
                marker.bindPopup("<b>{{ $destination->name }}</b><br>{{ $destination->location }}").openPopup();
            });
        </script>
    @endif
@endsection

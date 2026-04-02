@extends('layouts.app')

@section('title', 'Explore Destinations | Wanderlust Guides')

@section('content')
    <div style="background-color: var(--navy); padding: 150px 0 60px; color: var(--white); text-align: center;">
        <div class="container" style="position: relative; z-index: 2;">
            <h1 data-aos="fade-up" style="font-size: clamp(32px, 5vw, 50px); margin-bottom: 15px;">Explore Destinations</h1>
            <p data-aos="fade-up" data-aos-delay="100" style="color: var(--gray-300); max-width: 600px; margin: 0 auto; font-size: 18px;">Find your next adventure with our curated selection of remarkable places around the world.</p>
        </div>
    </div>

    <!-- Filters Section -->
    <div style="background-color: var(--white); border-bottom: 1px solid var(--gray-200); padding: 20px 0; position: sticky; top: 60px; z-index: 100;">
        <div class="container" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 20px;">
            <div style="display: flex; gap: 10px; overflow-x: auto; padding-bottom: 5px;">
                <a href="{{ route('destinations.index') }}" class="btn" style="padding: 8px 20px; background: {{ !request('category') || request('category') == 'all' ? 'var(--coral)' : 'var(--gray-200)' }}; color: {{ !request('category') || request('category') == 'all' ? 'var(--white)' : 'var(--navy)' }};">All</a>
                @foreach($categories as $category)
                    <a href="{{ route('destinations.index', ['category' => $category->slug]) }}" class="btn" style="padding: 8px 20px; background: {{ request('category') == $category->slug ? $category->color : 'var(--gray-200)' }}; color: {{ request('category') == $category->slug ? 'var(--white)' : 'var(--navy)' }};">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            
            <div>
                <form action="{{ route('destinations.index') }}" method="GET" style="position: relative;">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." style="padding: 10px 15px 10px 40px; border: 1px solid var(--gray-300); border-radius: 50px; outline: none; width: 250px;">
                    <i class="fa-solid fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--gray-400);"></i>
                </form>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            @if($destinations->isEmpty())
                <div style="text-align: center; padding: 80px 0;">
                    <div style="font-size: 60px; color: var(--gray-300); margin-bottom: 20px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h3 style="color: var(--navy); margin-bottom: 10px;">No destinations found</h3>
                    <p style="color: var(--gray-500); margin-bottom: 20px;">Try adjusting your search or filter criteria.</p>
                    <a href="{{ route('destinations.index') }}" class="btn btn-outline" style="color: var(--navy); border-color: var(--navy);">Clear Filters</a>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
                    @foreach($destinations as $destination)
                        @include('partials.destination-card', ['destination' => $destination])
                    @endforeach
                </div>
                
                <div style="margin-top: 50px;">
                    {{ $destinations->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </section>
@endsection

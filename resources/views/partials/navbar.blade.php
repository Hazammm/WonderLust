<nav class="navbar">
    <div class="container">
        <a href="{{ route('home') }}" class="nav-brand">
            <i class="fa-solid fa-mountain-sun"></i> Wanderlust
        </a>
        
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('destinations.index') }}" class="{{ request()->routeIs('destinations.*') ? 'active' : '' }}">Destinations</a></li>
            <li><a href="{{ route('hidden-gems') }}" class="{{ request()->routeIs('hidden-gems') ? 'active' : '' }}">Hidden Gems</a></li>
        </ul>
        
        <div class="nav-icons">
            <a href="#" class="search-toggle"><i class="fa-solid fa-magnifying-glass"></i></a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" title="Admin Panel"><i class="fa-solid fa-gauge"></i></a>
                @endif
            @endauth
            <button class="mobile-menu-btn"><i class="fa-solid fa-bars"></i></button>
        </div>
    </div>
</nav>

<footer class="footer">
    <div class="container">
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 40px; margin-bottom: 40px;">
            <div style="flex: 1; min-width: 250px;">
                <a href="{{ route('home') }}" class="nav-brand" style="margin-bottom: 20px;">
                    <i class="fa-solid fa-mountain-sun"></i> Wanderlust
                </a>
                <p style="margin-bottom: 20px; max-width: 300px;">Discovering the world's most breathtaking destinations and offbeat hidden gems. Your ultimate travel companion.</p>
                <div style="display: flex; gap: 15px; font-size: 20px;">
                    <a href="#" class="text-coral"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="text-coral"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="text-coral"><i class="fa-brands fa-pinterest"></i></a>
                </div>
            </div>
            
            <div style="flex: 1; min-width: 150px;">
                <h4 style="color: var(--white); margin-bottom: 20px;">Explore</h4>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 10px;"><a href="{{ route('destinations.index') }}">All Destinations</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('hidden-gems') }}">Hidden Gems</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('destinations.index', ['category' => 'adventure']) }}">Adventure Travel</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('destinations.index', ['category' => 'culture']) }}">Culture & History</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('destinations.index', ['category' => 'food']) }}">Food Tours</a></li>
                </ul>
            </div>
            
            <div style="flex: 1; min-width: 250px;">
                <h4 style="color: var(--white); margin-bottom: 20px;">Newsletter</h4>
                <p style="margin-bottom: 15px;">Get the latest travel guides and hidden gems straight to your inbox.</p>
                <form style="display: flex;">
                    <input type="email" placeholder="Your email address" style="flex: 1; padding: 12px 15px; border: none; border-radius: 4px 0 0 4px; outline: none;">
                    <button type="button" class="btn btn-primary" style="border-radius: 0 4px 4px 0; padding: 12px 20px;"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        
        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px; text-align: center; font-size: 14px;">
            <p>&copy; {{ date('Y') }} Wanderlust Guides Laravel Demo. All rights reserved.</p>
            <p style="margin-top: 5px;">Created for demonstration purposes.</p>
        </div>
    </div>
</footer>

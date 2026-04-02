/**
 * Wanderlust Travel Guide - Main JS Component
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Initializations
    // Init AOS Animation Library
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });
    }

    // Init Swiper for Hero Slider (if exists)
    if (document.querySelector('.hero-swiper')) {
        new Swiper('.hero-swiper', {
            loop: true,
            effect: 'fade',
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    // Init Swiper for Similar Destinations Carousel
    if (document.querySelector('.similar-destinations-swiper')) {
        new Swiper('.similar-destinations-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                768: { slidesPerView: 3, spaceBetween: 30 },
                1024: { slidesPerView: 4, spaceBetween: 30 },
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }

    // 2. Navbar Scroll Effect
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // 3. Search Overlay Toggle
    const searchBtn = document.querySelector('.search-toggle');
    const searchOverlay = document.querySelector('.search-overlay');
    const searchClose = document.querySelector('.search-close');
    const searchInput = document.querySelector('#global-search');

    if (searchBtn && searchOverlay) {
        searchBtn.addEventListener('click', (e) => {
            e.preventDefault();
            searchOverlay.classList.add('active');
            setTimeout(() => searchInput.focus(), 100);
            document.body.style.overflow = 'hidden';
        });

        searchClose.addEventListener('click', () => {
            searchOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    // 4. AJAX Search Autocomplete
    const searchResultsDropdown = document.querySelector('.search-results-dropdown');
    
    if (searchInput) {
        let debounceTimer;
        
        searchInput.addEventListener('input', function(e) {
            clearTimeout(debounceTimer);
            const query = e.target.value.trim();
            
            if (query.length < 2) {
                searchResultsDropdown.style.display = 'none';
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`/api/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.results && data.results.length > 0) {
                            let html = '<ul style="list-style:none; padding:0; margin:0;">';
                            data.results.forEach(item => {
                                html += `
                                    <li>
                                        <a href="${item.url}" style="display:flex; align-items:center; padding:15px; border-bottom:1px solid #eee; text-decoration:none; color:#0B1426;">
                                            <img src="${item.hero_image}" style="width:60px; height:60px; object-fit:cover; border-radius:8px; margin-right:15px;" alt="${item.name}">
                                            <div>
                                                <h4 style="margin:0 0 5px; font-size:16px;">${item.name}</h4>
                                                <div style="font-size:13px; color:#666;">
                                                    <span style="color:#2EC4B6; font-weight:bold; margin-right:8px;">${item.category}</span>
                                                    <span>${item.location}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                `;
                            });
                            html += '</ul>';
                            searchResultsDropdown.innerHTML = html;
                            searchResultsDropdown.style.display = 'block';
                        } else {
                            searchResultsDropdown.innerHTML = '<div style="padding:20px; text-align:center; color:#666;">No destinations found</div>';
                            searchResultsDropdown.style.display = 'block';
                        }
                    });
            }, 300);
        });
    }
});

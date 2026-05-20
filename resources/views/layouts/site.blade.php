<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', app(\App\Settings\GeneralSettings::class)->site_name)</title>
    
    {{-- Prevent FOUC for theme --}}
    <script>
        (function() {
            const theme = localStorage.getItem('theme-preference') || 'dark';
            document.documentElement.classList.add(theme);
        })();
    </script>
    
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a0a1a] text-white font-sans antialiased transition-colors duration-300">
    {{-- Navigation --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-[#0a0a1a]/80 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="/" class="text-xl font-bold text-amber-500">
                    {{ app(\App\Settings\GeneralSettings::class)->site_name }}
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-300 hover:text-white transition">Features</a>
                    <a href="#products" class="text-gray-300 hover:text-white transition">Products</a>
                    <a href="#testimonials" class="text-gray-300 hover:text-white transition">Testimonials</a>
                    <a href="#pricing" class="text-gray-300 hover:text-white transition">Pricing</a>
                </div>

                {{-- Desktop Actions --}}
                <div class="hidden md:flex items-center space-x-4">
                    {{-- Theme Toggle --}}
                    <button id="theme-toggle" class="p-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition" aria-label="Toggle theme">
                        {{-- Sun icon (shows in dark mode) --}}
                        <svg id="theme-sun" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        {{-- Moon icon (shows in light mode) --}}
                        <svg id="theme-moon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>
                    
                    {{-- CTA Button --}}
                    <a href="{{ app(\App\Settings\GeneralSettings::class)->hero_cta_url }}" 
                       class="bg-amber-500 hover:bg-amber-600 text-black font-semibold px-6 py-2 rounded-lg transition">
                        {{ app(\App\Settings\GeneralSettings::class)->hero_cta_text }}
                    </a>
                </div>

                {{-- Mobile menu button --}}
                <div class="md:hidden flex items-center space-x-2">
                    {{-- Mobile Theme Toggle --}}
                    <button id="theme-toggle-mobile" class="p-2 rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition" aria-label="Toggle theme">
                        <svg id="theme-sun-mobile" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg id="theme-moon-mobile" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>
                    
                    <button id="mobile-menu-btn" class="text-white p-2 rounded-lg hover:bg-white/10 transition">
                        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu Overlay --}}
        <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-40 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden"></div>
        
        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="fixed top-16 left-0 right-0 bg-[#0a0a1a] border-b border-white/10 transform -translate-y-full transition-transform duration-300 ease-out z-50 md:hidden max-h-[calc(100vh-4rem)] overflow-y-auto">
            <div class="px-4 py-4 space-y-2">
                <a href="#features" class="mobile-nav-link block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">Features</a>
                <a href="#products" class="mobile-nav-link block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">Products</a>
                <a href="#testimonials" class="mobile-nav-link block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">Testimonials</a>
                <a href="#pricing" class="mobile-nav-link block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition">Pricing</a>
                <a href="{{ app(\App\Settings\GeneralSettings::class)->hero_cta_url }}" 
                   class="mobile-nav-link block px-4 py-3 text-amber-500 font-semibold hover:bg-amber-500/10 rounded-lg transition">
                    {{ app(\App\Settings\GeneralSettings::class)->hero_cta_text }}
                </a>
            </div>
        </div>
    </nav>

    {{-- Spacer for fixed nav --}}
    <div class="h-16"></div>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('site.partials.footer')

    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        
        let isMenuOpen = false;
        
        function openMenu() {
            isMenuOpen = true;
            mobileMenu.classList.remove('-translate-y-full');
            mobileMenu.classList.add('translate-y-0');
            mobileMenuOverlay.classList.remove('opacity-0', 'pointer-events-none');
            mobileMenuOverlay.classList.add('opacity-100', 'pointer-events-auto');
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMenu() {
            isMenuOpen = false;
            mobileMenu.classList.add('-translate-y-full');
            mobileMenu.classList.remove('translate-y-0');
            mobileMenuOverlay.classList.add('opacity-0', 'pointer-events-none');
            mobileMenuOverlay.classList.remove('opacity-100', 'pointer-events-auto');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.style.overflow = '';
        }
        
        mobileMenuBtn.addEventListener('click', () => {
            if (isMenuOpen) {
                closeMenu();
            } else {
                openMenu();
            }
        });
        
        // Close on link click
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
        
        // Close on outside click
        mobileMenuOverlay.addEventListener('click', closeMenu);
        
        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isMenuOpen) {
                closeMenu();
            }
        });
    </script>
</body>
</html>

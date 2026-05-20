@php
$settings = app(\App\Settings\GeneralSettings::class);
@endphp

<footer class="bg-[#050510] border-t border-white/10 py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            {{-- Brand --}}
            <div class="md:col-span-2">
                <h3 class="text-2xl font-bold text-amber-500 mb-4">{{ $settings->site_name }}</h3>
                <p class="text-gray-400 mb-4">{{ $settings->tagline }}</p>
                
                {{-- Social Links --}}
                @if (!empty($settings->social_links))
                    <div class="flex space-x-4">
                        @foreach ($settings->social_links as $name => $url)
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" 
                               class="text-gray-400 hover:text-white transition">
                                <span class="sr-only">{{ $name }}</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    @if (strtolower($name) === 'twitter' || strtolower($name) === 'x')
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    @elseif (strtolower($name) === 'github')
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    @else
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                                    @endif
                                </svg>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Links --}}
            <div>
                <h4 class="font-bold mb-4">Product</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#features" class="hover:text-white transition">Features</a></li>
                    <li><a href="#products" class="hover:text-white transition">Products</a></li>
                    <li><a href="#pricing" class="hover:text-white transition">Pricing</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4">Company</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition">About</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    @if (Route::has('login'))
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} {{ $settings->site_name }}. All rights reserved.</p>
        </div>
    </div>
</footer>

@php
$settings = app(\App\Settings\GeneralSettings::class);
@endphp

<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Three.js Canvas --}}
    <div id="hero-canvas" class="absolute inset-0 z-0"></div>

    {{-- Dark Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b from-[#0a0a1a]/60 via-[#0a0a1a]/40 to-[#0a0a1a] z-10"></div>

    {{-- Content --}}
    <div class="relative z-20 text-center px-4 max-w-4xl mx-auto">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-amber-400 via-cyan-400 to-violet-400 bg-clip-text text-transparent hero-animate">
            {{ $settings->hero_headline }}
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-2xl mx-auto hero-animate hero-animate-delay-1">
            {{ $settings->hero_subtext }}
        </p>
        <div class="hero-animate hero-animate-delay-2">
            <a href="{{ $settings->hero_cta_url }}" 
               class="inline-block bg-amber-500 hover:bg-amber-600 text-black font-bold text-lg px-8 py-4 rounded-xl transition transform hover:scale-105">
                {{ $settings->hero_cta_text }}
            </a>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

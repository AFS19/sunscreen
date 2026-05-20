@php
$settings = app(\App\Settings\GeneralSettings::class);
@endphp

<section class="py-24 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <div class="animate-on-scroll bg-gradient-to-r from-violet-900/50 via-cyan-900/50 to-amber-900/50 rounded-3xl p-12 border border-white/10">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Ready to Get Started?
            </h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Join thousands of satisfied customers and transform your business today.
            </p>
            <a href="{{ $settings->hero_cta_url }}" 
               class="inline-block bg-amber-500 hover:bg-amber-600 text-black font-bold text-lg px-10 py-4 rounded-xl transition transform hover:scale-105">
                {{ $settings->hero_cta_text }}
            </a>
        </div>
    </div>
</section>

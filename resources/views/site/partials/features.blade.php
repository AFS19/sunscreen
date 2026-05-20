@php
$features = \App\Models\Feature::where('is_active', true)->orderBy('sort_order')->get();
@endphp

<section id="features" class="py-24 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Features</h2>
            <p class="text-gray-400 text-lg">Everything you need to succeed</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 animate-stagger">
            @forelse ($features as $feature)
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-violet-500 rounded-xl flex items-center justify-center mb-6">
                        @if ($feature->icon)
                            <span class="text-2xl">{{ $feature->icon }}</span>
                        @else
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ $feature->title }}</h3>
                    <p class="text-gray-400">{{ $feature->description }}</p>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    No features available yet.
                </div>
            @endforelse
        </div>
    </div>
</section>

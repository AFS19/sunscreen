@php
$testimonials = \App\Models\Testimonial::where('is_featured', true)->get();
@endphp

<section id="testimonials" class="py-24 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">What Our Clients Say</h2>
            <p class="text-gray-400 text-lg">Trusted by industry leaders</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 animate-stagger">
            @forelse ($testimonials as $testimonial)
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8 relative hover:bg-white/10 transition">
                    {{-- Quote icon --}}
                    <svg class="absolute top-6 right-6 w-10 h-10 text-amber-500/30" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>

                    <p class="text-gray-300 text-lg mb-6 italic">"{{ $testimonial->quote }}"</p>

                    <div class="flex items-center">
                        @if ($testimonial->avatar)
                            <img src="{{ Storage::url($testimonial->avatar) }}" 
                                 alt="{{ $testimonial->author_name }}" 
                                 class="w-12 h-12 rounded-full object-cover mr-4">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-500 to-violet-500 flex items-center justify-center mr-4">
                                <span class="text-white font-bold text-lg">{{ strtoupper(substr($testimonial->author_name, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div>
                            <h4 class="font-bold">{{ $testimonial->author_name }}</h4>
                            <p class="text-gray-400 text-sm">{{ $testimonial->company }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    No testimonials available yet.
                </div>
            @endforelse
        </div>
    </div>
</section>

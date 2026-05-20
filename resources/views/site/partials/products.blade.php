@php
$products = \App\Models\Product::where('is_featured', true)->where('is_active', true)->get();
@endphp

<section id="products" class="py-24 px-4 bg-white/5">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Our Products</h2>
            <p class="text-gray-400 text-lg">Premium solutions for your business</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 animate-stagger">
            @forelse ($products as $product)
                <div class="bg-[#0a0a1a] border border-white/10 rounded-2xl overflow-hidden hover:border-amber-500/50 transition transform hover:-translate-y-1">
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-violet-900/50 to-cyan-900/50 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-400 mb-4 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-amber-500">${{ number_format($product->price, 2) }}</span>
                            <a href="#" class="text-cyan-400 hover:text-cyan-300 font-medium">Learn more →</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    No featured products available.
                </div>
            @endforelse
        </div>
    </div>
</section>

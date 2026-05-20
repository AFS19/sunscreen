@php
$plans = \App\Models\PricingPlan::orderBy('price')->get();
@endphp

<section id="pricing" class="py-24 px-4 bg-white/5">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Pricing Plans</h2>
            <p class="text-gray-400 text-lg">Choose the perfect plan for your needs</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto animate-stagger">
            @forelse ($plans as $plan)
                <div class="relative bg-[#0a0a1a] border {{ $plan->is_featured ? 'border-amber-500 scale-105' : 'border-white/10' }} rounded-2xl p-8 hover:border-amber-500/50 transition">
                    @if ($plan->is_featured)
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                            <span class="bg-gradient-to-r from-amber-500 to-violet-500 text-white text-sm font-bold px-4 py-1 rounded-full">
                                Most Popular
                            </span>
                        </div>
                    @endif

                    <h3 class="text-2xl font-bold mb-2">{{ $plan->name }}</h3>
                    <p class="text-gray-400 mb-6">{{ $plan->billing_cycle }}</p>

                    <div class="mb-6">
                        <span class="text-5xl font-bold">${{ number_format($plan->price, 0) }}</span>
                        <span class="text-gray-400">/{{ $plan->billing_cycle }}</span>
                    </div>

                    <ul class="space-y-4 mb-8">
                        @foreach ($plan->features as $feature)
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 text-amber-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ $plan->cta_url }}" 
                       class="block w-full text-center {{ $plan->is_featured ? 'bg-gradient-to-r from-amber-500 to-violet-500 hover:from-amber-600 hover:to-violet-600' : 'bg-white/10 hover:bg-white/20' }} text-white font-bold py-4 rounded-xl transition">
                        {{ $plan->cta_label }}
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    No pricing plans available yet.
                </div>
            @endforelse
        </div>
    </div>
</section>

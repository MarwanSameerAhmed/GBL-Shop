@extends('layouts.app')

@section('title', __('messages.features'))

@section('content')
<div class="relative overflow-hidden">
  <!-- Background Glow -->
  <div class="absolute top-1/2 left-1/2 w-[80rem] h-[80rem] bg-primary/10 -translate-x-1/2 -translate-y-1/2 rounded-full blur-3xl opacity-50 animate-pulse"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
    {{-- Hero Section --}}
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-[#fcc85e] dark:text-[#fcc85e] mb-4">
            {{ __('messages.our_features') }}
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            {{ __('messages.features_description') }}
        </p>
    </div>

    {{-- Features Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @php
            $features = [
                ['icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'title' => 'quality_products', 'desc' => 'quality_products_desc'],
                ['icon' => 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8', 'title' => 'fast_delivery', 'desc' => 'fast_delivery_desc'],
                ['icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'customer_support', 'desc' => 'customer_support_desc'],
                ['icon' => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.602-.39-3.123-1.098-4.425a11.953 11.953 0 00-4.498-3.756A11.953 11.953 0 0012 2.75a11.953 11.953 0 00-4.402.914z', 'title' => 'secure_payments', 'desc' => 'secure_payments_desc'],
                ['icon' => 'M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3', 'title' => 'easy_returns', 'desc' => 'easy_returns_desc'],
                ['icon' => 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 8.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 018.25 20.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6A2.25 2.25 0 0115.75 3.75h2.25A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25A2.25 2.25 0 0113.5 8.25V6zM13.5 15.75A2.25 2.25 0 0115.75 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25h-2.25a2.25 2.25 0 01-2.25-2.25v-2.25z', 'title' => 'wide_selection', 'desc' => 'wide_selection_desc'],
            ];
        @endphp

        @foreach ($features as $feature)
        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
             class="group relative text-center bg-white/50 dark:bg-gray-800/50 rounded-2xl p-6 shadow-lg hover:shadow-primary/20
                    transition-all duration-300 ease-in-out border border-white/20 dark:border-gray-700/50
                    hover:-translate-y-2 backdrop-blur-xl overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-primary/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-primary/20 rounded-full blur-2xl opacity-50 group-hover:opacity-80 transition-opacity duration-500"></div>

            <div class="mb-5 relative inline-flex">
                <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-xl flex items-center justify-center shadow-md group-hover:shadow-primary/50
                           group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                    <svg class="w-8 h-8 text-black dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                    </svg>
                </div>
            </div>
            <h3 class="relative text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors duration-300">
                {{ __("messages.{$feature['title']}") }}
            </h3>
            <p class="relative text-gray-600 dark:text-gray-400 leading-relaxed">
                {{ __("messages.{$feature['desc']}") }}
            </p>
        </div>
        @endforeach
    </div>

    {{-- Call to Action --}}
    <div class="mt-16 text-center">
        <a href="{{ route('categories') }}"
           class="inline-flex items-center px-8 py-3 text-lg font-medium text-black bg-[#fcc85e] dark:text-white
                  rounded-xl hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2
                  focus:ring-primary transition-all duration-300 ease-in-out transform hover:scale-105">
            {{ __('messages.explore_products') }}
            <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
@endsection

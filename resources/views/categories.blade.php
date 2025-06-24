{{-- resources/views/categories.blade.php --}}
@extends('layouts.app')
@section('title', __('messages.categories'))

@php
  use Illuminate\Support\Str;
      $isRtl = app()->getLocale() === 'ar';

@endphp

@section('content')

  <section id="categories-header" class="py-25 bg-white dark:bg-gray-900 rounded-2xl">
    <div class="container mx-auto px-6 text-center">
      <h1 class="text-3xl md:text-4xl font-extrabold mb-1 bg-clip-text text-black bg-gradient-to-r from-primary to-accent dark:text-white">
        {{ __('messages.categories') }}
      </h1>
      <div class="mx-auto h-1 w-16 bg-primary dark:bg-accent rounded-full mb-4 animate-pulse-slow"></div>
      <p class="text-gray-600 dark:text-gray-400 max-w-lg mx-auto">
        {{ __('messages.sub-title-cat') }}
      </p>
    </div>
  </section>

  <section id="categories-grid" class="py-8 bg-gray-100 dark:bg-gray-800 rounded-2xl">
    <div class="container mx-auto px-4
                grid grid-cols-2           <!-- 2 عمود على الشاشات الصغيرة -->
                     sm:grid-cols-3        <!-- 3 أعمدة من ≥640px -->
                     lg:grid-cols-5     <!-- 4 أعمدة من ≥1024px -->
                gap-3                    <!-- فجوة 1rem على الشاشات الصغيرة والمتوسطة -->
                lg:gap-2">                <!-- فجوة 1.5rem على الشاشات الكبيرة -->

      @foreach($categories as $cat)
        @php
          $route   = data_get($cat, 'route', '');
           $catName      = $isRtl
                     ? data_get($cat, 'name')
                     : data_get($cat, 'en_name');
        //   $catName = data_get($cat, 'name', '');
          $hasSubs = data_get($cat, 'has_sub_categories', false);

          if (Str::startsWith($route, '/Categories/')) {
            $encodedId = Str::after($route, '/Categories/');
            $url       = route('subcategories', $encodedId);
          } elseif (Str::startsWith($route, '/Items/')) {
            $encodedId = Str::after($route, '/Items/');
            $url       = route('products', $encodedId);
          } else {
            $url = '#';
          }

  $filename = data_get($cat, 'image');
  $imageUrl = $filename
    ? asset('storage/images/' . $filename)
    : asset('images/default-category.png');
        @endphp

        <a href="{{ $url }}" class="block w-full max-w-[240px] group">
          <div
            class="relative overflow-hidden rounded-2xl
                   bg-white/80 dark:bg-zinc-900/80
                   backdrop-blur-xl
                   border border-zinc-200/50 dark:border-zinc-800/50
                   shadow-xs
                   transition-all duration-300
                   hover:shadow-md
                   hover:border-zinc-300/50 dark:hover:border-zinc-700/50">

            {{-- الصورة --}}
            <div class="relative h-[160px] w-full">
              <img src="{{ $imageUrl }}"
                   alt="{{ $catName }}"
                   class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-110" />
            </div>

            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent"></div>

            @if($hasSubs)
              <span
                class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-xs font-medium
                       bg-indigo-500/90 text-white backdrop-blur-md shadow-xs
                       border border-indigo-600/50">
                {{ __('messages.browse items') }}
              </span>
            @endif

            {{-- المحتوى النصي والأسهم --}}
            <div class="absolute bottom-0 left-0 right-0 p-5">
              <div class="flex items-center justify-between gap-3">
                <div class="space-y-1.5">
                  <h3 class="text-lg font-semibold text-white dark:text-zinc-100 leading-snug tracking-tighter">
                    {{ $catName }}
                  </h3>
                  <p class="text-sm text-zinc-200 dark:text-zinc-300 tracking-tight">
                    {{ $hasSubs ? __('messages.browse items') : __('messages.view products') }}
                  </p>
                </div>
                <div
                  class="p-2 rounded-full
                         bg-white/10 dark:bg-zinc-800/50
                         backdrop-blur-md
                         transition-colors duration-300 group-hover:bg-white/20 dark:group-hover:bg-zinc-700/50">
                  <svg xmlns="http://www.w3.org/2000/svg"
                       class="w-5 h-5 text-white group-hover:-rotate-12 transition-transform duration-300 transform"
                       fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 7l-10 10M7 7h10v10" />
                  </svg>
                </div>
              </div>
            </div>

          </div>
        </a>

      @endforeach
    </div>
  </section>

@endsection

@push('scripts')
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ once: true, easing: 'ease-out-cubic' });
  </script>
@endpush

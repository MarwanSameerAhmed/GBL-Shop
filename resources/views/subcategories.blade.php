{{-- resources/views/subcategories.blade.php --}}
@extends('layouts.app')
@section('title', __('messages.subcategories'))

@php
  use Illuminate\Support\Str;
    $isRtl = app()->getLocale() === 'ar';
     $locale = app()->getLocale();
    $nameField = $locale === 'ar' ? 'name' : 'en_name';
    $categoryName = data_get($subs[0], $nameField, '-');

@endphp

@section('content')

  {{-- Spacer to clear fixed navbar --}}
  <div class="mt-24"></div>

  {{-- Breadcrumb --}}
 <nav aria-label="Breadcrumb"
     class="bg-gray-50 dark:bg-gray-800 p-4 rounded-md shadow-sm mb-6 mx-6 md:mx-auto max-w-7xl">
  <ol class="flex items-center space-x-2 overflow-x-auto whitespace-nowrap py-1 text-sm text-gray-600 dark:text-gray-400">
    {{-- Home --}}
    <li class="flex items-center space-x-1 group">
      <svg xmlns="http://www.w3.org/2000/svg"
           class="w-4 h-4 text-gray-500 group-hover:text-primary transition-colors duration-200 group-hover:animate-bounce"
           fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
      </svg>
      <a href="{{ route('home') }}"
         class="hover:text-primary dark:hover:text-accent transition-colors duration-200">
        {{ __('messages.home') }}
      </a>
    </li>

    {{-- Separator --}}
    <li class="animate-pulse">/</li>

    {{-- Categories --}}
    <li class="flex items-center space-x-1 group">
      <svg xmlns="http://www.w3.org/2000/svg"
           class="w-4 h-4 text-gray-500 group-hover:text-primary transition-colors duration-200 group-hover:animate-bounce"
           fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
      </svg>
      <a href="{{ route('categories') }}"
         class="hover:text-primary dark:hover:text-accent transition-colors duration-200">
        {{ __('messages.catsNav') }}
      </a>
    </li>

    {{-- Separator --}}
    <li class="animate-pulse">/</li>

    {{-- Subcategories (active) --}}
    <li class="flex items-center space-x-1 group">
      <svg xmlns="http://www.w3.org/2000/svg"
           class="w-4 h-4 text-gray-400 transition-colors duration-200"
           fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 3h7v7H3V3zM14 3h7v7h-7V3zM14 14h7v7h-7v-7zM3 14h7v7H3v-7z" />

      </svg>
      <span class="font-semibold text-gray-800 dark:text-gray-200">
        {{ __('messages.subcategories') }}
      </span>
    </li>
  </ol>
</nav>


  {{-- Header Section --}}
  <section id="entity-header" class="py-6 bg-white dark:bg-gray-900 rounded-lg mb-8">
    <div class="container mx-auto px-6 text-center">
      <h1 class="text-2xl md:text-3xl font-bold text-black dark:text-white">
        @php
          $headerText = __('messages.Explore More Options');
          $lastSpacePos = strrpos($headerText, ' ');
          if ($lastSpacePos !== false) {
              $lastWord = substr($headerText, $lastSpacePos + 1);
              $firstPart = substr($headerText, 0, $lastSpacePos);
          } else {
              $lastWord = $headerText;
              $firstPart = '';
          }
        @endphp
        {!! $firstPart !!} <span class="text-[#fcc85e]">{!! $lastWord !!}</span>
      </h1>
         {{-- <h1 class="text-2xl md:text-3xl font-bold bg-clip-text text-black bg-gradient-to-r from-primary to-accent dark:from-accent dark:to-primary">
         {{' « '.$categoryName.' » ' }}
      </h1> --}}
      <p class="text-gray-600 dark:text-gray-400 mt-2">
        {{ __('messages.Select a subcategory to view products') }}
      </p>
    </div>
  </section>

  {{-- Grid of Cards --}}
  <section id="subcategories-grid" class="py-8 bg-gray-100 dark:bg-gray-800 rounded-2xl">
    <div class="container mx-auto px-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
      @foreach($subs as $sub)
        @php
          $route   = data_get($sub, 'route', '');
           $subName      = $isRtl
                     ? data_get($sub, 'name')
                     : data_get($sub, 'en_name');
        //   $subName = data_get($sub, 'name', '');
          $hasSubs = data_get($sub, 'has_sub_categories', false);

          // extract Base64 id & build URL
          if (Str::startsWith($route, '/Categories/')) {
            $encodedId = Str::after($route, '/Categories/');
            $url       = route('subcategories', $encodedId);
          } else {
            $encodedId = Str::after($route, '/Items/');
            $url       = route('products',      $encodedId);
          }


     $filename = data_get($sub, 'image');
  $image = $filename ? ltrim($filename, '/') : null;
    $imageUrl= $filename ? asset( $image)
   : asset('images/placeholder.png');
        @endphp

        <a href="{{ $url }}"
           class="group block bg-white dark:bg-gray-700 rounded-xl shadow transform hover:scale-105 transition-transform duration-300 overflow-hidden"
           data-aos="zoom-in"
           data-aos-delay="{{ $loop->index * 50 }}"
           data-aos-duration="600">

          {{-- image --}}
          <img src="{{ $imageUrl }}"
               alt="{{ $subName }}"
               class="w-full h-35 object-cover group-hover:scale-110 transition-transform duration-400 ease-out">

          <div class="px-4 py-2 flex flex-col">
            {{-- title --}}
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 truncate">
              {{ $subName }}
            </h3>
            {{-- caption --}}
            <p class="mt-1 flex items-center text-sm font-medium truncate {{ $hasSubs ? 'text-gray-500 dark:text-gray-400' : 'text-[#fcc85e]' }}">
              {{ $hasSubs ? __('messages.view cat') : __('messages.view products') }}
              <svg xmlns="http://www.w3.org/2000/svg"
                   class="h-4 w-4 inline-block ml-1 animate-bounce transform {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }} {{ $hasSubs ? 'text-gray-400' : 'text-[#fcc85e]' }}"
                   fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5l7 7-7 7"/>
              </svg>
            </p>
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

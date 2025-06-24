<!DOCTYPE html>
<html
  lang="{{ app()->getLocale() }}"
  dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
  class="font-sans h-full scroll-smooth transition-colors duration-300"
>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', __('messages.site_name'))</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


  <link
    rel="preload"
    href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
    as="style"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
    rel="stylesheet"
  />

  <style>
    :root {
      --tw-font-sans: 'Tajawal', sans-serif;
    }
    * {
      font-family: 'Tajawal', sans-serif !important;
    }
  </style>

  <script>
  (function() {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark' ||
        (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  })();
</script>

  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  @vite(['resources/css/app.css','resources/js/app.js'])
  {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&family=Cairo:wght@200..1000&family=Tajawal:wght@200;300;400;500;700;800;900&family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet"> --}}


  <style>
    /* Loader transitions */
    #page-loader {
      transition: opacity 0.3s ease;
    }
    #page-loader.hidden {
      opacity: 0;
      pointer-events: none;
    }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body class="font-sans flex flex-col min-h-screen antialiased  bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-200 ">
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <!-- Loader -->
  <div
    id="page-loader"
    class="fixed inset-0 z-[99999] flex items-center justify-center
           bg-white/90 dark:bg-gray-900/90 pointer-events-auto
           opacity-100"
  >

    <div class="flex flex-col items-center">
      <svg class="animate-spin h-12 w-12 text-primary dark:text-white mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25 stroke-current" cx="12" cy="12" r="10" stroke-width="4"></circle>
        <path class="opacity-75 fill-current" d="M4 12a8 8 0 018-8v8z"></path>
      </svg>
      <span class="text-gray-600 dark:text-gray-400 font-medium">Loading…</span>
    </div>
  </div>

  @include('partials.navbar')
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <script
  src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
  type="module"
></script>

  <main class="flex-grow overflow-auto pt-8 container mx-auto px-3 pb-12">
    @yield('content')
  </main>

 <footer id="footer" class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300">
  <div class="container mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
    <!-- Logo & Description -->
    <div class="space-y-4">
      <a href="{{ route('home') }}" class="inline-block">
        <img src="{{ asset('images/ChatGPT Image Jun 14, 2025, 04_55_00 PM.png') }}" alt="{{ __('messages.site_name') }}" class="h-10 dark:hidden">
        <img src="{{ asset('images/ChatGPT Image Jun 14, 2025, 04_55_00 PM.png') }}" alt="{{ __('messages.site_name') }}" class="h-10 hidden dark:inline-block">
      </a>
      <p class="text-sm">
        {{ __('messages.hero-footer') }}
      </p>
    </div>

    <!-- Quick Links -->
    <div>
      <h3 class="text-lg font-semibold mb-4">{{ __('messages.Quick Links') }}</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="{{ route('home') }}" class="hover:text-primary transition-colors">{{ __('messages.home') }}</a></li>
        <li><a href="{{ route('categories') }}" class="hover:text-primary transition-colors">{{ __('messages.cats') }}</a></li>
        <li><a href="{{ route('features') }}" class="hover:text-primary transition-colors">{{ __('messages.features') }}</a></li>
        {{-- <li><a href="{{ route('contact') }}" class="hover:text-primary transition-colors">{{ __('Contact') }}</a></li> --}}
      </ul>
    </div>

    <!-- Contact Info -->
    <div>
      <h3 class="text-lg font-semibold mb-4">{{ __('messages.contact us') }}</h3>
      <ul class="space-y-2 text-sm">
        <li>{{ __('messages.Phone') }}: <a href="tel:+1234567890" class="hover:text-primary transition-colors">+1 234 567 890</a></li>
        <li>{{ __('messages.Email') }}: <a href="mailto:info@example.com" class="hover:text-primary transition-colors">info@example.com</a></li>
        <li>{{ __('messages.Address') }}: 1234 Street Name, City, Country</li>
      </ul>
    </div>

    <!-- Social Media -->
    <div>
      <h3 class="text-lg font-semibold mb-4">{{ __('messages.Follow Us') }}</h3>
      <div class="flex space-x-4">
        <a href="#" aria-label="Facebook" class="hover:text-primary transition-colors">
          <!-- Facebook SVG -->
          <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 5 3.657 9.128 8.438 9.88v-6.99H7.898v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.99C18.343 21.128 22 17 22 12z"/></svg>
        </a>
        <a href="#" aria-label="Twitter" class="hover:text-primary transition-colors">
          <!-- Twitter SVG -->
          <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22.162 5.656c-.793.352-1.645.59-2.538.696a4.478 4.478 0 001.963-2.47 8.948 8.948 0 01-2.83 1.083 4.462 4.462 0 00-7.595 4.066A12.65 12.65 0 013.107 4.9a4.46 4.46 0 001.38 5.952 4.43 4.43 0 01-2.02-.558v.056a4.463 4.463 0 003.576 4.374 4.472 4.472 0 01-2.012.076 4.468 4.468 0 004.166 3.099A8.946 8.946 0 012 19.54a12.615 12.615 0 006.84 2.005c8.207 0 12.697-6.803 12.697-12.697 0-.194-.004-.387-.013-.579a9.07 9.07 0 002.228-2.302z"/></svg>
        </a>
        <a href="#" aria-label="LinkedIn" class="hover:text-primary transition-colors">
          <!-- LinkedIn SVG -->
          <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5v-14c0-2.761-2.239-5-5-5zm-11 19h-3v-10h3v10zm-1.5-11.268c-.966 0-1.75-.786-1.75-1.75s.784-1.75 1.75-1.75 1.75.786 1.75 1.75-.784 1.75-1.75 1.75zm13.5 11.268h-3v-5.604c0-1.337-.025-3.057-1.863-3.057-1.864 0-2.151 1.454-2.151 2.958v5.703h-3v-10h2.881v1.367h.041c.401-.762 1.379-1.564 2.838-1.564 3.034 0 3.597 1.998 3.597 4.594v5.603z"/></svg>
        </a>
        <a href="#" aria-label="Instagram" class="hover:text-primary transition-colors">
          <!-- Instagram SVG -->
          <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.334 3.608 1.308.975.975 1.246 2.241 1.308 3.607.058 1.266.069 1.645.069 4.85s-.012 3.584-.07 4.85c-.062 1.366-.334 2.633-1.308 3.608-.975.975-2.241 1.246-3.607 1.308-1.266.058-1.645.069-4.85.069s-3.584-.012-4.85-.07c-1.366-.062-2.633-.334-3.608-1.308-.975-.975-1.246-2.241-1.308-3.607-.058-1.266-.069-1.645-.069-4.85s.012-3.584.07-4.85c.062-1.366.334-2.633 1.308-3.608.975-.975 2.241-1.246 3.607-1.308 1.266-.058 1.645-.069 4.85-.069zm0-2.163c-3.257 0-3.667.012-4.947.071-1.518.067-2.872.35-3.95 1.428s-1.361 2.432-1.428 3.951c-.059 1.28-.071 1.69-.071 4.947s.012 3.667.071 4.947c.067 1.518.35 2.872 1.428 3.95s2.432 1.361 3.951 1.428c1.28.059 1.69.071 4.947.071s3.667-.012 4.947-.071c1.518-.067 2.872-.35 3.95-1.428s1.361-2.432 1.428-3.951c.059-1.28.071-1.69.071-4.947s-.012-3.667-.071-4.947c-.067-1.518-.35-2.872-1.428-3.95s-2.432-1.361-3.951-1.428c-1.28-.059-1.69-.071-4.947-.071z"/><circle cx="12" cy="12" r="3.6"/></svg>
        </a>
      </div>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="border-t border-gray-200 dark:border-gray-700 py-4">
    <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-sm">
      <p class="mb-2 md:mb-0">&copy; {{ date('Y') }} {{ __('messages.site_name') }}. {{ __('All Rights Reserved.') }}</p>
      <a href="#" class="hover:text-primary transition-colors">{{ __('Back to top') }}</a>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
@stack('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const loader = document.getElementById('page-loader');
      loader.classList.add('hidden');
    });

    function showLoader() {
      const loader = document.getElementById('page-loader');
      loader.classList.remove('hidden');
      requestAnimationFrame(() => loader.classList.remove('opacity-0'));
    }

    document.addEventListener('click', function(e) {
      const a = e.target.closest('a');
      if (a && a.origin === window.location.origin && !a.hasAttribute('target') && !a.href.endsWith('#')) {
        const url = new URL(a.href);
        if (url.pathname === window.location.pathname && url.hash) return;
        showLoader();
      }
    });


  </script>
</body>
</html>

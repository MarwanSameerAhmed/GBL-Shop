{{-- resources/views/partials/navbar.blade.php --}}
<script>
  (function() {
    const theme = localStorage.getItem('theme');
    if (
      theme === 'dark' ||
      (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  })();
</script>
@php
  $navItems = [
    [
      'url' => route('home'),
      'label' => __('messages.home'),
      'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'
    ],
    [
      'url' => route('categories'),
      'label' => __('messages.cats'),
      'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>'
    ],
    [
      'url' => route('features'),
      'label' => __('messages.features'),
      'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>'
    ],
    [
      'url' => route('contact'),
      'label' => __('messages.contact'),
      'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>'
    ],
  ];
@endphp

<nav id="navbar"
     class="fixed top-0 inset-x-0 z-50 h-18 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg
            shadow-sm dark:shadow-gray-900/20
            transition-all duration-300 ease-in-out">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 h-full flex items-center justify-between">
    {{-- Logo --}}
    <a href="{{ route('home') }}" class="flex items-center space-x-2 hover:scale-105 transition-transform duration-200">
      <img src="/images/ChatGPT Image 2 يوليو 2025، 12_55_08 م.png" alt="Logo" class="h-25 w-25">
      {{-- <span class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">
        {{ __('messages.site_name') }}
      </span> --}}
    </a>

    {{-- Desktop Links --}}
    <ul class="hidden lg:flex items-center space-x-8">
      @foreach($navItems as $item)
        <li>
          <a href="{{ $item['url'] }}"
             @class([
               'group flex items-center space-x-2 relative py-2 px-3 rounded-lg transition-all duration-300 ease-in-out',
               'bg-primary/10 text-primary dark:bg-accent/10 dark:text-accent shadow-sm' => request()->url() === $item['url'],
               'text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-accent
                hover:bg-gray-50 dark:hover:bg-gray-800/50' => request()->url() !== $item['url']
             ])>
            <span class="transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-6
                        @if(request()->url() === $item['url']) scale-110 @endif">
              {!! $item['icon'] !!}
            </span>
            <span class="font-medium relative">
              {{ $item['label'] }}
              <span class="absolute bottom-0 left-0 h-0.5 bg-primary dark:bg-accent transition-all duration-300
                         @if(request()->url() === $item['url'])
                           w-full opacity-100
                         @else
                           w-0 opacity-0 group-hover:w-full group-hover:opacity-100
                         @endif"></span>
            </span>
            @if(request()->url() === $item['url'])
              <span class="absolute -right-1 top-1/2 -translate-y-1/2 w-2 h-2 rounded-full
                          bg-primary dark:bg-accent opacity-75"></span>
              <span class="absolute -right-1 top-1/2 -translate-y-1/2 w-2 h-2 rounded-full
                          bg-primary dark:bg-accent animate-ping"></span>
            @endif
          </a>
        </li>
      @endforeach
    </ul>

    {{-- Actions --}}
    <div class="hidden lg:flex items-center space-x-4">
      {{-- Language Switcher --}}
      <a href="{{ route('locale.switch', app()->getLocale()=='ar' ? 'en' : 'ar') }}"
         class="group flex items-center space-x-2 px-4 py-2 bg-gray-50 dark:bg-gray-800
                text-gray-700 dark:text-gray-200 rounded-lg
                hover:bg-gray-100 hover:text-black dark:hover:bg-accent
                active:scale-95 focus:ring-2 focus:ring-primary/50
                transition-all duration-300 ease-out font-medium relative overflow-hidden">
        <svg class="w-5 h-5 relative transition-transform duration-300 group-hover:rotate-12"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
        </svg>
        <span class="relative">{{ app()->getLocale()=='ar' ? __('messages.lang_en') : __('messages.lang_ar') }}</span>
      </a>

      {{-- Theme Toggle --}}
      <button id="theme-toggle"
              class="group p-3 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200
                     hover:bg-gray-100 dark:hover:bg-gray-700
                     active:scale-95 focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700
                     transition-all duration-300 ease-out">
        {{-- Moon icon for light mode --}}
        <svg class="w-6 h-6 dark:hidden transition-transform duration-300 group-hover:rotate-[360deg]"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
        </svg>
        {{-- Sun icon for dark mode --}}
        <svg class="w-6 h-6 hidden dark:block transition-transform duration-300 group-hover:rotate-[360deg]"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
      </button>
    </div>

    {{-- Mobile Button --}}
    <button id="mobile-menu-button"
            class="lg:hidden p-2 rounded-lg bg-gray-50 dark:bg-gray-800
                   hover:bg-gray-100 dark:hover:bg-gray-700
                   transition-all duration-200">
      <svg class="w-6 h-6 text-gray-700 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>
</nav>

{{-- Mobile Menu --}}
<div id="mobile-menu"
     class="fixed top-0 left-0 h-full w-64 z-50 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm
            transform -translate-x-full transition-all duration-300 ease-in-out shadow-xl lg:hidden">
  <div class="px-6 py-8 space-y-6">
    @foreach($navItems as $item)
      <a href="{{ $item['url'] }}"
         @class([
           'group flex items-center space-x-3 p-3 rounded-lg transition-all duration-300 ease-in-out relative',
           'bg-primary/10 text-primary shadow-sm dark:bg-accent/10 dark:text-accent' => request()->url() === $item['url'],
           'text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-accent
            hover:bg-gray-50 dark:hover:bg-gray-800/50 transform hover:translate-x-2' => request()->url() !== $item['url']
         ])>
        <span class="transform transition-all duration-300
                     @if(request()->url() === $item['url']) scale-110 @else group-hover:scale-110 group-hover:rotate-6 @endif">
          {!! $item['icon'] !!}
        </span>
        <span class="font-medium">{{ $item['label'] }}</span>
        @if(request()->url() === $item['url'])
          <span class="absolute right-2 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full
                       bg-primary dark:bg-accent opacity-75"></span>
          <span class="absolute right-2 top-1/2 -translate-y-1/2 w-1.5 h-1.5 rounded-full
                       bg-primary dark:bg-accent animate-ping"></span>
        @endif
      </a>
    @endforeach

    <hr class="border-gray-200 dark:border-gray-700">

    {{-- Language Switcher Mobile --}}
    <a href="{{ route('locale.switch', app()->getLocale()=='ar' ? 'en' : 'ar') }}"
       class="group flex items-center space-x-2 px-4 py-3 bg-gray-50 dark:bg-gray-800
              text-gray-700 dark:text-gray-200 rounded-lg
              hover:bg-primary hover:text-white dark:hover:bg-accent
              active:scale-95 transition-all duration-300 ease-out font-medium">
      <svg class="w-5 h-5 relative transition-transform duration-300 group-hover:rotate-12"
           fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
      </svg>
      <span class="relative">{{ app()->getLocale()=='ar' ? __('messages.lang_en') : __('messages.lang_ar') }}</span>
    </a>

    {{-- Theme Toggle Mobile --}}
    <button id="theme-toggle-mobile"
            class="group w-full flex items-center space-x-2 px-4 py-3 rounded-lg
                   bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-200
                   hover:bg-gray-100 dark:hover:bg-gray-700 active:scale-95
                   transition-all duration-300 ease-out">
      {{-- Moon icon for light mode --}}
      <svg class="w-6 h-6 dark:hidden transition-transform duration-300 group-hover:rotate-[360deg]"
           fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
      </svg>
      {{-- Sun icon for dark mode --}}
      <svg class="w-6 h-6 hidden dark:block transition-transform duration-300 group-hover:rotate-[360deg]"
           fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
      </svg>
      <span class="font-medium">{{ __('messages.dark_mode') }}</span>
    </button>
  </div>
</div>

{{-- Scripts --}}
<script>
  const navbar     = document.getElementById('navbar');
  const mobileBtn  = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const themeBtn   = document.getElementById('theme-toggle');
  const themeBtnM  = document.getElementById('theme-toggle-mobile');

  // Shrink navbar on scroll
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('shadow-xl', window.scrollY > 50);
  });

  // Toggle mobile menu & click‑outside hide
  mobileBtn.addEventListener('click', e => {
    e.stopPropagation();
    mobileMenu.classList.toggle('-translate-x-full');
  });
  mobileMenu.addEventListener('click', e => e.stopPropagation());
  document.addEventListener('click', () => mobileMenu.classList.add('-translate-x-full'));

  // Dark/Light toggle with persistence
  [themeBtn, themeBtnM].forEach(btn =>
    btn.addEventListener('click', () => {
      const html = document.documentElement;
      if (html.classList.toggle('dark')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
    })
  );
</script>








{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@push('styles')
  <!-- AOS CSS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
  <style>
    /* floating animation */
    @keyframes floating {
      0%, 100% { transform: translateY(0); }
      50%      { transform: translateY(-6px); }
    }
    .animate-floating {
      animation: floating 3s ease-in-out infinite;
    }

    /* background gradient shift */
    @keyframes bg-shift {
      0%   { background-position: 0% 50%; }
      50%  { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .bg-glass-gradient {
      background: linear-gradient(
        135deg,
        rgba(255,255,255,0.15),
        rgba(255,255,255,0.05)
      );
      background-size: 400% 400%;
      animation: bg-shift 8s ease infinite;
    }
  </style>
@endpush

@section('title', __('messages.home'))

@section('content')
  {{-- Hero full‑width --}}
  <section
    id="hero"
    class="relative min-h-screen lg:h-screen overflow-visible bg-white dark:bg-gray-900"
  >
    <div class="absolute inset-0"></div>
    <div
      class="relative z-10 max-w-7xl mx-auto px-6 pt-32 lg:pt-50 pb-6"
    >
      <div class="flex flex-col md:flex-row items-start gap-8">
        <div data-aos="fade-right" class="text-black dark:text-white relative z-20">
          <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
            @php
            $heroText = __('messages.hero-mainPage');
            $lastWord = strrchr($heroText, ' ');
            $firstPart = substr($heroText, 0, -strlen($lastWord));
          @endphp
          {!! $firstPart !!}
          <span style="color: #fcc85e;">{!! $lastWord !!}</span>
          </h1>
          <p class="text-lg md:text-xl mb-8 opacity-90 text-gray-800 dark:text-gray-300">
            {{ __('messages.hero-mainPage-sub') }}
          </p>
          <a
            href="{{ route('categories') }}"
            class="inline-flex items-center bg-[#fcc85e] text-gray-900 font-semibold py-3 px-10 rounded-full shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl hover:bg-[#fdd17a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fcc85e]"
          >
            {{ __('messages.cats') }}
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="ml-3 h-5 w-5 text-gray-900 animate-bounce transform {{ app()->getLocale() === 'ar' ? 'rotate-180' : '' }}"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 12h16m-6-6l6 6-6 6"/>
            </svg>
          </a>
        </div>

        <div data-aos="zoom-in" class="w-full md:w-1/2 -mt-16 flex justify-center">
          @php
            $lottie = "https://lottie.host/1e90c844-ec0c-4fab-88de-37132cc1794c/alSe2BEbXj.lottie";
          @endphp

          <dotlottie-player
            src="{{ $lottie }}"
            background="transparent"
            speed="1"
            style="width: 450px; height: 450px;"
            loop
            autoplay
          ></dotlottie-player>
        </div>
      </div>
    </div>
  </section>

  @include('partials.latest-products')
@endsection

@push('scripts')
  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ once: true });
  </script>

  <!-- VanillaTilt JS -->
  <script src="https://cdn.jsdelivr.net/npm/vanilla-tilt@1.7.2/dist/vanilla-tilt.min.js"></script>
  <script>
    VanillaTilt.init(document.querySelectorAll(".tilt-effect"), {
      max: 12,
      speed: 400,
      glare: true,
      "max-glare": 0.15
    });
  </script>

  {{-- <!-- Logo slider JS -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const slider    = document.getElementById('logo-slider');
      const container = document.getElementById('slider-container');
      const total     = slider.children.length;
      let idx         = 0;

      setInterval(() => {
        idx = (idx + 1) % total;
        slider.style.transform = `translateX(-${idx * container.clientWidth}px)`;
      }, 3000);
    });
  </script> --}}
@endpush

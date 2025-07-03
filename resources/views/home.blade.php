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
<style>
  @keyframes shimmer {
    0% {
      transform: translateX(-100%) rotate(10deg);
    }
    100% {
      transform: translateX(100%) rotate(10deg);
    }
  }

  .shimmer-btn::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 200%;
    height: 100%;
    background: linear-gradient(110deg, rgba(255, 255, 255, 0) 40%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0) 60%);
    animation: shimmer 4s infinite;
    animation-delay: 2s;
  }

  .shimmer-text::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 200%;
    height: 100%;
    background: linear-gradient(110deg, rgba(255, 255, 255, 0) 40%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0) 60%);
    animation: shimmer 4s infinite;
    animation-delay: 2.5s;
  }

  @keyframes subtle-pulse-right {
    0%, 100% {
      transform: translateX(0);
    }
    50% {
      transform: translateX(3px);
    }
  }

  .animate-pulse-right {
    animation: subtle-pulse-right 2.5s ease-in-out infinite;
  }
</style>
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
          <h1 class="text-5xl md:text-6xl font-extrabold mb-4 leading-tight max-w-2xl">
            @php
                $heroText = __('messages.hero-mainPage');
                $lastWord = strrchr($heroText, ' ');
                $firstPart = substr($heroText, 0, -strlen($lastWord));
            @endphp
            {!! $firstPart !!}
            <span class="shimmer-text relative inline-block overflow-hidden" style="color: #fcc85e; vertical-align: text-bottom;">{!! trim($lastWord) !!}</span>
          </h1>
          <p class="text-lg md:text-xl mb-8 opacity-90 text-gray-800 dark:text-gray-300 max-w-xl">
            {{ __('messages.hero-mainPage-sub') }}
          </p>
          <a
            href="{{ route('categories') }}"
            class="shimmer-btn group relative overflow-hidden inline-flex items-center justify-center bg-[#fcc85e] text-gray-900 font-semibold py-3 px-10 rounded-full shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl hover:bg-[#fdd17a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fcc85e]"
          >
            <span>{{ __('messages.cats') }}</span>
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="ml-2 h-5 w-5 text-gray-900 animate-pulse-right rtl:rotate-180"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
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

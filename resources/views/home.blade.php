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
 @push('styles')
<style>
  @keyframes gradient-animation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .hero-animated-bg {
    background: linear-gradient(-45deg, #fdfcfb, #fde8d6, #fce1c4, #fcc85e);
    background-size: 400% 400%;
    animation: gradient-animation 15s ease infinite;
  }

  .dark .hero-animated-bg {
    background: linear-gradient(-45deg, #0f0c29, #302b63, #24243e);
    background-size: 400% 400%;
    animation: gradient-animation 15s ease infinite;
  }

  .shimmer-text-enhanced {
    -webkit-mask-image: linear-gradient(-75deg, rgba(0,0,0,.6) 30%, #000 50%, rgba(0,0,0,.6) 70%);
    -webkit-mask-size: 200%;
    animation: shimmer 2.5s infinite;
  }

  @keyframes shimmer {
    0% { -webkit-mask-position: 150%; }
    100% { -webkit-mask-position: -50%; }
  }

  .text-glow {
    text-shadow: 0 0 8px rgba(252, 200, 94, 0.5), 0 0 20px rgba(252, 200, 94, 0.3);
  }
  
  .dark .text-glow {
    text-shadow: 0 0 10px rgba(252, 200, 94, 0.6), 0 0 25px rgba(252, 200, 94, 0.4);
  }

  .particles {
    position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 1;
  }

  .particle {
    position: absolute;
    background-color: rgba(252, 200, 94, 0.5);
    border-radius: 50%;
    opacity: 0;
    animation: rise 10s infinite linear;
  }

  .dark .particle {
    background-color: rgba(255, 255, 255, 0.1);
  }

  @keyframes rise {
    0% { transform: translateY(100vh) scale(0.5); opacity: 1; }
    100% { transform: translateY(-10vh) scale(1.2); opacity: 0; }
  }
</style>
@endpush

 {{-- Hero full‑width --}}
<section
  id="hero"
  class="relative min-h-screen lg:h-screen overflow-hidden hero-animated-bg"
>
  <div class="particles"></div>
  <div class="absolute inset-0 bg-white/30 dark:bg-gray-900/40 backdrop-blur-sm"></div>
  <div
    class="relative z-10 max-w-7xl mx-auto px-6 flex items-center h-full pt-32 lg:pt-0 pb-6"
  >
    <div class="flex flex-col md:flex-row items-center md:items-start gap-y-8 md:gap-x-8">
      <div data-aos="fade-right" class="w-full md:w-1/2 text-center md:text-left text-black dark:text-white relative z-20">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-4 leading-tight max-w-2xl mx-auto md:mx-0 text-glow">
          @php
              $heroText = __('messages.hero-mainPage');
              $lastWord = strrchr($heroText, ' ');
              $firstPart = substr($heroText, 0, -strlen($lastWord));
          @endphp
          {!! $firstPart !!}<br>
          <span class="shimmer-text-enhanced relative inline-block overflow-hidden" style="color: #fcc85e;">{!! trim($lastWord) !!}</span>
        </h1>
        <p class="text-lg md:text-xl mb-8 opacity-90 text-gray-800 dark:text-gray-300 max-w-xl mx-auto md:mx-0">
          {{ __('messages.hero-mainPage-sub') }}
        </p>
        <a
          href="{{ route('categories') }}"
          class="shimmer-btn group relative overflow-hidden inline-flex items-center justify-center bg-[#fcc85e] text-gray-900 font-semibold py-3 px-10 rounded-full shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:bg-[#fdd17a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fcc85e] text-glow"
        >
          <span>{{ __('messages.cats') }}</span>
          <svg xmlns="http://www.w3.org/2000/svg"
               class="ml-2 h-5 w-5 text-gray-900 transition-transform duration-300 group-hover:translate-x-1 rtl:rotate-180"
               fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
          </svg>
        </a>
      </div>

      <div data-aos="zoom-in" class="w-full md:w-1/2 flex justify-center relative z-20">
        @php
          $lottie = "https://lottie.host/1e90c844-ec0c-4fab-88de-37132cc1794c/alSe2BEbXj.lottie";
        @endphp

        <dotlottie-player
          src="{{ $lottie }}"
          background="transparent"
          speed="1"
          class="w-full max-w-[300px] sm:max-w-[450px] h-auto drop-shadow-2xl"
          loop
          autoplay
        ></dotlottie-player>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const particleContainer = document.querySelector('.particles');
  if (particleContainer) {
    const numberOfParticles = 20;
    for (let i = 0; i < numberOfParticles; i++) {
      let particle = document.createElement('div');
      particle.classList.add('particle');
      
      const size = Math.random() * 7 + 3; // size between 3px and 10px
      particle.style.width = `${size}px`;
      particle.style.height = `${size}px`;
      
      particle.style.left = `${Math.random() * 100}%`;
      
      const animationDuration = Math.random() * 15 + 10; // duration between 10s and 25s
      const animationDelay = Math.random() * 10; // delay up to 10s
      
      particle.style.animationDuration = `${animationDuration}s`;
      particle.style.animationDelay = `-${animationDelay}s`;
      
      particleContainer.appendChild(particle);
    }
  }
});
</script>
@endpush

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

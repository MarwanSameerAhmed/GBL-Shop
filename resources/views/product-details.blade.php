{{-- resources/views/product-detail.blade.php --}}
@extends('layouts.app')

@php




    $locale     = app()->getLocale();
    $isRtl      = $locale === 'ar';
    $nameField  = $isRtl ? 'name'               : 'en_name';
    $shortField = $isRtl ? 'short_description'  : 'en_short_description';
    $descField  = $isRtl ? 'description'        : 'en_description';

    // جلب الصور
     if (! empty($product['images']) && is_array($product['images'])) {
    $allImages = $product['images'];
} elseif (! empty($product['image'])) {
    $allImages = [ $product['image'] ];
} else {
    $allImages = [];
}

$mainImage = isset($allImages[0])
    ? asset(ltrim($allImages[0], '/'))
    : asset('images/placeholder.png');

$thumbs = array_map(fn($img) => asset(ltrim($img, '/')), array_slice($allImages, 1));

 $invoice  = "═══════ 🧾 *فاتورة نجمي* ═══════%0A%0A";
    $invoice .= "*المنتج:*%0A`" . data_get($product, $nameField, '-') . "`%0A%0A";
    if (isset($product['price']) && $product['price'] >= 0) {
        $invoice .= "*السعر:*%0A`$" . number_format($product['price'], 2) . "`%0A%0A";
    }
    if ($desc = data_get($product, $shortField)) {
        $invoice .= "*الوصف:*%0A`" . $desc . "`%0A%0A";
    }
    $invoice .= "*الكمية:* `1`%0A";
    $invoice .= "───────────────────%0A";
    $invoice .= "*الإجمالي:* `$" . (isset($product['price']) ? number_format($product['price'], 2) : '—') . "`%0A";
    $invoice .= "*التاريخ:* `" . now()->format('Y-m-d') . "`%0A%0A";
    $invoice .= "══════════════════════════%0A";
    $invoice .= "✨ *شكرًا لثقتكم بنا* ✨";
@endphp

@section('title', data_get($product, $nameField, __('messages.products')) )

@section('content')
  <div class="mt-24"></div>

 <nav aria-label="Breadcrumb"
     class="bg-gray-50 dark:bg-gray-800 p-4 rounded-md shadow-sm mb-6 mx-6 md:mx-auto max-w-7xl">
  <ol class="inline-flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
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
        {{ __('messages.cats') }}
      </a>
    </li>

    {{-- Separator --}}
    <li class="animate-pulse">/</li>


      <li class="flex items-center space-x-1 group">
      <svg xmlns="http://www.w3.org/2000/svg"
           class="w-4 h-4 text-gray-500 group-hover:text-primary transition-colors duration-200 group-hover:animate-bounce"
           fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M16 11V6a4 4 0 00-8 0v5M5 11h14l1 10H4l1-10z" />
      </svg>
    <a href="{{ url()->previous() }}" class="hover:text-primary dark:hover:text-accent transition">{{ __('messages.products') }}</a></li>

    {{-- Separator --}}
    <li class="animate-pulse">/</li>


 <li class="font-semibold text-gray-800 dark:text-gray-200">
        {{ data_get($product, $nameField, '-') }}
      </li>
  </ol>
</nav>

  <section class="py-12">
    <div class="container mx-auto px-6 lg:flex lg:gap-12 {{ $isRtl ? 'lg:flex-row-reverse text-right' : 'lg:flex-row text-left' }}"
         data-aos="fade-up"
         x-data='{"main":"{{ $mainImage }}","thumbs":@json($thumbs)}'>

     {{-- Image Gallery --}}
<div class="lg:w-1/2 mb-8 lg:mb-0">
  <img id="mainImage" :src="main" alt="{{ data_get($product, $nameField) }}"
       class="w-full rounded-xl shadow-2xl object-cover h-96 border border-gray-300">

  @if(count($thumbs))
    <div class="relative mt-4">
  <div class="swiper myThumbsSwiper">
    <div class="swiper-wrapper">
      <template x-for="(img, i) in thumbs" :key="i">
        <div class="swiper-slide">
          <button @click="main = img"
                  :class="{ 'ring-2 ring-offset-2 ring-offset-gray-100 dark:ring-offset-gray-800 ring-primary': main === img }"
                  class="block w-full h-24 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-accent transition-all duration-300 focus:outline-none">
            <img :src="img" class="w-full h-full object-cover" alt="Product thumbnail">
          </button>
        </div>
      </template>
    </div>

    <!-- Navigation Arrows -->
    <div class="swiper-button-next group !absolute !top-1/2 !-translate-y-1/2 !right-0 z-10">
        <div class="bg-white/70 dark:bg-gray-900/70 shadow-lg rounded-full p-1.5 transition-all duration-300 group-hover:scale-110 group-hover:bg-white dark:group-hover:bg-gray-900 backdrop-blur-sm">
            <svg class="w-5 h-5 text-primary dark:text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
        </div>
    </div>
    <div class="swiper-button-prev group !absolute !top-1/2 !-translate-y-1/2 !left-0 z-10">
        <div class="bg-white/70 dark:bg-gray-900/70 shadow-lg rounded-full p-1.5 transition-all duration-300 group-hover:scale-110 group-hover:bg-white dark:group-hover:bg-gray-900 backdrop-blur-sm">
            <svg class="w-5 h-5 text-primary dark:text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
        </div>
    </div>
  </div>
</div>
  @endif
</div>

      {{-- Details Panel --}}
      <div class="lg:w-1/2 space-y-6">

        {{-- Title --}}
        <h1 class="text-4xl font-bold mb-2">
          {{ data_get($product, $nameField, '-') }}
        </h1>

        {{-- Short Description (اختياري) --}}
        @if(data_get($product, $shortField))
          <p class="text-lg text-gray-700 dark:text-gray-300">
            {{ data_get($product, $shortField) }}
          </p>
        @endif

        {{-- Price --}}
        @if(isset($product['price']))
          <p class="text-2xl font-semibold text-primary mb-4">
            @if($product['price'] >= 0)
              ${{ number_format($product['price'], 2) }}
            @else
              {{ __('Contact for price') }}
            @endif
          </p>
        @endif

        {{-- WhatsApp Contact Button --}}
<a href="https://wa.me/{{ config('services.whatsapp.number') }}?text={{ urlencode($invoice) }}"           target="_blank"
           class="inline-flex items-center px-6 py-3 bg-green-500 text-white font-semibold rounded-full shadow-lg hover:bg-green-600 transition">
          <svg class="h-6 w-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20.52 3.478A11.787 11.787 0 0012.055.25a11.98 11.98 0 00-10.707 17.553L.75 23.25l5.72-1.5A11.947 11.947 0 0012.055 24C18.74 24 24 18.74 24 12.055c0-3.218-1.26-6.245-3.52-8.577zM12.055 21.5a9.443 9.443 0 01-4.87-1.333l-.347-.205-3.395.89.906-3.308-.222-.361a9.44 9.44 0 0116.385-3.852 9.445 9.445 0 01-7.456 14.269zm5.354-7.774c-.295-.147-1.742-.862-2.014-.958-.271-.098-.469-.147-.667.147s-.765.958-.939 1.157c-.173.2-.347.224-.642.075-.295-.147-1.246-.459-2.374-1.46-.877-.78-1.469-1.744-1.643-2.039-.173-.295-.018-.455.13-.602.134-.133.295-.347.443-.52.147-.173.196-.295.295-.49.098-.196.049-.367-.025-.514-.075-.147-.667-1.612-.915-2.206-.242-.579-.487-.5-.667-.51l-.571-.01c-.195 0-.51.074-.778.367-.271.295-1.036 1.013-1.036 2.471s1.06 2.865 1.206 3.064c.147.196 2.08 3.178 5.048 4.457.706.305 1.256.487 1.687.624.709.226 1.354.195 1.866.118.569-.085 1.742-.712 1.988-1.401.245-.69.245-1.282.171-1.401-.074-.118-.271-.196-.566-.343z"/>
          </svg>
          {{ __('messages.Contact via WhatsApp') }}
        </a>

        {{-- Full Description Section --}}
        <div class="mt-8">
          <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
            {{ __('messages.Description') }}
          </h2>
          <div class="prose prose-lg dark:prose-dark">
            {!! nl2br(e(data_get($product, $descField, '-'))) !!}
          </div>
        </div>

      </div>
    </div>
  </section>
  <script>
  document.addEventListener('alpine:init', () => {
    Alpine.effect(() => {
      setTimeout(() => {
        if (document.querySelector('.myThumbsSwiper')) {
          new Swiper('.myThumbsSwiper', {
            loop: false,
            spaceBetween: 12,
            slidesPerView: 3.5,
            freeMode: true,
            watchSlidesProgress: true,
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
            breakpoints: {
              640: {
                slidesPerView: 4.5,
              },
              1024: {
                slidesPerView: 5.5,
              },
            }
          });
        }
      }, 300);
    });
  });
</script>

@endsection



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
        <div class="swiper-slide !w-auto !m-0 !p-1">
          <button @click="main = img"
                  :class="{ 'ring-4 ring-primary border-primary': main === img }"
                  class="w-28 h-28 rounded-xl overflow-hidden border-2 border-gray-300 hover:border-primary transition duration-200">
            <img :src="img" class="w-full h-full object-cover">
          </button>
        </div>
      </template>
    </div>

    <!-- الأسهم -->
    <div class="swiper-button-prev text-primary"></div>
    <div class="swiper-button-next text-primary"></div>
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
          {{ __('messages.Contact via WhatsApp') }}
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="currentColor" viewBox="0 0 16 16">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.1-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
          </svg>
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
            slidesPerView: 3, // نعرض 3 صور في الشاشات الصغيرة
            spaceBetween: 8,
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
            breakpoints: {
              // للشاشات الأكبر من 1024 بكسل، نعرض 5
              1024: { 
                slidesPerView: 5
              },
            }
          });
        }
      }, 300);
    });
  });
</script>

@endsection



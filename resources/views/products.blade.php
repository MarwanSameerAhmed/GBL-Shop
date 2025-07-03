{{-- resources/views/products.blade.php --}}
@extends('layouts.app')
@section('title', __('messages.products'))

@php
  use Illuminate\Support\Str;
  $isRtl = app()->getLocale() === 'ar';
@endphp

@section('content')
  {{-- Spacer to offset fixed navbar --}}
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

 <li class="flex items-center space-x-1 group">
      <svg xmlns="http://www.w3.org/2000/svg"
           class="w-4 h-4 text-gray-500 group-hover:text-primary transition-colors duration-200 group-hover:animate-bounce"
           fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
           d="M3 3h7v7H3V3zM14 3h7v7h-7V3zM14 14h7v7h-7v-7zM3 14h7v7H3v-7z" />
      </svg>
    <a href="{{ url()->previous() }}" class="hover:text-primary dark:hover:text-accent transition">{{ __('messages.subcategories') }}</a></li>
      {{-- Separator --}}
    <li class="animate-pulse">/</li>


    {{-- product (active) --}}
    <li class="flex items-center space-x-1 group">
      <svg xmlns="http://www.w3.org/2000/svg"
           class="w-4 h-4 text-gray-400 transition-colors duration-200"
           fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 8h14l-1 12H6L5 8z M8 8V6a4 4 0 018 0v2"/>
 />
      </svg>
      <span class="font-semibold text-gray-800 dark:text-gray-200">
        {{ __('messages.products') }}
      </span>
    </li>
  </ol>
</nav>

  {{-- Header & Search --}}
  <section class="py-8 bg-white dark:bg-gray-900 rounded-lg mb-6 mx-6 md:mx-auto max-w-7xl">
    <div class="container mx-auto px-6 text-center" data-aos="fade-down">
      <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
        {{ __('messages.products') }}
      </h1>
      <p class="text-gray-600 dark:text-gray-400 mb-4">
        {{ __('messages.Explore our selection of premium products') }}
      </p>
      {{-- Search Bar --}}
      <div class="max-w-md mx-auto" data-aos="fade-up">
        <div class="relative">
          <input
            type="text"
            id="product-search"
            placeholder="{{ __('messages.searchProduct') }}"
            class="w-full bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400
                   border-2 border-gray-300 dark:border-gray-600 rounded-full py-3
                   {{ $isRtl ? 'pl-12 pr-6 text-right' : 'pl-6 pr-12 text-left' }}
                   focus:outline-none focus:ring-4 focus:ring-primary/40 focus:shadow-lg transition-all duration-300"
          />
          <span class="absolute inset-y-0 {{ $isRtl ? 'left-0 pl-4' : 'right-0 pr-4' }} flex items-center text-gray-500 dark:text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </span>
        </div>
      </div>
    </div>
  </section>

  {{-- Products List --}}
  <section class="mb-12 mx-6 md:mx-auto max-w-7xl">

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse($products as $product)
      @php
        $name      = $isRtl
                     ? data_get($product, 'name')
                     : data_get($product, 'en_name');
        $shortDesc = $isRtl
                     ? data_get($product, 'short_description')
                     : data_get($product, 'en_short_description');
        $route     = data_get($product, 'route', '');
        $prodId    = Str::after($route, '/Item/');

    $path = data_get($product, 'image');

    $pat = $path ? ltrim($path, '/') : null;

    $thumb = $path
        ? asset($pat)
        : asset('images/placeholder.png');
      @endphp

      <div
        class="
          group
          flex
          {{ $isRtl ? 'text-right' : 'text-left' }}
          bg-white dark:bg-gray-800
          rounded-2xl
          shadow-lg
          overflow-hidden
          w-full
          transition-transform duration-300 hover:scale-105
        "
      >
        {{-- الصورة --}}
        <div class="w-32 h-full flex-shrink-0">
          <img
            src="{{ $thumb }}"
            alt="{{ $name }}"
            onerror="this.onerror=null; this.src='{{ asset('images\\ChatGPT Image Jun 14, 2025, 04_55_00 PM.png') }}';"
            class="w-full h-full object-cover"
          />
        </div>

        {{-- المحتوى --}}
        <div class="flex-1 p-3 sm:p-4">
          <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-gray-100 mb-1">
            {{ $name }}
          </h3>
          <p class="text-gray-700 dark:text-gray-300 line-clamp-2 text-xs sm:text-sm">
            {{ $shortDesc }}
          </p>

          {{-- الزر --}}
          <a
            href="{{ route('productDetails', $prodId) }}"
            class="inline-block mt-3 px-2.5 py-1 bg-[#fcc85e] dark:bg-[#fcc85e] text-white text-xs font-medium rounded-full hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors"
          >
            {{ __('messages.View More') }}
          </a>
        </div>
      </div>
    @empty
      <p class="text-center text-gray-500">{{ __('messages.no product') }}</p>
    @endforelse
  </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const searchInput     = document.getElementById('product-search');
  const productsGrid    = document.querySelector('.grid');
  const originalContent = productsGrid.innerHTML;
  const lang            = document.documentElement.lang || 'ar';

  // زر "عرض الكل"
  const resetBtn = document.createElement('button');
  resetBtn.textContent = '{{ __("messages.view all") }}';
  resetBtn.className = `
    mt-6 mx-auto block text-sm font-medium
    bg-gray-700 text-white rounded-full px-4 py-2
    hover:bg-gray-900 transition-all
  `;
  resetBtn.style.display = 'none';
  resetBtn.onclick = () => {
    searchInput.value        = '';
    productsGrid.innerHTML   = originalContent;
    resetBtn.style.display   = 'none';
  };
  productsGrid.parentElement.appendChild(resetBtn);


  function createProductCard(product) {

    if (!product || !product.route) {
      console.error('{{ __("messages.product error") }}', product);
      return '';
    }

    const name  = lang === 'ar' ? product.name : product.en_name;
    const desc  = lang === 'ar' ? product.short_description : product.en_short_description;
    const id    = product.route.split('/').pop();

    const assetBaseUrl = '{{ rtrim(asset('/'), '/') }}';
    const initialPlaceholder = `{{ asset('images/placeholder.png') }}`;
    const errorPlaceholder = `{{ asset('images/ChatGPT Image Jun 14, 2025, 04_55_00 PM.png') }}`.replace(/\\/g, '/');

    let imageUrl;
    const path = product.image;

    if (path && path.trim() !== '') {
        // Check if the path is already a full URL. If so, use it directly.
        // Otherwise, construct the full URL from the relative path.
        if (path.startsWith('http://') || path.startsWith('https://')) {
            imageUrl = path;
        } else {
            const pat = path.startsWith('/') ? path.substring(1) : path;
            imageUrl = `${assetBaseUrl}/${pat}`;
        }
    } else {
        // Use the initial placeholder if no image is defined.
        imageUrl = initialPlaceholder;
    }

    const onErrorLogic = `this.onerror=null; this.src='${errorPlaceholder}';`;

    return `
      <div class="group flex {{ $isRtl ? 'text-right' : 'text-left' }}
                  bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden w-full
                  transition-transform duration-300 hover:scale-105">
        <div class="w-32 h-full flex-shrink-0">
          <img src="${imageUrl}" alt="${name}"
               onerror="${onErrorLogic}"
               class="w-full h-full object-cover" />
        </div>
        <div class="flex-1 p-3 sm:p-4">
          <h3 class="text-base sm:text-lg font-bold text-gray-900 dark:text-gray-100 mb-1">${name}</h3>
          <p class="text-gray-700 dark:text-gray-300 line-clamp-2 text-xs sm:text-sm">${desc}</p>
          <a href="/Item/${id}"
             class="inline-block mt-3 px-2.5 py-1 bg-blue-600 dark:bg-blue-500 text-white text-xs font-medium rounded-full hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors">
            {{ __('messages.View More') }}
          </a>
        </div>
      </div>`;
  }

  function debounce(func, delay) {
    let timeout;
    return function(...args) {
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(this, args), delay);
    };
  }

  async function handleSearch(query) {
    if (query.length < 2) {
      productsGrid.innerHTML = originalContent;
      resetBtn.style.display = 'none';
      return;
    }

    productsGrid.innerHTML = `<p class="text-center text-gray-500 dark:text-gray-400 py-10">{{ __("messages.searching") }}</p>`;
    resetBtn.style.display = 'none';

    try {
      const url = `{{ route('api.search') }}?name=${encodeURIComponent(query)}&lang=${lang}`;
      const response = await fetch(url);

      if (!response.ok) {
        throw new Error('فشل طلب البحث من الخادم.');
      }

      const data = await response.json();
      productsGrid.innerHTML = ''; // إفراغ الشبكة قبل إضافة النتائج
      resetBtn.style.display = 'block';

      const products = Array.isArray(data) ? data : (data ? [data] : []);

      if (products.length === 0) {
        productsGrid.innerHTML = `<p class="text-center text-red-500 font-semibold mt-6">{{ __('لا توجد نتائج مطابقة.') }}</p>`;
        return;
      }

      products.forEach(product => {
        const cardHtml = createProductCard(product);
        if (cardHtml) {
          productsGrid.insertAdjacentHTML('beforeend', cardHtml);
        }
      });

    } catch (error) {
      console.error('Search error:', error);
      productsGrid.innerHTML = `<p class="text-center text-red-500 font-semibold mt-6">حدث خطأ أثناء جلب المنتجات.</p>`;
      resetBtn.style.display = 'block';
    }
  }

  // ربط البحث بالحدث مع تطبيق Debounce
  searchInput.addEventListener('input', debounce((e) => {
    handleSearch(e.target.value.trim());
  }, 300)); // تأخير 300 ميلي ثانية
});
</script>
@endpush



@endsection

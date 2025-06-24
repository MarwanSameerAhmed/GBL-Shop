@php
  use Illuminate\Support\Str;
@endphp

<section id="latest-products" class="py-12 bg-white dark:bg-gray-900 rounded-lg mb-8">
  <div class="container mx-auto px-6">
    {{-- === Header === --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
      <div class="flex items-center space-x-3">
        {{-- Sparkles Icon --}}
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-8 w-8 text-indigo-500 animate-pulse"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
          <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l.35 1.08a1 1 0 00.95.69h1.137c.969 0 1.371 1.24.588 1.81l-.92.67a1 1 0 00-.364 1.118l.35 1.08c.3.921-.755 1.688-1.54 1.118l-.92-.67a1 1 0 00-1.176 0l-.92.67c-.785.57-1.84-.197-1.54-1.118l.35-1.08a1 1 0 00-.364-1.118l-.92-.67c-.783-.57-.38-1.81.588-1.81h1.137a1 1 0 00.95-.69l.35-1.08zM17 12.588l.962-.005a1 1 0 00.472-1.812l-.825-.56a1 1 0 01-.364-1.118l.35-1.08c.3-.921-.755-1.688-1.54-1.118L15.1 7.73a1 1 0 01-1.176 0l-.92-.67c-.785-.57-1.84.197-1.54 1.118l.35 1.08a1 1 0 01-.364 1.118l-.92.67c-.783.57-.38 1.81.588 1.81h.962" />
        </svg>

        {{-- Gradient Title --}}
        <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
          {{ __('messages.latest_products') }}
        </h2>
      </div>

      {{-- Decorative underline --}}
      <div class="hidden sm:block flex-grow border-t-2 border-indigo-100 dark:border-indigo-800 mx-6"></div>

      {{-- Sub‑heading --}}
      <p class="mt-4 sm:mt-0 text-gray-600 dark:text-gray-400 italic">
        {{ __('messages.latest_products_subtext') }}
      </p>
    </div>

    {{-- === Content === --}}
    @if(! empty($latestProducts) && count($latestProducts) > 0)
      {{-- Grid on sm+ --}}
      <div class="hidden sm:grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($latestProducts as $product)
          @php
            $name   = app()->getLocale()==='ar'
                      ? data_get($product,'name')
                      : data_get($product,'en_name');
            $thumb  = data_get($product,'images.0') ?: asset('images/placeholder.png');
            $prodId = Str::after(data_get($product,'route',''), '/Item/');
          @endphp
          <a href="{{ route('productDetails', $prodId) }}"
             class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105">
            <img src="{{ $thumb }}"
                 alt="{{ $name }}"
                 class="w-full h-48 object-cover group-hover:opacity-90 transition-opacity">
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 truncate">
                {{ $name }}
              </h3>
              <p class="text-primary font-bold">
                {{ isset($product['price'])
                   ? '$'.number_format($product['price'], 2)
                   : __('Contact for price') }}
              </p>
            </div>
          </a>
        @endforeach
      </div>

      {{-- Carousel on xs --}}
      <div class="sm:hidden flex space-x-4 overflow-x-auto snap-x snap-mandatory -mx-2 px-2">
        @foreach($latestProducts as $product)
          @php
            $name   = app()->getLocale()==='ar'
                      ? data_get($product,'name')
                      : data_get($product,'en_name');
            $thumb  = data_get($product,'images.0') ?: asset('images/placeholder.png');
            $prodId = Str::after(data_get($product,'route',''), '/Item/');
          @endphp
          <a href="{{ route('productDetails', $prodId) }}"
             class="snap-center flex-shrink-0 w-1/2 bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden mx-2 transition-transform hover:scale-105">
            <img src="{{ $thumb }}"
                 alt="{{ $name }}"
                 class="w-full h-40 object-cover">
            <div class="p-3">
              <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 truncate">
                {{ $name }}
              </h3>
              <p class="text-primary font-bold">
                {{ isset($product['price'])
                   ? '$'.number_format($product['price'], 2)
                   : __('Contact for price') }}
              </p>
            </div>
          </a>
        @endforeach
      </div>
    @else
      <p class="text-center text-gray-500 text-lg">
        {{ __('No products available.') }}
      </p>
    @endif

  </div>
</section>

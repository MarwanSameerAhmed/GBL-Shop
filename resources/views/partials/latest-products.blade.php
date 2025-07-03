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
      <div class="hidden sm:grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($latestProducts as $product)
          @php
            $name   = app()->getLocale()==='ar'
                      ? data_get($product,'name')
                      : data_get($product,'en_name');
            $short_desc = app()->getLocale()==='ar'
                      ? data_get($product,'short_description')
                      : data_get($product,'en_short_description');
            $thumb  = data_get($product, 'image') ?: asset('images/placeholder.png');
            $prodId = Str::after(data_get($product,'route',''), '/Item/');
          @endphp
          <div data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}">
            <a href="{{ route('productDetails', $prodId) }}"
               class="group block bg-white dark:bg-gray-800/50 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-xl dark:hover:shadow-indigo-500/20 hover:-translate-y-1.5 border border-gray-200 dark:border-gray-700">
              <div class="overflow-hidden relative">
                <img src="{{ $thumb }}"
                     alt="{{ $name }}"
                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              </div>
              <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1 truncate group-hover:text-indigo-600 dark:group-hover:text-purple-400 transition-colors">
                  {{ $name }}
                </h3>
                @if($short_desc)
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-3 h-10">
                    {{ Str::limit($short_desc, 50) }}
                </p>
                @endif
                <div class="flex items-center justify-between mt-3">
                    <p class="text-indigo-600 dark:text-purple-400 font-bold text-xl">
                      {{ isset($product['price']) && $product['price'] > 0
                         ? '$'.number_format($product['price'])
                         : '' }}
                    </p>
                    @if(!isset($product['price']) || $product['price'] == 0)
                      <span class="inline-block bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 text-xs font-bold px-3 py-1 rounded-full">
                        {{ __('messages.contact_for_price') }}
                      </span>
                    @endif
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>

      {{-- Carousel on xs --}}
      <div class="sm:hidden flex space-x-4 overflow-x-auto snap-x snap-mandatory -mx-4 px-4 pb-4">
        @foreach($latestProducts as $product)
          @php
            $name   = app()->getLocale()==='ar'
                      ? data_get($product,'name')
                      : data_get($product,'en_name');
            $thumb  = data_get($product, 'image') ?: asset('images/placeholder.png');
            $prodId = Str::after(data_get($product,'route',''), '/Item/');
          @endphp
          <a href="{{ route('productDetails', $prodId) }}"
             class="group snap-center flex-shrink-0 w-3/4 bg-white dark:bg-gray-800/50 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 ease-in-out border border-gray-200 dark:border-gray-700">
            <div class="overflow-hidden">
              <img src="{{ $thumb }}"
                   alt="{{ $name }}"
                   class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
            </div>
            <div class="p-3">
              <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 truncate group-hover:text-indigo-600 dark:group-hover:text-purple-400 transition-colors">
                {{ $name }}
              </h3>
              <div class="flex items-center justify-between mt-2">
                  <p class="text-indigo-600 dark:text-purple-400 font-bold text-lg">
                    {{ isset($product['price']) && $product['price'] > 0
                       ? '$'.number_format($product['price'])
                       : '' }}
                  </p>
                  @if(!isset($product['price']) || $product['price'] == 0)
                    <span class="inline-block bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 text-xs font-bold px-2 py-1 rounded-full">
                      {{ __('messages.contact_for_price') }}
                    </span>
                  @endif
              </div>
            </div>
          </a>
        @endforeach
      </div>
    @else
      <div class="text-center py-16">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.no_products_found_title') }}</h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('messages.no_products_found_text') }}</p>
      </div>
    @endif

  </div>
</section>

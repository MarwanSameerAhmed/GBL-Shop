@php
  use Illuminate\Support\Str;
@endphp

<section id="latest-products" class="py-12 bg-white dark:bg-gray-900 rounded-lg mb-8">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    {{-- === Header === --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div class="flex items-center space-x-3 rtl:space-x-reverse">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#fcc85e] animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A2 2 0 013 8v-5c0-1.1.9-2 2-2z" />
            </svg>
            <h2 class="text-3xl font-extrabold text-[#fcc85e]">
                {{ __('messages.latest_products') }}
            </h2>
        </div>
        <div class="hidden sm:block flex-grow border-t-2 border-yellow-200 dark:border-yellow-700/50 mx-6"></div>
        <p class="mt-4 sm:mt-0 text-gray-600 dark:text-gray-400 italic">
            {{ __('messages.latest_products_subtext') }}
        </p>
    </div>

    {{-- === Content === --}}
    @if(!empty($latestProducts) && count($latestProducts) > 0)
      <div x-data="{ swiper: null }" x-init="
          swiper = new Swiper($refs.container, {
              loop: {{ count($latestProducts) > 4 ? 'true' : 'false' }},
              slidesPerView: 1.2,
              spaceBetween: 16,
              autoplay: {
                  delay: 3500,
                  disableOnInteraction: false,
              },
              pagination: {
                  el: '.swiper-pagination',
                  clickable: true,
              },
              navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev',
              },
              breakpoints: {
                  640: { slidesPerView: 2, spaceBetween: 20 },
                  768: { slidesPerView: 3, spaceBetween: 24 },
                  1024: { slidesPerView: 4, spaceBetween: 24 },
              }
          });
          $el.addEventListener('mouseenter', () => swiper.autoplay.stop());
          $el.addEventListener('mouseleave', () => swiper.autoplay.start());
      " class="relative">
        <div class="swiper-container overscroll-x-contain" x-ref="container">
          <div class="swiper-wrapper">
            @foreach($latestProducts as $product)
              @php
                $name       = app()->getLocale()==='ar' ? data_get($product,'name') : data_get($product,'en_name');
                $short_desc = app()->getLocale()==='ar' ? data_get($product,'short_description') : data_get($product,'en_short_description');
                $thumb      = data_get($product, 'image') ?: asset('images/placeholder.png');
                $prodId     = Str::after(data_get($product,'route',''), '/Item/');
              @endphp
              <div class="swiper-slide h-auto pb-8">
                <div data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 100 }}" class="h-full">
                  <a href="{{ route('productDetails', $prodId) }}" class="group block bg-white dark:bg-gray-800/50 hover:bg-gray-50 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-xl hover:shadow-gray-200/40 dark:hover:shadow-xl dark:hover:shadow-[#fcc85e]/20 hover:-translate-y-1.5 border border-gray-200 dark:border-gray-700 dark:hover:border-[#fcc85e]/40 h-full flex flex-col">
                    <div class="overflow-hidden relative">
                      <img src="{{ $thumb }}" alt="{{ $name }}" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
                      <div class="absolute inset-0 bg-gradient-to-t from-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-4 flex-grow flex flex-col">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1 truncate group-hover:text-[#fcc85e] dark:group-hover:text-[#fcc85e] transition-colors duration-300">
                        {{ $name }}
                      </h3>
                      @if($short_desc)
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-3 h-10 overflow-hidden">
                          {{ Str::limit($short_desc, 50) }}
                        </p>
                      @endif
                      <div class="mt-auto pt-3">
                        @if(isset($product['price']) && $product['price'] > 0)
                          <p class="font-bold text-xl text-[#e7b450] dark:text-[#fcc85e]">
                            ${{ number_format($product['price']) }}
                          </p>
                        @else
                          <span class="inline-block bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-200 text-sm font-bold px-3 py-1.5 rounded-full">
                            {{ __('messages.contact_for_price') }}
                          </span>
                        @endif
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        {{-- Navigation & Pagination --}}
        <div class="swiper-pagination !bottom-0"></div>
        <div class="swiper-button-prev text-[#fcc85e] after:!text-2xl !-left-2 disabled:opacity-0 transition-opacity"></div>
        <div class="swiper-button-next text-[#fcc85e] after:!text-2xl !-right-2 disabled:opacity-0 transition-opacity"></div>
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

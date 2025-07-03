@extends('layouts.app')

@section('title', __('messages.contact_us'))
@php
      $isRtl = app()->getLocale() === 'ar';

@endphp

@section('content')

<div class="relative overflow-hidden bg-gray-50 dark:bg-gray-900/50">
    <!-- Background Glow -->
    <div class="absolute top-1/2 left-1/2 w-[80rem] h-[80rem] bg-primary/10 -translate-x-1/2 -translate-y-1/2 rounded-full blur-3xl opacity-50 animate-pulse"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">

        {{-- Page Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#fcc85e] dark:text-[#fcc85e] tracking-tight">
                {{ __('messages.get_in_touch') }}
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600 dark:text-gray-300">
                {{ __('messages.contact_us_subheader') }}
            </p>
        </div>

        <div class="bg-white/50 dark:bg-gray-800/50 rounded-2xl shadow-2xl backdrop-blur-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">

                {{-- Contact Info Section --}}
                <div class="p-8 md:p-12" data-aos="{{ $isRtl ? 'fade-left' : 'fade-right' }}">
                    <h2 class="text-3xl font-bold mb-4">{{ __('messages.contact_information') }}</h2>
                    <p class="mb-8 opacity-90">{{ __('messages.contact_info_desc') }}</p>

                    <div class="space-y-6">
                        {{-- Address --}}
                        <div class="flex items-start group">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div class="{{ $isRtl ? 'mr-4' : 'ml-4' }}">
                                <h3 class="font-semibold text-lg">{{ __('messages.Address') }}</h3>
                                <p class="opacity-80">{{ __('messages.our_address') }}</p>
                            </div>
                        </div>
                        {{-- Phone --}}
                        <div class="flex items-start group">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div class="{{ $isRtl ? 'mr-4' : 'ml-4' }}">
                                <h3 class="font-semibold text-lg">{{ __('messages.Phone') }}</h3>
                                <p class="opacity-80" dir="ltr">{{ __('messages.call_us') }}</p>
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="flex items-start group">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary/20 dark:group-hover:bg-primary/30 transition">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="{{ $isRtl ? 'mr-4' : 'ml-4' }}">
                                <h3 class="font-semibold text-lg">{{ __('messages.Email') }}</h3>
                                <p class="opacity-80">{{ __('messages.email_us') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Form Section --}}
                <div class="p-8 md:p-12" data-aos="{{ $isRtl ? 'fade-right' : 'fade-left' }}">
                    <form id="contact-form" action="#" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('messages.full_name') }}</label>
                                <div class="mt-1">
                                    <input type="text" name="name" id="name" autocomplete="name"
                                           class="py-3 px-4 block w-full shadow-sm bg-white/80 dark:bg-gray-900/80 border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary transition text-gray-800 dark:text-gray-200">
                                </div>
                            </div>
                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('messages.email_address') }}</label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" autocomplete="email"
                                           class="py-3 px-4 block w-full shadow-sm bg-white/80 dark:bg-gray-900/80 border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary transition text-gray-800 dark:text-gray-200">
                                </div>
                            </div>
                            {{-- Subject --}}
                            <div class="sm:col-span-2">
                                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('messages.subject') }}</label>
                                <div class="mt-1">
                                    <input type="text" name="subject" id="subject"
                                           class="py-3 px-4 block w-full shadow-sm bg-white/80 dark:bg-gray-900/80 border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary transition text-gray-800 dark:text-gray-200">
                                </div>
                            </div>
                            {{-- Message --}}
                            <div class="sm:col-span-2">
                                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('messages.message') }}</label>
                                <div class="mt-1">
                                    <textarea id="message" name="message" rows="4"
                                              class="py-3 px-4 block w-full shadow-sm bg-white/80 dark:bg-gray-900/80 border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary transition text-gray-800 dark:text-gray-200"></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Submit Button --}}
                        <div class="sm:col-span-2 mt-8">
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-lg text-base font-medium text-black dark:text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary
                                           dark:shadow-primary/50 transition-all duration-300 transform hover:scale-105">
                                {{ __('messages.send_message') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
  document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the actual form submission

    Swal.fire({
      title: "{{ __('messages.service_unavailable') }}",
      text: "{{ __('messages.service_unavailable_text') }}",
      icon: 'info',
      confirmButtonText: "{{ __('messages.ok') }}",
      confirmButtonColor: '#0D9488', // Teal-600 to match the theme
      background: document.documentElement.classList.contains('dark') ? '#1F2937' : '#FFFFFF',
      color: document.documentElement.classList.contains('dark') ? '#F9FAFB' : '#111827',
      customClass: {
        popup: 'rounded-2xl shadow-lg',
        confirmButton: 'px-6 py-2 rounded-lg font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500',
      },
      showClass: {
        popup: 'animate__animated animate__fadeInDown animate__faster'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutUp animate__faster'
      }
    });
  });
</script>
@endpush

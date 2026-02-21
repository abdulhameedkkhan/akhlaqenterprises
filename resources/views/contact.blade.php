@extends('layouts.app')

@section('title', __('contact.page_title'))

@section('content')
    <!-- Header -->
    <div class="relative bg-slate-900 py-32 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[100px]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block py-1 px-4 rounded-lg bg-blue-500/10 text-blue-400 text-xs font-black tracking-[0.3em] uppercase border border-blue-500/20 mb-6">{{ __('contact.connect_badge') }}</span>
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-none mb-6">{{ __('contact.hero_title') }}</h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg md:text-xl font-medium leading-relaxed">
                {{ __('contact.hero_subtitle') }}
            </p>
        </div>
    </div>

    <section class="py-20 bg-white dark:bg-slate-800/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                
                <!-- Contact Info -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">{{ __('contact.hero_title') }}</h2>
                    <p class="text-slate-600 dark:text-slate-300 mb-8">
                        {{ __('contact.hero_subtitle') }}
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/40 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white">{{ __('contact.office_location') }}</h3>
                                <p class="text-slate-600 dark:text-slate-300">F-2 Fish Harbour Road,<br>Karachi, Pakistan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/40 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white">{{ __('contact.call_us') }}</h3>
                                <p class="text-slate-600 dark:text-slate-300">+92 333 2394825<br>+92 21 32200181</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/40 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white">{{ __('contact.email_us') }}</h3>
                                <p class="text-slate-600 dark:text-slate-300">irfan@akhlaqenterprises.com</p>
                            </div>
                        </div>

                        <!-- Instant WhatsApp Support Section -->
                        <div class="mt-8 p-6 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-2xl flex items-center justify-between group hover:shadow-xl hover:shadow-green-500/10 transition-all duration-500">
                            <div>
                                <h3 class="text-green-800 dark:text-green-300 font-black text-lg mb-1">{{ __('contact.whatsapp_title') }}</h3>
                                <p class="text-green-600 dark:text-green-400 text-sm font-semibold">{{ __('contact.whatsapp_desc') }}</p>
                                <a href="https://wa.me/923332394825" target="_blank" class="mt-4 inline-flex items-center gap-2 bg-green-500 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-green-500/30 hover:bg-green-600 transition-all active:scale-95">
                                    {{ __('contact.chat_now') }}
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.067 2.877 1.215 3.076.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                </a>
                            </div>
                            <div class="hidden sm:flex w-16 h-16 bg-white rounded-2xl items-center justify-center shadow-inner group-hover:rotate-12 transition-transform duration-500">
                                <svg class="w-10 h-10 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.067 2.877 1.215 3.076.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Contact Form -->
                <div class="bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">{{ __('contact.send_message') }}</h2>
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="first-name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('contact.first_name') }}</label>
                                <input type="text" name="first-name" id="first-name" value="{{ old('first-name') }}" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="{{ __('contact.first_name') }}" required>
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('contact.last_name') }}</label>
                                <input type="text" name="last-name" id="last-name" value="{{ old('last-name') }}" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="{{ __('contact.last_name') }}" required>
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('contact.email_label') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="{{ __('contact.email_placeholder') }}" required>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('contact.phone_label') }}</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="{{ __('contact.phone_placeholder') }}">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('contact.message_label') }}</label>
                            <textarea name="message" id="message" rows="4" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="{{ __('contact.message_placeholder') }}" required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 px-8 rounded-lg shadow-lg hover:bg-blue-700 transition-all hover:-translate-y-0.5">
                            {{ __('contact.send_message') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Full-Width Map Section ─────────────────────────────────────────── -->
    <section class="relative bg-slate-100 dark:bg-slate-900 pt-0 pb-0 overflow-hidden">

        <!-- Decorative top edge -->
        <div class="h-12 bg-white dark:bg-slate-800/40 relative z-10" style="clip-path: ellipse(55% 100% at 50% 0%)"></div>

        <div class="relative">

            <!-- Map wrapper — full width -->
            <div class="relative -mt-2 overflow-hidden"
                 style="height: 520px;">

                <!-- Google Map iframe — Akhlaq Enterprises Pvt Ltd exact location -->
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.037825!2d66.9770118!3d24.8511112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb315e70250eaab%3A0xa36ea30e3e63343e!2sAkhlaq%20Enterprises%20Pvt%20Ltd!5e0!3m2!1sen!2s!4v1740000000000!5m2!1sen!2s"
                    width="100%"
                    height="100%"
                    style="border:0; display:block;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

                <!-- Info overlay card — bottom left -->
                <div class="absolute bottom-5 left-5 z-10
                            bg-white/92 dark:bg-slate-800/92 backdrop-blur-xl
                            rounded-2xl p-5 max-w-xs w-full
                            shadow-[0_8px_32px_rgba(0,0,0,0.14)] dark:shadow-[0_8px_32px_rgba(0,0,0,0.5)]
                            border border-white/80 dark:border-slate-700/70">

                    <!-- Pin icon + name -->
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shrink-0 shadow-lg shadow-blue-600/30">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-black text-slate-900 dark:text-white text-sm leading-tight">Akhlaq Enterprises Pvt Ltd</p>
                            <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-0.5 font-medium">Fish Harbour, Karachi</p>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="flex items-start gap-2.5 mb-4 pl-1">
                        <svg class="w-3.5 h-3.5 text-slate-400 dark:text-slate-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-[12px] text-slate-600 dark:text-slate-300 font-medium leading-relaxed">F-2 Fish Harbour Road,<br>Karachi, Pakistan</p>
                    </div>

                    <!-- Directions button -->
                    <a href="https://www.google.com/maps/place/Akhlaq+Enterprises+Pvt+Ltd/@24.8511112,66.9770118,17z/data=!3m1!4b1!4m6!3m5!1s0x3eb315e70250eaab:0xa36ea30e3e63343e!8m2!3d24.8511064!4d66.9795867!16s%2Fg%2F113g7jcsj"
                       target="_blank" rel="noopener"
                       class="flex items-center justify-center gap-2 w-full
                              bg-blue-600 hover:bg-blue-700
                              text-white text-[12px] font-bold
                              py-2.5 px-4 rounded-xl
                              transition-all duration-200 active:scale-95
                              shadow-md shadow-blue-600/30">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        Get Directions
                    </a>
                </div>

                <!-- EU Reg badge — top right -->
                <div class="absolute top-4 right-4 z-10
                            bg-white/85 dark:bg-slate-800/85 backdrop-blur-md
                            px-3 py-1.5 rounded-xl
                            border border-white/70 dark:border-slate-700/60
                            shadow-md">
                    <p class="text-[10px] font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">
                        EU Reg. TEC/90/01 · FAO Zone 51
                    </p>
                </div>
            </div>

            <!-- Bottom padding -->
            <div class="h-16"></div>
        </div>
    </section>
    <!-- ── END Map Section ────────────────────────────────────────────────── -->
@endsection

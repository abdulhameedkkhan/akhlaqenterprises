<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Akhlaq Enterprises - Premium Seafood')</title>
    <meta name="description" content="Akhlaq Enterprises - Exporting the finest quality seafood worldwide. Fresh, frozen, and processed seafood products.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Dark Mode Script (Prevents Flash) -->
    <script>
        // Load theme immediately to prevent flash
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
        
        // Global toggle function - define immediately
        window.toggleTheme = function() {
            const html = document.documentElement;
            const body = document.body;
            
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                // Force immediate visual feedback
                body.style.backgroundColor = '#f8fafc';
                body.style.color = '#1e293b';
                console.log('✓ Light Mode ON - Class removed');
                
                // Remove inline styles after transition
                setTimeout(() => {
                    body.style.backgroundColor = '';
                    body.style.color = '';
                }, 500);
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                // Force immediate visual feedback
                body.style.backgroundColor = '#020617';
                body.style.color = '#e2e8f0';
                console.log('✓ Dark Mode ON - Class added');
                
                // Remove inline styles after transition
                setTimeout(() => {
                    body.style.backgroundColor = '';
                    body.style.color = '';
                }, 500);
            }
            
            console.log('HTML classes:', html.className);
        };
        
        console.log('✓ Theme toggle loaded');
    </script>
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 flex flex-col min-h-screen transition-colors duration-300">
    
    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 z-[1000] bg-white dark:bg-slate-950 flex flex-col items-center justify-center transition-opacity duration-700">
        <div class="relative w-32 h-32 flex items-center justify-center">
            <!-- Ripple Effect -->
            <div class="absolute inset-0 border-4 border-blue-100 dark:border-blue-900 rounded-full animate-ping"></div>
            <!-- Logo in Loader -->
            <img src="{{ asset('images/logo.png') }}" alt="Loading..." class="w-35 h-24 object-contain relative z-10 animate-pulse">
        </div>
        <p class="mt-4 text-blue-600 dark:text-blue-400 font-black tracking-[0.3em] uppercase text-xs animate-pulse">Loading Experience</p>
    </div>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 700);
        });
    </script>
    
    <!-- Navigation -->
    <nav class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 fixed w-full z-50 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-28">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center group">
                        <!-- Balanced Logo Container -->
                        <div class="h-20 flex items-center">
                            <img src="{{ asset('images/logo.png') }}" alt="Akhlaq Enterprises Logo" class="h-16 w-auto object-contain transition-transform duration-500 group-hover:scale-105">
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-10">
                    <a href="{{ route('home') }}" class="relative group py-2">
                        <span class="text-sm font-bold {{ request()->routeIs('home') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300' }} group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Home</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 dark:bg-blue-400 scale-x-0 group-hover:scale-x-100 {{ request()->routeIs('home') ? 'scale-x-100' : '' }} transition-transform origin-left"></span>
                    </a>
                    <a href="{{ route('about') }}" class="relative group py-2">
                        <span class="text-sm font-bold {{ request()->routeIs('about') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300' }} group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">About</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 dark:bg-blue-400 scale-x-0 group-hover:scale-x-100 {{ request()->routeIs('about') ? 'scale-x-100' : '' }} transition-transform origin-left"></span>
                    </a>
                    <a href="{{ route('gallery') }}" class="relative group py-2">
                        <span class="text-sm font-bold {{ request()->routeIs('gallery') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300' }} group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Gallery</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 dark:bg-blue-400 scale-x-0 group-hover:scale-x-100 {{ request()->routeIs('gallery') ? 'scale-x-100' : '' }} transition-transform origin-left"></span>
                    </a>
                    <a href="{{ route('products.index') }}" class="relative group py-2">
                        <span class="text-sm font-bold {{ request()->routeIs('products.*') ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-300' }} group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Products</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 dark:bg-blue-400 scale-x-0 group-hover:scale-x-100 {{ request()->routeIs('products.*') ? 'scale-x-100' : '' }} transition-transform origin-left"></span>
                    </a>
                    <a href="{{ route('contact') }}" class="px-7 py-3 rounded-2xl bg-slate-900 dark:bg-slate-800 text-white text-sm font-bold shadow-2xl hover:bg-blue-600 hover:shadow-blue-500/40 dark:hover:shadow-blue-400/40 transition-all transform hover:-translate-y-1 active:scale-95 {{ request()->routeIs('contact') ? 'bg-blue-600 shadow-blue-500/40' : '' }}">
                        Contact Us
                    </a><a href="https://wa.me/923332394825" target="_blank" class="flex items-center gap-2 group px-4 py-2 rounded-xl hover:bg-green-50 dark:hover:bg-green-950/30 transition-all">
                        <div class="w-8 h-8 bg-green-500 dark:bg-green-600 rounded-lg flex items-center justify-center text-white shadow-lg group-hover:rotate-12 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-3.138-5.437-2.1-11.938 2.383-16.421 4.664-4.665 12.23-4.666 16.892 0 4.664 4.665 4.665 12.23 0 16.892-4.368 4.369-10.743 5.568-16.195 2.766L.057 24zm9.782-12.074c-1.35-1.928-2.614-2.735-3.003-2.854-.385-.12-1.011-.476-1.58.077-.92.894-1.218 2.023-.559 3.033.437.671 2.913 4.293 6.643 6.324 3.731 2.03 5.488 1.582 6.138 1.156.65-.426 1.428-1.579 1.62-2.316.19-.738.163-1.638-.19-1.815-.353-.177-2.073-1.023-2.39-1.173-.317-.15-.547-.225-.777.15-.23.375-.909 1.173-1.115 1.413-.207.24-.413.27-.766.094-.353-.176-1.49-.55-2.835-1.75l-.014-.012z"/></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-300 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">+92 333 2394825</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button type="button" class="p-3 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-200 hover:bg-blue-600 hover:text-white transition-all focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 animate-fade-in-down" id="mobile-menu">
            <div class="px-4 pt-4 pb-6 space-y-2 shadow-2xl">
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('home') ? 'bg-blue-50 dark:bg-blue-950/30 text-blue-600 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">Home</a>
                <a href="{{ route('about') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('about') ? 'bg-blue-50 dark:bg-blue-950/30 text-blue-600 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">About Us</a>
                <a href="{{ route('gallery') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('gallery') ? 'bg-blue-50 dark:bg-blue-950/30 text-blue-600 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">Gallery</a>
                <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('products.*') ? 'bg-blue-50 dark:bg-blue-950/30 text-blue-600 dark:text-blue-400' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">Products</a>
                <a href="https://wa.me/923332394825" target="_blank" class="flex items-center gap-4 px-4 py-4 rounded-xl text-base font-bold bg-green-50 dark:bg-green-950/30 text-green-600 dark:text-green-400 border border-green-200 dark:border-green-800 shadow-sm">
                    <div class="w-10 h-10 bg-green-500 dark:bg-green-600 rounded-lg flex items-center justify-center text-white shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-3.138-5.437-2.1-11.938 2.383-16.421 4.664-4.665 12.23-4.666 16.892 0 4.664 4.665 4.665 12.23 0 16.892-4.368 4.369-10.743 5.568-16.195 2.766L.057 24zm9.782-12.074c-1.35-1.928-2.614-2.735-3.003-2.854-.385-.12-1.011-.476-1.58.077-.92.894-1.218 2.023-.559 3.033.437.671 2.913 4.293 6.643 6.324 3.731 2.03 5.488 1.582 6.138 1.156.65-.426 1.428-1.579 1.62-2.316.19-.738.163-1.638-.19-1.815-.353-.177-2.073-1.023-2.39-1.173-.317-.15-.547-.225-.777.15-.23.375-.909 1.173-1.115 1.413-.207.24-.413.27-.766.094-.353-.176-1.49-.55-2.835-1.75l-.014-.012z"/></svg>
                    </div>
                    <span>WhatsApp: +92 333 2394825</span>
                </a>
                <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                    <a href="{{ route('contact') }}" class="flex items-center justify-center px-4 py-4 rounded-xl text-base font-extrabold bg-blue-600 dark:bg-blue-700 text-white shadow-lg shadow-blue-500/30 dark:shadow-blue-400/20">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Floating Language Selector -->
    <div class="fixed bottom-8 left-8 z-50 animate-fade-in-up">
        <!-- Language Button -->
        <button type="button" onclick="toggleLanguageMenu()" id="language-toggle"
                class="p-4 rounded-full bg-gradient-to-br from-emerald-600 to-teal-600 dark:from-emerald-800 dark:to-teal-900 text-white shadow-2xl shadow-emerald-500/40 dark:shadow-emerald-900/60 hover:shadow-emerald-600/60 dark:hover:shadow-emerald-800/80 hover:scale-110 active:scale-95 transition-all duration-300 group border-2 border-white/20 dark:border-emerald-700 backdrop-blur-sm" 
                title="Change Language">
            <!-- Pulse Ring on Hover -->
            <span class="absolute inset-0 rounded-full bg-emerald-500 dark:bg-emerald-700 opacity-0 group-hover:opacity-20 group-hover:scale-150 transition-all duration-700"></span>
            
            <!-- Globe Icon -->
            <svg class="w-6 h-6 relative z-10 transition-transform group-hover:rotate-12 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            
            <!-- Current Language Badge -->
            <span id="current-lang-badge" class="absolute -top-1 -right-1 bg-white dark:bg-slate-800 text-emerald-600 dark:text-emerald-400 text-xs font-black px-2 py-0.5 rounded-full shadow-lg border border-emerald-200 dark:border-emerald-700">
                EN
            </span>
        </button>

        <!-- Language Menu (Hidden by default) -->
        <div id="language-menu" class="hidden absolute bottom-20 left-0 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-700 overflow-hidden min-w-[280px] animate-fade-in-up">
            <div class="p-4 bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-800 dark:to-teal-900">
                <h3 class="text-white font-bold text-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                    </svg>
                    Select Language
                </h3>
                <p class="text-emerald-100 text-xs mt-1">Choose your preferred language</p>
            </div>
            
            <div class="max-h-96 overflow-y-auto p-2">
                <!-- Popular Languages -->
                <div class="px-4 py-2">
                    <div class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Popular</div>
                </div>

                <!-- Language Options -->
                <button onclick="changeLanguage('en', 'English', 'EN')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇬🇧</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">English</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Default / UK</div>
                    </div>
                </button>
                
                <button onclick="changeLanguage('ur', 'اردو', 'UR')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇵🇰</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">اردو</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Urdu</div>
                    </div>
                </button>

                <button onclick="changeLanguage('ar', 'العربية', 'AR')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇸🇦</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">العربية</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Arabic</div>
                    </div>
                </button>

                <button onclick="changeLanguage('zh-CN', '中文', 'ZH')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇨🇳</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">中文</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Chinese</div>
                    </div>
                </button>

                <button onclick="changeLanguage('es', 'Español', 'ES')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇪🇸</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Español</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Spanish</div>
                    </div>
                </button>

                <button onclick="changeLanguage('fr', 'Français', 'FR')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇫🇷</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Français</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">French</div>
                    </div>
                </button>

                <button onclick="changeLanguage('de', 'Deutsch', 'DE')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇩🇪</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Deutsch</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">German</div>
                    </div>
                </button>

                <button onclick="changeLanguage('ja', '日本語', 'JA')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇯🇵</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">日本語</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Japanese</div>
                    </div>
                </button>

                <button onclick="changeLanguage('ru', 'Русский', 'RU')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇷🇺</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Русский</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Russian</div>
                    </div>
                </button>

                <button onclick="changeLanguage('pt', 'Português', 'PT')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇵🇹</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Português</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Portuguese</div>
                    </div>
                </button>

                <button onclick="changeLanguage('tr', 'Türkçe', 'TR')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇹🇷</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Türkçe</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Turkish</div>
                    </div>
                </button>

                <!-- European Languages -->
                <div class="px-4 py-2 mt-2 border-t border-slate-200 dark:border-slate-700">
                    <div class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">European Languages</div>
                </div>

                <button onclick="changeLanguage('it', 'Italiano', 'IT')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇮🇹</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Italiano</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Italian</div>
                    </div>
                </button>

                <button onclick="changeLanguage('nl', 'Nederlands', 'NL')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇳🇱</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Nederlands</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Dutch</div>
                    </div>
                </button>

                <button onclick="changeLanguage('sv', 'Svenska', 'SV')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇸🇪</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Svenska</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Swedish</div>
                    </div>
                </button>

                <button onclick="changeLanguage('pl', 'Polski', 'PL')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇵🇱</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Polski</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Polish</div>
                    </div>
                </button>

                <button onclick="changeLanguage('el', 'Ελληνικά', 'EL')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇬🇷</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Ελληνικά</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Greek</div>
                    </div>
                </button>

                <button onclick="changeLanguage('da', 'Dansk', 'DA')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇩🇰</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Dansk</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Danish</div>
                    </div>
                </button>

                <button onclick="changeLanguage('no', 'Norsk', 'NO')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇳🇴</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Norsk</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Norwegian</div>
                    </div>
                </button>

                <button onclick="changeLanguage('fi', 'Suomi', 'FI')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇫🇮</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Suomi</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Finnish</div>
                    </div>
                </button>

                <button onclick="changeLanguage('cs', 'Čeština', 'CS')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇨🇿</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Čeština</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Czech</div>
                    </div>
                </button>

                <button onclick="changeLanguage('ro', 'Română', 'RO')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇷🇴</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Română</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Romanian</div>
                    </div>
                </button>

                <button onclick="changeLanguage('hu', 'Magyar', 'HU')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇭🇺</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Magyar</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Hungarian</div>
                    </div>
                </button>

                <button onclick="changeLanguage('bg', 'Български', 'BG')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇧🇬</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Български</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Bulgarian</div>
                    </div>
                </button>

                <button onclick="changeLanguage('sk', 'Slovenčina', 'SK')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇸🇰</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Slovenčina</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Slovak</div>
                    </div>
                </button>

                <button onclick="changeLanguage('hr', 'Hrvatski', 'HR')" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-emerald-50 dark:hover:bg-slate-800 rounded-xl transition-all group text-left">
                    <span class="text-2xl">🇭🇷</span>
                    <div class="flex-1">
                        <div class="font-bold text-slate-900 dark:text-slate-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400">Hrvatski</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Croatian</div>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Theme Toggle Button (Sticky) -->
    <button type="button" onclick="toggleTheme()" 
            class="fixed bottom-8 right-8 z-50 p-4 rounded-full bg-gradient-to-br from-blue-600 to-cyan-600 dark:from-slate-800 dark:to-slate-900 text-white shadow-2xl shadow-blue-500/40 dark:shadow-slate-900/60 hover:shadow-blue-600/60 dark:hover:shadow-slate-800/80 hover:scale-110 active:scale-95 transition-all duration-300 group border-2 border-white/20 dark:border-slate-700 animate-fade-in-up backdrop-blur-sm" 
            title="Toggle Dark/Light Mode">
        <!-- Pulse Ring on Hover -->
        <span class="absolute inset-0 rounded-full bg-blue-500 dark:bg-slate-700 opacity-0 group-hover:opacity-20 group-hover:scale-150 transition-all duration-700"></span>
        
        <!-- Sun Icon (visible in dark mode) -->
        <svg class="w-6 h-6 hidden dark:block transition-transform group-hover:rotate-180 duration-500 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <!-- Moon Icon (visible in light mode) -->
        <svg class="w-6 h-6 block dark:hidden transition-transform group-hover:-rotate-12 duration-500 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
        </svg>
        
        <!-- Tooltip -->
        <span class="absolute right-full mr-3 top-1/2 -translate-y-1/2 px-3 py-2 bg-slate-900 dark:bg-slate-800 text-white text-xs font-bold rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-200 pointer-events-none shadow-xl border border-slate-700 dark:border-slate-600">
            <span class="hidden dark:inline">☀️ Light Mode</span>
            <span class="inline dark:hidden">🌙 Dark Mode</span>
        </span>
    </button>

    <!-- Main Content -->
    <main class="flex-grow pt-32">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 dark:bg-black text-slate-300 dark:text-slate-400 pt-20 pb-10 border-t border-slate-800 dark:border-slate-900 relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/5 dark:bg-blue-400/5 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-900/10 dark:bg-blue-800/10 rounded-full blur-[100px]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16">
                <!-- Brand -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Akhlaq Enterprises Logo" class="h-20 w-auto brightness-0 invert opacity-90 object-contain">
                    </div>
                    <p class="text-base leading-relaxed text-slate-400 dark:text-slate-500 font-medium">
                        Redefining seafood exports with a legacy of trust, ethical standards, and premium quality from the heart of Pakistan.
                    </p>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/share/1CG6gfgvHh/?mibextid=wwXIfr" target="_blank" class="w-10 h-10 rounded-full bg-slate-800 dark:bg-slate-900 flex items-center justify-center hover:bg-blue-600 dark:hover:bg-blue-700 transition-all transform hover:-translate-y-1"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 dark:bg-slate-900 flex items-center justify-center hover:bg-blue-600 dark:hover:bg-blue-700 transition-all transform hover:-translate-y-1"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    </div>
                </div>

                <!-- Links -->
                <div class="md:pl-10">
                    <h3 class="text-white dark:text-slate-200 font-bold mb-6 text-xl tracking-tight">Quick Navigate</h3>
                    <ul class="space-y-4 text-slate-400 dark:text-slate-500 font-semibold">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 dark:bg-blue-400 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 dark:bg-blue-400 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>About Company</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 dark:bg-blue-400 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>Our Gallery</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 dark:bg-blue-400 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>Browse Products</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 dark:bg-blue-400 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>Get in Touch</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="md:col-span-2 bg-slate-900/50 dark:bg-slate-950/50 p-8 rounded-[2rem] border border-slate-800 dark:border-slate-900 shadow-inner">
                    <h3 class="text-white dark:text-slate-200 font-bold mb-6 text-xl tracking-tight">Contact Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="space-y-4 font-medium">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-600/10 dark:bg-blue-500/10 flex items-center justify-center text-blue-500 dark:text-blue-400 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <span class="text-sm leading-relaxed">F-2 Fish Harbour Road,<br>Karachi, Pakistan.</span>
                            </div>
                        </div>
                        <div class="space-y-4 font-medium">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-green-600/10 dark:bg-green-500/10 flex items-center justify-center text-green-500 dark:text-green-400 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <span class="text-sm">+92 333 2394825</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-red-600/10 dark:bg-red-500/10 flex items-center justify-center text-red-500 dark:text-red-400 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <span class="text-sm">irfan@akhlaqenterprises.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-900 dark:border-slate-950 mt-20 pt-10 flex flex-col md:flex-row justify-between items-center text-sm font-bold text-slate-600 dark:text-slate-700 tracking-wider">
                <p>&copy; {{ date('Y') }} AKHLAQ ENTERPRISES. ALL RIGHTS RESERVED.</p>
                <div class="flex space-x-10 mt-6 md:mt-0 uppercase font-black text-[10px] tracking-[0.3em]">
                    <a href="#" class="hover:text-blue-500 dark:hover:text-blue-400 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white dark:hover:text-slate-300 transition-colors">Terms</a>
                    <a href="#" class="hover:text-white dark:hover:text-slate-300 transition-colors">Sitemap</a>
                    <a href="{{ route('login') }}" class="hover:text-blue-400 dark:hover:text-blue-300 transition-colors border-l border-slate-700 dark:border-slate-800 pl-10 font-black">Portal Access</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Google Translate Widget (Hidden but Required) -->
    <div id="google_translate_element" style="position: fixed; bottom: -100px; left: -100px; opacity: 0; pointer-events: none;"></div>

    <!-- Google Translate Script -->
    <script type="text/javascript">
        // Global variable to track if Google Translate is loaded
        window.googleTranslateLoaded = false;
        
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ur,ar,zh-CN,es,fr,de,ja,ru,pt,tr,it,nl,sv,pl,el,da,no,fi,cs,ro,hu,bg,sk,hr',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false,
                multilanguagePage: true
            }, 'google_translate_element');
            
            // Wait for the element to be ready
            setTimeout(() => {
                window.googleTranslateLoaded = true;
                console.log('✓ Google Translate initialized');
                
                // Check for saved language preference and update badge
                const savedBadge = localStorage.getItem('language-badge');
                if (savedBadge) {
                    const badge = document.getElementById('current-lang-badge');
                    if (badge) {
                        badge.textContent = savedBadge;
                    }
                }
            }, 1000);
        }
        
        // Function to trigger translation
        function triggerTranslation(langCode) {
            const selectElement = document.querySelector('.goog-te-combo');
            if (selectElement) {
                selectElement.value = langCode;
                selectElement.dispatchEvent(new Event('change'));
                return true;
            }
            return false;
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Language Selector Script -->
    <script>
        // Toggle Language Menu
        window.toggleLanguageMenu = function() {
            const menu = document.getElementById('language-menu');
            menu.classList.toggle('hidden');
        };

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('language-menu');
            const toggle = document.getElementById('language-toggle');
            
            if (menu && toggle && !menu.contains(event.target) && !toggle.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        // Helper function to set Google Translate cookie
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        // Helper function to get cookie value
        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        // Check and update badge on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedBadge = localStorage.getItem('language-badge');
            const badge = document.getElementById('current-lang-badge');
            
            // Check if translation is active via cookie
            const translationCookie = getCookie('googtrans');
            
            if (savedBadge && badge) {
                badge.textContent = savedBadge;
                
                if (translationCookie && translationCookie !== '/en/en') {
                    console.log('✓ Active translation detected:', translationCookie);
                }
            }
        });

        // Change Language Function - Improved with Cookie Method
        window.changeLanguage = function(langCode, langName, shortCode) {
            console.log('🌍 Changing language to:', langName, '(', langCode, ')');
            
            // Update badge immediately
            const badge = document.getElementById('current-lang-badge');
            if (badge) {
                badge.textContent = shortCode;
            }
            
            // Close menu
            const menu = document.getElementById('language-menu');
            if (menu) {
                menu.classList.add('hidden');
            }
            
            // Save preference
            localStorage.setItem('preferred-language', langCode);
            localStorage.setItem('language-badge', shortCode);
            localStorage.setItem('language-name', langName);
            
            // Method 1: Try direct dropdown change
            const selectElement = document.querySelector('.goog-te-combo');
            if (selectElement) {
                selectElement.value = langCode;
                selectElement.dispatchEvent(new Event('change'));
                console.log('✓ Dropdown method triggered');
            }
            
            // Method 2: Set Google Translate cookie and reload (most reliable)
            if (langCode === 'en') {
                // For English, clear the cookie
                setCookie('googtrans', '', -1);
                console.log('✓ Cleared translation cookie for English');
            } else {
                // Set cookie for selected language
                const cookieValue = '/en/' + langCode;
                setCookie('googtrans', cookieValue, 7);
                setCookie('googtrans', cookieValue, 7); // Set twice for reliability
                console.log('✓ Cookie set to:', cookieValue);
            }
            
            // Show loading indicator
            const loadingMsg = document.createElement('div');
            loadingMsg.innerHTML = `
                <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); 
                     background: rgba(16, 185, 129, 0.95); color: white; padding: 20px 40px; 
                     border-radius: 16px; z-index: 9999; font-weight: bold; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
                    🌍 Loading ${langName}...
                </div>
            `;
            document.body.appendChild(loadingMsg);
            
            // Reload page to apply translation
            setTimeout(() => {
                window.location.reload();
            }, 500);
        };
    </script>

    <!-- Keyboard Shortcut for Theme Toggle -->
    <script>
        // Keyboard shortcut (Ctrl/Cmd + Shift + D)
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'D') {
                e.preventDefault();
                if (typeof window.toggleTheme === 'function') {
                    window.toggleTheme();
                }
            }
            // Keyboard shortcut for Language Menu (Ctrl/Cmd + Shift + L)
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'L') {
                e.preventDefault();
                toggleLanguageMenu();
            }
        });
    </script>
    
    <!-- Hide Google Translate Default UI -->
    <style>
        /* Hide Google Translate banner and branding */
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
        
        body {
            top: 0 !important;
            position: static !important;
        }
        
        .goog-te-gadget {
            color: transparent !important;
            font-size: 0 !important;
        }
        
        .goog-te-gadget img {
            display: none !important;
        }
        
        .goog-logo-link {
            display: none !important;
        }
        
        .goog-te-gadget-icon {
            display: none !important;
        }
        
        #google_translate_element {
            display: none !important;
        }
        
        /* Fix body positioning when Google Translate is active */
        body.translated-ltr,
        body.translated-rtl {
            top: 0 !important;
        }
        
        /* Hide the annoying top frame */
        .skiptranslate iframe {
            visibility: hidden !important;
            display: none !important;
        }
        
        /* Ensure content is visible */
        html[translate="yes"] body {
            top: 0 !important;
        }
    </style>
</body>
</html>

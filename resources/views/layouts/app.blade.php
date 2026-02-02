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
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800 flex flex-col min-h-screen">
    
    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 z-[1000] bg-white flex flex-col items-center justify-center transition-opacity duration-700">
        <div class="relative w-32 h-32 flex items-center justify-center">
            <!-- Ripple Effect -->
            <div class="absolute inset-0 border-4 border-blue-100 rounded-full animate-ping"></div>
            <!-- Logo in Loader -->
            <img src="{{ asset('images/logo.png') }}" alt="Loading..." class="w-35 h-24 object-contain relative z-10 animate-pulse">
        </div>
        <p class="mt-4 text-blue-600 font-black tracking-[0.3em] uppercase text-xs animate-pulse">Loading Experience</p>
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
    <nav class="bg-white border-b border-slate-200 fixed w-full z-50 transition-all duration-300 shadow-sm">
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
                        <span class="text-sm font-bold {{ request()->routeIs('home') ? 'text-blue-600' : 'text-slate-600' }} group-hover:text-blue-600 transition-colors">Home</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 scale-x-0 group-hover:scale-x-100 {{ request()->routeIs('home') ? 'scale-x-100' : '' }} transition-transform origin-left"></span>
                    </a>
                    <a href="{{ route('about') }}" class="relative group py-2">
                        <span class="text-sm font-bold {{ request()->routeIs('about') ? 'text-blue-600' : 'text-slate-600' }} group-hover:text-blue-600 transition-colors">About</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 scale-x-0 group-hover:scale-x-100 {{ request()->routeIs('about') ? 'scale-x-100' : '' }} transition-transform origin-left"></span>
                    </a>
                    <a href="{{ route('gallery') }}" class="relative group py-2">
                        <span class="text-sm font-bold {{ request()->routeIs('gallery') ? 'text-blue-600' : 'text-slate-600' }} group-hover:text-blue-600 transition-colors">Gallery</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 scale-x-0 group-hover:scale-x-100 {{ request()->routeIs('gallery') ? 'scale-x-100' : '' }} transition-transform origin-left"></span>
                    </a>
                    <a href="{{ route('products.index') }}" class="relative group py-2">
                        <span class="text-sm font-bold {{ request()->routeIs('products.*') ? 'text-blue-600' : 'text-slate-600' }} group-hover:text-blue-600 transition-colors">Products</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 scale-x-0 group-hover:scale-x-100 {{ request()->routeIs('products.*') ? 'scale-x-100' : '' }} transition-transform origin-left"></span>
                    </a>
                    <a href="{{ route('contact') }}" class="px-7 py-3 rounded-2xl bg-slate-900 text-white text-sm font-bold shadow-2xl hover:bg-blue-600 hover:shadow-blue-500/40 transition-all transform hover:-translate-y-1 active:scale-95 {{ request()->routeIs('contact') ? 'bg-blue-600 shadow-blue-500/40' : '' }}">
                        Contact Us
                    </a><a href="https://wa.me/923332394825" target="_blank" class="flex items-center gap-2 group px-4 py-2 rounded-xl hover:bg-green-50 transition-all">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center text-white shadow-lg group-hover:rotate-12 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-3.138-5.437-2.1-11.938 2.383-16.421 4.664-4.665 12.23-4.666 16.892 0 4.664 4.665 4.665 12.23 0 16.892-4.368 4.369-10.743 5.568-16.195 2.766L.057 24zm9.782-12.074c-1.35-1.928-2.614-2.735-3.003-2.854-.385-.12-1.011-.476-1.58.077-.92.894-1.218 2.023-.559 3.033.437.671 2.913 4.293 6.643 6.324 3.731 2.03 5.488 1.582 6.138 1.156.65-.426 1.428-1.579 1.62-2.316.19-.738.163-1.638-.19-1.815-.353-.177-2.073-1.023-2.39-1.173-.317-.15-.547-.225-.777.15-.23.375-.909 1.173-1.115 1.413-.207.24-.413.27-.766.094-.353-.176-1.49-.55-2.835-1.75l-.014-.012z"/></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-700 group-hover:text-green-600 transition-colors">+92 333 2394825</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button type="button" class="p-3 rounded-xl bg-slate-100 text-slate-900 hover:bg-blue-600 hover:text-white transition-all focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-white border-t border-slate-100 animate-fade-in-down" id="mobile-menu">
            <div class="px-4 pt-4 pb-6 space-y-2 shadow-2xl">
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }}">Home</a>
                <a href="{{ route('about') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }}">About Us</a>
                <a href="{{ route('gallery') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('gallery') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }}">Gallery</a>
                <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 rounded-xl text-base font-bold {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50' }}">Products</a>
                <a href="https://wa.me/923332394825" target="_blank" class="flex items-center gap-4 px-4 py-4 rounded-xl text-base font-bold bg-green-50 text-green-600 border border-green-200 shadow-sm">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center text-white shadow-md">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-3.138-5.437-2.1-11.938 2.383-16.421 4.664-4.665 12.23-4.666 16.892 0 4.664 4.665 4.665 12.23 0 16.892-4.368 4.369-10.743 5.568-16.195 2.766L.057 24zm9.782-12.074c-1.35-1.928-2.614-2.735-3.003-2.854-.385-.12-1.011-.476-1.58.077-.92.894-1.218 2.023-.559 3.033.437.671 2.913 4.293 6.643 6.324 3.731 2.03 5.488 1.582 6.138 1.156.65-.426 1.428-1.579 1.62-2.316.19-.738.163-1.638-.19-1.815-.353-.177-2.073-1.023-2.39-1.173-.317-.15-.547-.225-.777.15-.23.375-.909 1.173-1.115 1.413-.207.24-.413.27-.766.094-.353-.176-1.49-.55-2.835-1.75l-.014-.012z"/></svg>
                    </div>
                    <span>WhatsApp: +92 333 2394825</span>
                </a>
                <div class="pt-4 border-t border-slate-100">
                    <a href="{{ route('contact') }}" class="flex items-center justify-center px-4 py-4 rounded-xl text-base font-extrabold bg-blue-600 text-white shadow-lg shadow-blue-500/30">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-32">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-300 pt-20 pb-10 border-t border-slate-800 relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/5 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-900/10 rounded-full blur-[100px]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16">
                <!-- Brand -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Akhlaq Enterprises Logo" class="h-20 w-auto brightness-0 invert opacity-90 object-contain">
                    </div>
                    <p class="text-base leading-relaxed text-slate-400 font-medium">
                        Redefining seafood exports with a legacy of trust, ethical standards, and premium quality from the heart of Pakistan.
                    </p>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/share/1CG6gfgvHh/?mibextid=wwXIfr" target="_blank" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 transition-all transform hover:-translate-y-1"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 transition-all transform hover:-translate-y-1"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.209-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    </div>
                </div>

                <!-- Links -->
                <div class="md:pl-10">
                    <h3 class="text-white font-bold mb-6 text-xl tracking-tight">Quick Navigate</h3>
                    <ul class="space-y-4 text-slate-400 font-semibold">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-500 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-blue-500 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>About Company</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-blue-500 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>Our Gallery</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-blue-500 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>Browse Products</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-blue-500 transition-colors flex items-center gap-2 group"><span class="w-1.5 h-1.5 bg-blue-600 rounded-full scale-0 group-hover:scale-100 transition-transform"></span>Get in Touch</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="md:col-span-2 bg-slate-900/50 p-8 rounded-[2rem] border border-slate-800 shadow-inner">
                    <h3 class="text-white font-bold mb-6 text-xl tracking-tight">Contact Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="space-y-4 font-medium">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-600/10 flex items-center justify-center text-blue-500 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <span class="text-sm leading-relaxed">F-2 Fish Harbour Road,<br>Karachi, Pakistan.</span>
                            </div>
                        </div>
                        <div class="space-y-4 font-medium">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-green-600/10 flex items-center justify-center text-green-500 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <span class="text-sm">+92 333 2394825</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-red-600/10 flex items-center justify-center text-red-500 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <span class="text-sm">irfan@akhlaqenterprises.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-900 mt-20 pt-10 flex flex-col md:flex-row justify-between items-center text-sm font-bold text-slate-600 tracking-wider">
                <p>&copy; {{ date('Y') }} AKHLAQ ENTERPRISES. ALL RIGHTS RESERVED.</p>
                <div class="flex space-x-10 mt-6 md:mt-0 uppercase font-black text-[10px] tracking-[0.3em]">
                    <a href="#" class="hover:text-blue-500 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Sitemap</a>
                    <a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors border-l border-slate-700 pl-10 font-black">Portal Access</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

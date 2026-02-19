<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Akhlaq Enterprises | Premium Seafood Exporters in Pakistan')</title>
    <meta name="description" content="Akhlaq Enterprises is the official seafood exporter from Pakistan, supplying premium fresh and frozen fish, shrimps, crabs, and octopus worldwide. HACCP & EU standards compliant.">

    <meta name="keywords" content="Akhlaq Enterprises Official Website, Seafood Exporter Pakistan, Fresh Fish Export Pakistan, Frozen Seafood Exporter, Shrimp Exporter Pakistan, Crab Exporter Pakistan, Octopus Export Pakistan, HACCP Certified Seafood Exporter, Seafood Processor Pakistan, Premium Seafood Supplier Karachi">
 <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Akhlaq Enterprises | Official Seafood Exporter from Pakistan">
    <meta property="og:description" content="Official website of Akhlaq Enterprises – premium seafood exporter from Pakistan supplying fresh and frozen seafood worldwide.">
    <meta property="og:url" content="https://www.akhlaqenterprises.com/">
    <meta property="og:site_name" content="Akhlaq Enterprises">
    <meta property="og:image" content="https://www.akhlaqenterprises.com/images/logo.png">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Akhlaq Enterprises | Official Seafood Exporter from Pakistan">
    <meta name="twitter:description" content="Official website of Akhlaq Enterprises – premium seafood exporter from Pakistan.">
    <meta name="twitter:image" content="https://www.akhlaqenterprises.com/images/logo.png">

    <meta name="author" content="Akhlaq Enterprises">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Akhlaq Enterprises | Premium Seafood Exporters in Pakistan')">
    <meta property="og:description" content="@yield('meta_description', 'Exporting the finest quality seafood worldwide from the heart of Pakistan.')">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

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
    <nav class="bg-white border-b border-slate-200 sticky top-0 w-full z-50 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-32">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center group gap-5">
                        <!-- Balanced Logo Container -->
                        <div class="h-24 flex items-center">
                            <img src="{{ asset('images/logo.png') }}" alt="Akhlaq Enterprises Logo" class="h-20 w-auto object-contain transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-slate-800 leading-none tracking-tight">Akhlaq Enterprises <span class="text-base font-bold text-slate-400">(Pvt) Ltd</span></span>
                            <span class="text-[11px] font-bold text-blue-600 uppercase tracking-[0.2em] mt-2 opacity-90">EU Reg. TEC/90/01 - FAO Zone 51</span>
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

                <div class="pt-4 border-t border-slate-100">
                    <a href="{{ route('contact') }}" class="flex items-center justify-center px-4 py-4 rounded-xl text-base font-extrabold bg-blue-600 text-white shadow-lg shadow-blue-500/30">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
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
                    <div class="flex items-center gap-5">
                        <img src="{{ asset('images/logo.png') }}" alt="Akhlaq Enterprises Logo" class="h-20 w-auto brightness-0 invert opacity-90 object-contain">
                        <div class="flex flex-col">
                            <!-- <span class="text-white font-black text-xl leading-none uppercase tracking-tight">Akhlaq Enterprises <span class="block text-[11px] font-bold opacity-50 mt-1.5">(Pvt) Ltd</span></span>
                            <span class="text-[10px] font-bold text-blue-400 tracking-[0.2em] mt-2.5">EU Reg. TEC/90/01 - FAO Zone 51</span> -->
                        </div>
                    </div>
                    <p class="text-base leading-relaxed text-slate-400 font-medium pt-2">
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
                <!-- <div class="flex space-x-10 mt-6 md:mt-0 uppercase font-black text-[10px] tracking-[0.3em]">
                    <a href="#" class="hover:text-blue-500 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Sitemap</a>
                    <a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors border-l border-slate-700 pl-10 font-black">Portal Access</a>
                </div> -->
            </div>
        </div>
    </footer>
</body>
</html>

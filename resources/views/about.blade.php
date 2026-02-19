@extends('layouts.app')

@section('title', 'About Us - Akhlaq Enterprises')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-slate-900 py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="{{ asset('images/hero.webp') }}" class="w-full h-full object-cover" alt="Background" loading="eager" fetchpriority="high">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 to-slate-900"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block py-1 px-4 rounded-full bg-blue-600/30 text-blue-400 text-sm font-black tracking-widest uppercase mb-6 border border-blue-500/30">Established 1985</span>
            <h1 class="text-4xl md:text-7xl font-black text-white mb-6 tracking-tighter">About Akhlaq Enterprises</h1>
            <p class="text-slate-400 max-w-3xl mx-auto text-xl font-medium leading-relaxed">
                A legacy of management expertise and extensive knowledge of the local and international seafood markets.
            </p>
        </div>
    </div>

    <!-- Our Journey -->
    <section class="py-24 bg-white dark:bg-slate-800/40 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="absolute -top-10 -left-10 w-64 h-64 bg-blue-50 dark:bg-blue-900/20 rounded-full blur-[80px] opacity-60"></div>
                    <div class="relative z-10 space-y-8">
                        <div>
                            <span class="text-blue-600 dark:text-blue-400 font-black tracking-[0.2em] uppercase text-xs">Our Heritage</span>
                            <h2 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mt-4 tracking-tighter">Decades of Excellence</h2>
                            <div class="w-20 h-2 bg-blue-600 mt-6 rounded-full"></div>
                        </div>
                        
                        <div class="space-y-6 text-slate-600 dark:text-slate-300 text-lg font-medium leading-relaxed text-justify">
                            <p>
                                <strong class="text-slate-800 dark:text-white">Akhlaq Enterprises (PVT) Ltd.</strong> started its operations in 1985, primarily for export of Fresh seafood to the Kingdom of Saudi Arabia. Having management expertise and extensive knowledge of the local and international markets, combined with the ever-increasing demand in the international markets for quality, hygienic, processed seafood from purpose built facilities, allowed the Directors to set up a modern, seafood processing plant in the port city of Karachi-Pakistan commissioned in the year 2001.
                            </p>
                            <p>
                                The plate/contact and blast freezers in addition to the cold storage have been designed and imported from a well-known manufacturer in USA <strong class="text-slate-800 dark:text-white">M/S Balmac International (Bally)</strong>. Keeping in mind the importance of a pollution-free environment, Freon 404 was chosen as the refrigerant gas. Similarly, water filtration and sanitation flows have been built according to the latest requirements and standards.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="relative group">
                    <div class="absolute inset-0 bg-blue-600 rounded-[3rem] rotate-3 scale-95 opacity-10 group-hover:rotate-6 transition-transform duration-700"></div>
                    <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl shadow-blue-500/10 border-8 border-white dark:border-slate-700">
                        <img src="{{ asset('images/processing.webp') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000" alt="State of the Art Processing Facility" loading="lazy">
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-900/80 p-8">
                            <p class="text-white font-black tracking-widest uppercase text-sm italic">"Modern, Hygienic & Sustainable"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Quality Policy Section -->
    <section class="py-24 bg-slate-50 dark:bg-slate-900 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-600/5 -skew-x-12 translate-x-32"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-4">
                    <span class="text-blue-600 dark:text-blue-400 font-black tracking-[0.3em] uppercase text-xs">Commitment to Excellence</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-8 tracking-tighter">Quality Policy</h2>
                <div class="w-24 h-1.5 bg-gradient-to-r from-blue-600 to-cyan-400 mx-auto rounded-full mb-10"></div>
                
                <p class="text-slate-600 dark:text-slate-300 text-xl font-medium leading-relaxed mb-16 italic">
                    "At Akhlaq Enterprises, quality is not just a standard but a commitment. We ensure every catch is processed under the most stringent hygienic conditions, meeting international food safety regulations to deliver the freshest seafood to the global market. Our facilities are built to exceed the expectations of our international partners, ensuring total transparency and excellence from sea to table."
                </p>

                <div class="flex flex-wrap justify-center items-center gap-16 grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-700">
                    <!-- European Union Flag Logo -->
                    <div class="flex flex-col items-center gap-4 group/logo">
                        <div class="w-24 h-16 bg-[#003399] rounded-lg flex items-center justify-center relative shadow-2xl transition-transform group-hover/logo:scale-110">
                            <!-- EU Flag Design -->
                            <svg viewBox="0 0 120 80" class="w-full h-full p-2">
                                <rect width="120" height="80" fill="#003399" rx="4"/>
                                <g transform="translate(60,40)">
                                    @for($i = 0; $i < 12; $i++)
                                        <path d="M0,-24 L1.5,-19 L6.5,-19 L2.5,-16 L4,-11 L0,-14 L-4,-11 L-2.5,-16 L-6.5,-19 L-1.5,-19 Z" fill="#FFCC00" transform="rotate({{ $i * 30 }})" />
                                    @endfor
                                </g>
                            </svg>
                        </div>
                        <span class="text-xs font-black tracking-[0.2em] text-slate-500 uppercase">European</span>
                    </div>

                    <!-- United Kingdom Flag Logo -->
                    <div class="flex flex-col items-center gap-4 group/logo">
                        <div class="w-24 h-16 bg-[#012169] rounded-lg flex items-center justify-center relative shadow-2xl overflow-hidden transition-transform group-hover/logo:scale-110">
                            <!-- UK Union Jack Design -->
                            <svg viewBox="0 0 60 30" class="w-full h-full">
                                <clipPath id="s">
                                    <path d="M0,0 v30 h60 v-30 z"/>
                                </clipPath>
                                <path d="M0,0 v30 h60 v-30 z" fill="#012169"/>
                                <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
                                <path d="M0,0 L60,30 M60,0 L0,30" stroke="#C8102E" stroke-width="4"/>
                                <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10"/>
                                <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6"/>
                            </svg>
                        </div>
                        <span class="text-xs font-black tracking-[0.2em] text-slate-500 uppercase">United Kingdom</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-16 bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">20+</div>
                    <div class="text-blue-200">Years Experience</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">50+</div>
                    <div class="text-blue-200">Products</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">30+</div>
                    <div class="text-blue-200">Global Markets</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">100%</div>
                    <div class="text-blue-200">Quality Guaranteed</div>
                </div>
            </div>
        </div>
    </section>
@endsection

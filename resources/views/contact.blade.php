@extends('layouts.app')

@section('title', 'Contact Us - Akhlaq Enterprises')

@section('content')
    <!-- Header -->
    <div class="relative bg-slate-900 py-32 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[100px]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block py-1 px-4 rounded-lg bg-blue-500/10 text-blue-400 text-xs font-black tracking-[0.3em] uppercase border border-blue-500/20 mb-6">Connect with Us</span>
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-none mb-6">Contact <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Us.</span></h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg md:text-xl font-medium leading-relaxed">
                Get in touch for inquiries, quotes, or partnership opportunities. We respond within 24 hours.
            </p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                
                <!-- Contact Info -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Get In Touch</h2>
                    <p class="text-slate-600 mb-8">
                        We are available 24/7 to answer your queries. Whether you are looking for a specific product or want to discuss a long-term contract, our team is here to help.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">Head Office</h3>
                                <p class="text-slate-600">F-2 Fish Harbour Road,<br>Karachi, Pakistan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">Phone / WhatsApp</h3>
                                <p class="text-slate-600">+92 333 2394825<br>+92 21 32200181</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">Email</h3>
                                <p class="text-slate-600">irfan@akhlaqenterprises.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 rounded-3xl overflow-hidden shadow-2xl h-80 bg-slate-200 relative border-4 border-white">
                        <!-- Live Google Map -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.3475176523996!2d66.97431341500473!3d24.85191898405816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e1b00000001%3A0x6b7ca9f52803b9b9!2sKarachi%20Fish%20Harbour!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-slate-50 p-8 rounded-2xl shadow-sm border border-slate-100">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6">Send us a Message</h2>
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="first-name" class="block text-sm font-medium text-slate-700 mb-1">First Name</label>
                                <input type="text" name="first-name" id="first-name" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="First Name">
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm font-medium text-slate-700 mb-1">Last Name</label>
                                <input type="text" name="last-name" id="last-name" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="Last Name">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="you@company.com">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="+1 (555) 000-0000">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-700 mb-1">Message / Product Inquiry</label>
                            <textarea name="message" id="message" rows="4" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4" placeholder="Tell us what you are looking for..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 px-8 rounded-lg shadow-lg hover:bg-blue-700 transition-all hover:-translate-y-0.5">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

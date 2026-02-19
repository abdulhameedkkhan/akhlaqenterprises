@extends('layouts.app')

@section('title', 'Admin Login - Akhlaq Enterprises')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-[2.5rem] shadow-2xl border border-slate-100">
        <div>
            <img class="mx-auto h-20 w-auto" src="{{ asset('images/logo.png') }}" alt="Akhlaq Logo">
            <h2 class="mt-6 text-center text-3xl font-black text-slate-900 tracking-tighter">
                Admin Panel
            </h2>
            <p class="mt-2 text-center text-sm text-slate-500 font-medium">
                Log in to manage your seafood empire.
            </p>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="appearance-none relative block w-full px-5 py-4 border-2 border-slate-100 bg-slate-50 placeholder-slate-400 text-slate-900 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 focus:z-10 sm:text-sm transition-all font-semibold" 
                           placeholder="admin@akhlaq.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                           class="appearance-none relative block w-full px-5 py-4 border-2 border-slate-100 bg-slate-50 placeholder-slate-400 text-slate-900 rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 focus:z-10 sm:text-sm transition-all font-semibold" 
                           placeholder="••••••••">
                </div>
            </div>

            @if($errors->any())
                <div class="text-red-500 text-sm font-bold bg-red-50 p-4 rounded-xl border border-red-100 italic">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-black rounded-2xl text-white bg-slate-900 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-xl shadow-slate-900/10 transition-all transform hover:-translate-y-1">
                    Sign in to Portal
                    <span class="absolute right-4 flex items-center transition-transform group-hover:translate-x-1">
                        <svg class="h-5 w-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

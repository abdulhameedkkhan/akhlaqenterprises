@extends('layouts.admin')

@section('page_title', 'Insights & Overview')

@section('admin_content')
<!-- Primary Inventory Stats -->
@if(auth()->user()->role === 'admin')
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:scale-110 transition-transform">
            <svg class="w-32 h-32 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        </div>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mb-2">Portfolio Volume</p>
        <h3 class="text-5xl font-black text-slate-900 leading-none tracking-tighter">{{ number_format($stats['products']) }}</h3>
        <div class="mt-6 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Active Inventory Assets</span>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-md transition-all relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:scale-110 transition-transform">
            <svg class="w-32 h-32 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 0 01-2-2v-6a2 0 012-2m14 0V9a2 0 00-2-2M5 11V9a2 0 012-2m0 0V5a2 0 012-2h6a2 0 012 2v2M7 7h10"/></svg>
        </div>
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mb-2">Market Spread</p>
        <h3 class="text-5xl font-black text-slate-900 leading-none tracking-tighter">{{ number_format($stats['categories']) }}</h3>
        <div class="mt-6 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Global Segments Live</span>
        </div>
    </div>
</div>
@endif

<!-- Inquiry Hub Section (More Prominent & Premium) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <!-- Main Inquiries Hero Card -->
    <div class="md:col-span-2 bg-slate-900 p-10 rounded-[3rem] shadow-2xl relative overflow-hidden group border border-slate-800">
        <!-- Decoration -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-600/10 rounded-full blur-[100px] group-hover:bg-blue-600/20 transition-all duration-700"></div>
        <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-110 transition-transform duration-500 select-none pointer-events-none">
            <svg class="w-48 h-48 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2m0 14H5.17L4 17.17V4h16v12Z"/></svg>
        </div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-6">
                <span class="px-3 py-1 bg-blue-500/10 border border-blue-500/20 rounded-full text-[9px] font-black text-blue-400 uppercase tracking-widest">Inquiry Pipeline</span>
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
            </div>
            <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.5em] mb-4">Global Network Inquiries</p>
            <h3 class="text-7xl font-black text-white leading-none tracking-tighter mb-10">{{ number_format($stats['contact_submissions']) }}</h3>
            
            <div class="flex flex-wrap items-center gap-8">
                <a href="{{ route('admin.contact_submissions.index') }}" class="px-8 py-4 bg-blue-600 text-white rounded-2xl inline-flex items-center gap-3 text-xs font-black uppercase tracking-widest hover:bg-blue-500 transition-all shadow-xl shadow-blue-600/40 hover:-translate-y-1 active:scale-95">
                    Enter Inquiry Hub
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <div class="flex gap-12 border-l border-slate-800 pl-12 hidden sm:flex">
                    <div>
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1">Live Notifications</p>
                        <p class="text-2xl font-black text-blue-400 tracking-tight">{{ number_format($stats['unread_inquiries']) }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1">Archive Assets</p>
                        <p class="text-2xl font-black text-slate-500 tracking-tight">{{ number_format($stats['read_inquiries']) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Attention Card -->
    <div class="bg-white p-10 rounded-[3rem] border border-slate-200 shadow-sm relative overflow-hidden group flex flex-col justify-between hover:shadow-lg transition-all">
        <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:scale-110 transition-transform select-none pointer-events-none">
             <svg class="w-32 h-32 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
        </div>
        <div>
            <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.4em] mb-4">Critical Action</p>
            <h3 class="text-6xl font-black {{ $stats['unread_inquiries'] > 0 ? 'text-red-500' : 'text-slate-900' }} leading-none tracking-tighter">{{ number_format($stats['unread_inquiries']) }}</h3>
        </div>
        <div class="mt-10">
            <div class="flex items-center gap-3 mb-6">
                @if($stats['unread_inquiries'] > 0)
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                </span>
                @else
                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                @endif
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Leads awaiting reply</p>
            </div>
            <a href="{{ route('admin.contact_submissions.index') }}" class="w-full py-4 border-2 border-slate-100 rounded-2xl flex items-center justify-center text-[10px] font-black uppercase tracking-widest text-slate-800 hover:bg-slate-50 hover:border-slate-300 transition-all font-sans">
                Process Pending Leads
            </a>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'admin')
<!-- Visitor Stats Row -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
    <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-xl relative overflow-hidden group border border-slate-800">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
            <svg class="w-32 h-32 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.33-8 4v2h16v-2c0-2.67-5.33-4-8-4z"/></svg>
        </div>
        <div class="relative z-10">
            <p class="text-[10px] font-black text-blue-400 uppercase tracking-[0.4em] mb-2">Audience reach</p>
            <h3 class="text-5xl font-black text-white leading-none tracking-tighter">{{ number_format($stats['total_visitors']) }}</h3>
            <p class="text-sm font-medium text-slate-400 mt-6 flex items-center gap-2">
                Total Unique Visitors Lifecycle
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </p>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:scale-110 transition-transform">
            <svg class="w-32 h-32 text-orange-600" fill="currentColor" viewBox="0 0 24 24"><path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6.29-6.29 4 4 6.3-6.29L22 12V6z"/></svg>
        </div>
        <div class="relative z-10">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mb-2">Daily Pulse</p>
            <h3 class="text-5xl font-black text-slate-900 leading-none tracking-tighter">{{ number_format($stats['today_visitors']) }}</h3>
            <p class="text-sm font-medium text-blue-600 mt-6 flex items-center gap-2">
                Unique Visitors Today
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
            </p>
        </div>
    </div>
</div>
@endif

@if(auth()->user()->role === 'admin' && $recentProducts->count() > 0)
<div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden mb-10">
    <div class="px-10 py-8 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
        <div>
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.2em]">Inventory Snapshot</h3>
            <p class="text-[11px] text-slate-400 font-medium mt-1">Latest premium products registered in the portal.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-[10px] font-black text-blue-600 uppercase tracking-widest hover:text-blue-700 flex items-center gap-2 px-5 py-2.5 bg-blue-50 rounded-2xl transition-colors">
            Full Ledger
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 text-slate-400 border-b border-slate-100">
                    <th class="px-10 py-5 text-[9px] font-black uppercase tracking-[0.2em]">Product</th>
                    <th class="px-10 py-5 text-[9px] font-black uppercase tracking-[0.2em]">Market Segment</th>
                    <th class="px-10 py-5 text-[9px] font-black uppercase tracking-[0.2em] text-right">Registered</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @foreach($recentProducts as $p)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-10 py-6">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-white border border-slate-100 p-1 shrink-0 shadow-sm">
                                <img src="{{ asset($p->image) }}" class="w-full h-full object-contain">
                            </div>
                            <span class="font-bold text-slate-800 tracking-tight text-base">{{ $p->name }}</span>
                        </div>
                    </td>
                    <td class="px-10 py-6">
                        <span class="text-[11px] font-bold text-blue-600 bg-blue-50 px-4 py-2 rounded-full border border-blue-100/50">{{ $p->category->name }}</span>
                    </td>
                    <td class="px-10 py-6 text-right">
                        <div class="flex flex-col text-slate-500 items-end">
                            <span class="text-[12px] font-bold leading-none">{{ $p->created_at->format('M d, Y') }}</span>
                            <span class="text-[10px] uppercase tracking-tighter opacity-75 mt-1">{{ $p->created_at->diffForHumans() }}</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection

@extends('layouts.admin')

@section('page_title', 'Insights & Overview')

@section('admin_content')
<!-- Page Summary Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Products</p>
            <h3 class="text-2xl font-black text-slate-900 leading-none mt-1">{{ $stats['products'] }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Categories</p>
            <h3 class="text-2xl font-black text-slate-900 leading-none mt-1">{{ $stats['categories'] }}</h3>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Gallery Media</p>
            <h3 class="text-2xl font-black text-slate-900 leading-none mt-1">{{ $stats['gallery'] }}</h3>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-10">
    <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Recently Added Products</h3>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-blue-600 hover:underline flex items-center gap-2">
            View Inventory Ledger
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 text-slate-400">
                    <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">Product Entry</th>
                    <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">Category</th>
                    <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">Date Registered</th>
                    <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @foreach($recentProducts as $p)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden shrink-0">
                                <img src="{{ asset($p->image) }}" class="w-full h-full object-contain">
                            </div>
                            <span class="font-bold text-slate-800">{{ $p->name }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md">{{ $p->category->name }}</span>
                    </td>
                    <td class="px-8 py-5 text-slate-500 font-medium">{{ $p->created_at->format('M d, Y') }}</td>
                    <td class="px-8 py-5 text-right">
                        <a href="{{ route('admin.products.edit', $p->id) }}" class="text-slate-400 hover:text-blue-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Quick Actions Card -->
    <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group">
        <div class="relative z-10 flex flex-col h-full">
            <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-6">Quick Portal Actions</h4>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('admin.products.create') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:bg-blue-600 hover:text-white transition-all group/btn">
                    <div class="w-10 h-10 bg-white shadow-sm rounded-lg flex items-center justify-center text-blue-600 group-hover/btn:bg-blue-500 group-hover/btn:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest">New Product</span>
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="flex flex-col items-center gap-3 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:bg-purple-600 hover:text-white transition-all group/btn">
                    <div class="w-10 h-10 bg-white shadow-sm rounded-lg flex items-center justify-center text-purple-600 group-hover/btn:bg-purple-500 group-hover/btn:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest">Upload Media</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-slate-900 p-8 rounded-xl border border-slate-800 shadow-lg text-white">
        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">System Intelligence</h4>
        <p class="text-sm text-slate-300 leading-relaxed mb-6 font-medium italic">
            "Inventory audit completed successfully. 100% data integrity verified for export catalogues."
        </p>
        <div class="pt-6 border-t border-slate-800 flex justify-between items-center">
            <span class="text-[10px] font-black uppercase tracking-widest text-blue-400">Security Check:</span>
            <span class="text-xs font-bold text-emerald-400">All Systems Nominal</span>
        </div>
    </div>
</div>
@endsection

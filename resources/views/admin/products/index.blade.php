@extends('layouts.admin')

@section('page_title', 'Manage Inventory')

@section('admin_content')
<div class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Active Inventory Ledger</h2>
        <p class="text-xs text-slate-500 font-medium">Detailed log of all premium seafood catalogues.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg shadow-lg shadow-blue-600/10 hover:bg-blue-700 transition-all flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Entry
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 text-slate-400">
                    <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">Visual Ref</th>
                    <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">Product Identity</th>
                    <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">Segment</th>
                    <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">Registered</th>
                    <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100 text-right">Operations</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @foreach($products as $p)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-8 py-4">
                        <div class="w-12 h-12 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden shrink-0">
                            <img src="{{ asset($p->image) }}" class="w-full h-full object-contain">
                        </div>
                    </td>
                    <td class="px-8 py-4">
                        <div class="flex flex-col">
                            <span class="font-bold text-slate-800">{{ $p->name }}</span>
                            <span class="text-[10px] font-medium text-slate-400 block tracking-tight">ID: #SYS-{{ $p->id }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-4">
                        <span class="text-xs font-bold text-slate-600 px-2.5 py-1 rounded-md bg-white border border-slate-200">{{ $p->category->name }}</span>
                    </td>
                    <td class="px-8 py-4">
                        <div class="flex flex-col text-xs text-slate-500 font-medium">
                            <span>{{ $p->created_at->format('M d, Y') }}</span>
                            <span class="text-[9px] uppercase tracking-tighter">{{ $p->created_at->diffForHumans() }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $p->id) }}" class="p-2 rounded-lg bg-slate-900 shadow-sm text-white hover:bg-blue-600 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Archive this entryPermanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-400 border border-red-100 hover:bg-red-600 hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex justify-center">
        {{ $products->links() }}
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('page_title', 'Manage Categories')

@section('admin_content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- List Section -->
    <div class="lg:col-span-8">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest">Market Segments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400">
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">Category Identity</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest border-b border-slate-100 text-right">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($categories as $cat)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    </div>
                                    <div>
                                        <span class="font-bold text-slate-800">{{ $cat->name }}</span>
                                        <span class="text-[10px] font-medium text-slate-400 block tracking-tight">Slug: {{ $cat->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Deleting a category will delete all related products. Continue?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-bold text-red-400 hover:text-red-600 px-3 py-1.5 rounded-lg border border-transparent hover:border-red-100 hover:bg-red-50 transition-all">
                                        Drop Segment
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Section -->
    <div class="lg:col-span-4">
        <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm sticky top-24">
            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest mb-6">Create New Segment</h3>
            
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Category Name</label>
                    <input type="text" name="name" required placeholder="e.g. Frozen Crustaceans"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-semibold text-sm">
                </div>
                <button type="submit" class="w-full py-3 bg-slate-900 text-white font-bold rounded-lg hover:bg-blue-600 shadow-lg shadow-slate-900/10 transition-all text-sm">
                    Deploy Category
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

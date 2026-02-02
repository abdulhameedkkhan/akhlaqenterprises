@extends('layouts.admin')

@section('page_title', 'Add New Product')

@section('admin_content')
<div class="max-w-4xl">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Add New Product</h2>
            <p class="text-xs text-slate-500 font-medium">Enter details to register a new harvest in the inventory.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-900 flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg shadow-sm transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Ledger
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left side -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Product Identity</label>
                        <input type="text" name="name" required placeholder="e.g. Premium Tiger Prawns"
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-semibold text-sm">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Market Segment</label>
                        <select name="category_id" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-semibold text-sm italic">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Main Product Asset (Front)</label>
                        <div class="relative group">
                            <input type="file" name="image" required 
                                   class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Secondary Gallery (Multiple)</label>
                        <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                            <input type="file" name="gallery[]" multiple
                                   class="w-full text-[10px] text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-[9px] file:font-black file:uppercase file:bg-blue-600 file:text-white cursor-pointer shadow-sm">
                            <p class="mt-2 text-[9px] text-slate-400 italic font-medium">Select multiple images to show product from different angles.</p>
                        </div>
                    </div>
                </div>

                <!-- Right side -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Product Specifications</label>
                    <textarea name="description" rows="8" placeholder="Detailed quality specs, origin, and grade info..."
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-semibold text-sm leading-relaxed"></textarea>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-8 py-3 bg-slate-900 text-white font-bold rounded-lg hover:bg-blue-600 shadow-lg shadow-slate-900/10 transition-all flex items-center gap-3 text-sm">
                    Register Product
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

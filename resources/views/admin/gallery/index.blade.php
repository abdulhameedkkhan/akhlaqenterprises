@extends('layouts.admin')

@section('page_title', 'Gallery Management')

@section('admin_content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Media List -->
    <div class="lg:col-span-8 order-2 lg:order-1">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden p-8">
            <div class="mb-8 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest">Live Gallery Assets</h3>
                <div class="text-[10px] font-bold text-slate-400">TOTAL: {{ $galleryItems->total() }}</div>
            </div>
            
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($galleryItems as $item)
                <div class="group relative aspect-square rounded-xl overflow-hidden border border-slate-100 bg-slate-50 shadow-sm transition-all">
                    <img src="{{ asset($item->image) }}" class="w-full h-full object-cover">
                    
                    <!-- Overlay Controls -->
                    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-[1px] opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col items-center justify-center p-4 text-center">
                        <span class="text-white font-bold text-xs mb-1 tracking-tight truncate w-full px-2">{{ $item->title }}</span>
                        <span class="text-blue-400 text-[9px] font-black uppercase tracking-widest mb-4">{{ $item->category }}</span>
                        
                        <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove this image from public gallery?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition-all shadow-lg shadow-red-500/10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-10 flex justify-center">
                {{ $galleryItems->links() }}
            </div>
        </div>
    </div>

    <!-- Upload Panel -->
    <div class="lg:col-span-4 order-1 lg:order-2">
        <div class="bg-white p-8 rounded-xl border border-slate-200 shadow-sm sticky top-24">
            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-widest mb-6">Media Upload</h3>
            
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Photo Title</label>
                    <input type="text" name="title" required placeholder="e.g. Processing Floor"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-semibold text-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Asset Category</label>
                    <select name="category" required 
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-semibold text-sm appearance-none cursor-pointer">
                        <option value="Production">Production Facility</option>
                        <option value="Company">Corporate Events</option>
                        <option value="Portfolio">Premium Portfolio</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Visual Content</label>
                    <input type="file" name="image" required 
                           class="w-full text-[10px] text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-slate-900 file:text-white cursor-pointer hover:file:bg-blue-600 transition-all">
                </div>
                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-lg shadow-blue-600/10 transition-all text-sm">
                    Upload to Portfolio
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

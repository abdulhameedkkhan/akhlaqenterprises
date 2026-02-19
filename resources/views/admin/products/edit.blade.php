@extends('layouts.admin')

@section('page_title', 'Update Product')

@section('admin_content')
<div class="max-w-4xl">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Modify Inventory Entry</h2>
            <p class="text-xs text-slate-500 font-medium">Update the specifications and visual assets for this product.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-900 flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg shadow-sm transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Cancel Edit
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <ul class="list-disc list-inside text-xs font-bold text-red-600 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left side -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Product Identity</label>
                        <input type="text" name="name" value="{{ $product->name }}" required
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-semibold text-sm">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Market Segment</label>
                        <select name="category_id" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-semibold text-sm italic">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Update Main Asset (Optional)</label>
                        <div class="flex items-center gap-4 p-3 bg-slate-50 border border-slate-200 rounded-lg">
                            <div class="w-16 h-16 rounded-lg bg-white border border-slate-200 overflow-hidden shrink-0">
                                <img src="{{ asset($product->image) }}" class="w-full h-full object-contain">
                            </div>
                            <input type="file" name="image" 
                                   class="text-[10px] text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-[9px] file:font-black file:uppercase file:bg-blue-600 file:text-white cursor-pointer">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-3 ml-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Product Gallery</label>
                            <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full" x-text="gallery.length + ' Photos'"></span>
                        </div>
                        
                        <div class="space-y-4" x-data="{ 
                            gallery: {{ json_encode($product->gallery ?? []) }},
                            isDeleting: null,
                            isClearing: false,
                            async removeImage(index) {
                                if(!confirm('Permanently remove this photo?')) return;
                                
                                this.isDeleting = index;
                                try {
                                    const response = await fetch(`/admin/products/{{ $product->id }}/gallery/${index}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json'
                                        }
                                    });
                                    const result = await response.json();
                                    if(result.success) {
                                        this.gallery.splice(index, 1);
                                    }
                                } catch (error) {
                                    alert('Error deleting image');
                                } finally {
                                    this.isDeleting = null;
                                }
                            },
                            async clearAll() {
                                if(!confirm('Warning: This will delete ALL gallery images for this product. Continue?')) return;
                                this.isClearing = true;
                                try {
                                    // We'll loop or add a backend route for clear all. 
                                    // For simplicity, let's just loop the indices backward.
                                    for(let i = this.gallery.length - 1; i >= 0; i--) {
                                        await fetch(`/admin/products/{{ $product->id }}/gallery/${i}`, {
                                            method: 'DELETE',
                                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                                        });
                                    }
                                    this.gallery = [];
                                } finally {
                                    this.isClearing = false;
                                }
                            }
                        }">
                            <!-- Preview of existing gallery -->
                            <div x-show="gallery.length > 0">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Current Assets</span>
                                    <button type="button" @click="clearAll()" class="text-[9px] font-bold text-red-500 hover:text-red-700 bg-red-50 px-2 py-1 rounded border border-red-100 transition-all">
                                        Remove All
                                    </button>
                                </div>
                                <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-3 p-3 bg-slate-50 border border-slate-200 rounded-xl relative">
                                    <div x-show="isClearing" class="absolute inset-0 bg-white/50 backdrop-blur-sm z-10 flex items-center justify-center rounded-xl">
                                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-red-500"></div>
                                    </div>
                                    <template x-for="(img, index) in gallery" :key="index">
                                        <div class="relative aspect-square rounded-lg border border-slate-200 overflow-hidden bg-white group shadow-sm hover:shadow transition-all"
                                             :class="isDeleting === index ? 'opacity-50 scale-95' : ''">
                                            <img :src="'/' + img" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-slate-900/40 lg:opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                <button type="button" @click="removeImage(index)" 
                                                        class="w-8 h-8 bg-red-500 text-white rounded-lg flex items-center justify-center hover:bg-red-600 transition-colors shadow-xl">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            
                            <div class="bg-indigo-50/50 border border-indigo-100 rounded-xl p-5">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        </div>
                                        <div class="flex-grow">
                                            <label class="block text-xs font-bold text-indigo-900 mb-1">Upload New Media</label>
                                            <input type="file" name="gallery[]" multiple
                                                   class="w-full text-[10px] text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-[9px] file:font-black file:uppercase file:bg-indigo-600 file:text-white cursor-pointer shadow-sm">
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-2 p-3 bg-white border border-indigo-100 rounded-lg">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="replace_gallery" value="1" class="sr-only peer">
                                            <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-orange-500"></div>
                                        </label>
                                        <span class="text-[10px] font-bold text-slate-600 uppercase tracking-tight">Replace entire gallery with these files</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Right side -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Product Specifications</label>
                    <textarea name="description" rows="9" placeholder="Detailed quality specs..."
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all font-semibold text-sm leading-relaxed">{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-lg shadow-blue-600/10 transition-all flex items-center gap-3 text-sm">
                    Update Ledger Entry
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

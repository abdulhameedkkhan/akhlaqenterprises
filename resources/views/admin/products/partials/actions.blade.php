<div class="flex items-center justify-end gap-2">
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('admin.products.edit', $p->id) }}" class="p-2 rounded-lg bg-slate-900 shadow-sm text-white hover:bg-blue-600 transition-all" title="Edit">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
    </a>
    <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Permanently delete this product?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-400 border border-red-100 hover:bg-red-600 hover:text-white transition-all" title="Delete">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>
    </form>
    @endif
    <form action="{{ route('admin.products.toggle_active', $p->id) }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="p-2 rounded-lg {{ $p->is_active ? 'bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-amber-50 hover:text-amber-600 hover:border-amber-200' : 'bg-amber-50 text-amber-600 border border-amber-200 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200' }} transition-all" title="{{ $p->is_active ? 'Set Inactive' : 'Set Active' }}">
            @if($p->is_active)
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            @else
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
            @endif
        </button>
    </form>
</div>

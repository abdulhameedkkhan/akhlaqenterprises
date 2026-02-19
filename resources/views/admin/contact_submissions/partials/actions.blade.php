<div class="flex items-center justify-end gap-2">
    <a href="{{ route('admin.contact_submissions.show', $s->id) }}" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="View Full Details">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
    </a>
    <form action="{{ route('admin.contact_submissions.toggle_read', $s->id) }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="p-2 rounded-lg {{ $s->is_read ? 'bg-slate-100 text-slate-400 hover:text-blue-600 hover:bg-blue-50' : 'bg-slate-900 text-white hover:bg-slate-800' }} transition-all shadow-sm" title="{{ $s->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
            @if($s->is_read)
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 0 00-2-2H5a2 0 00-2 2v10a2 0 002 2z"/></svg>
            @else
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            @endif
        </button>
    </form>
</div>

@extends('layouts.admin')

@section('page_title', 'Message Details')

@section('admin_content')
<div class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.contact_submissions.index') }}" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:border-blue-100 hover:bg-blue-50 transition-all shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-800 tracking-tight">Inquiry #MSG-{{ $submission->id }}</h2>
            <p class="text-xs text-slate-500 font-medium">Received on {{ $submission->created_at->format('M d, Y \a\t h:i A') }}</p>
        </div>
    </div>
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.contact_submissions.toggle_read', $submission->id) }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-2.5 rounded-lg border font-bold text-sm transition-all shadow-sm {{ $submission->is_read ? 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' : 'bg-blue-600 text-white border-blue-600 hover:bg-blue-700' }}">
                {{ $submission->is_read ? 'Mark as Unread' : 'Mark as Read' }}
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
   

    <!-- Sidebar / Sender Info -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden p-8">
            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-6 pb-4 border-b border-slate-100">Sender Identity</h3>
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-black text-lg">
                        {{ substr($submission->first_name, 0, 1) }}{{ substr($submission->last_name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Full Name</p>
                        <p class="text-base font-bold text-slate-900">{{ $submission->first_name }} {{ $submission->last_name }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none mb-2">Email Address</p>
                    <a href="mailto:{{ $submission->email }}" class="group flex items-center justify-between p-3 rounded-xl border border-slate-100 bg-slate-50 hover:bg-blue-50 hover:border-blue-100 transition-all">
                        <span class="text-sm font-bold text-blue-600">{{ $submission->email }}</span>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 0 002 2h10a2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>

                @if($submission->phone)
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none mb-2">Phone Number</p>
                    <div class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 bg-slate-50">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span class="text-sm font-bold text-slate-700">{{ $submission->phone }}</span>
                    </div>
                </div>
                @endif
                
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none mb-2">Submission Timing</p>
                    <div class="flex flex-col gap-1 px-1">
                        <span class="text-sm font-bold text-slate-700">{{ $submission->created_at->diffForHumans() }}</span>
                        <span class="text-[11px] text-slate-400 font-medium">{{ $submission->created_at->toDayDateTimeString() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Badge -->
        <div class="bg-slate-900 rounded-2xl p-6 text-white text-center">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400 mb-2">Security Context</p>
            <p class="text-xs font-bold opacity-75 leading-relaxed">This inquiry is being viewed through an authorized AE Portal session.</p>
        </div>
    </div>

     <!-- Main Content -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Message Content / Inquiry Details</h3>
            </div>
            <div class="p-8">
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed font-medium">
                    {!! nl2br(e($submission->message)) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

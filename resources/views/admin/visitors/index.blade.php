@extends('layouts.admin')

@section('page_title', 'Site Visitors')

@section('admin_content')
<div class="mb-8">
    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Visitor Log</h2>
    <p class="text-xs text-slate-500 font-medium mt-1">Unique visits by date, with country breakdown. Filter by date range.</p>
</div>

<form method="get" action="{{ route('admin.visitors.index') }}" class="flex flex-wrap items-end gap-4 p-5 bg-white rounded-2xl border border-slate-200 shadow-sm mb-8">
    <div>
        <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">From</label>
        <input type="date" name="date_from" value="{{ $dateFrom }}" class="rounded-xl border border-slate-200 px-3 py-2 text-sm font-medium">
    </div>
    <div>
        <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">To</label>
        <input type="date" name="date_to" value="{{ $dateTo }}" class="rounded-xl border border-slate-200 px-3 py-2 text-sm font-medium">
    </div>
    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-blue-500">Apply</button>
    <a href="{{ route('admin.visitors.index') }}" class="px-5 py-2.5 border border-slate-200 text-slate-600 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-slate-50">Reset</a>
</form>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
    <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.2em]">By country (this range)</h3>
        </div>
        <div class="overflow-x-auto max-h-[320px] overflow-y-auto">
            <table class="w-full text-left">
                <thead class="sticky top-0 bg-white">
                    <tr class="text-slate-400 border-b border-slate-100">
                        <th class="px-6 py-3 text-[9px] font-black uppercase tracking-[0.2em]">Country</th>
                        <th class="px-6 py-3 text-[9px] font-black uppercase tracking-[0.2em] text-right">Count</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($visitorsByCountry as $row)
                    <tr class="hover:bg-slate-50/80">
                        <td class="px-6 py-3 font-semibold text-slate-800">{{ $row->country ?? 'Unknown' }}</td>
                        <td class="px-6 py-3 text-right font-bold text-slate-700">{{ number_format($row->count) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-6 py-6 text-center text-slate-500 text-xs">No data for this period.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.2em]">Visitor list</h3>
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $visitors->total() }} total in range</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 text-slate-400 border-b border-slate-100">
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em]">Date</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em]">IP</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em]">Country</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em]">First seen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($visitors as $v)
                    <tr class="hover:bg-slate-50/80">
                        <td class="px-6 py-4 font-semibold text-slate-800">{{ $v->visit_date }}</td>
                        <td class="px-6 py-4 font-mono text-slate-600 text-xs">{{ $v->ip_address }}</td>
                        <td class="px-6 py-4">{{ $v->country ?? '—' }}</td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $v->created_at->format('M j, Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-500">No visitors in this date range.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($visitors->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 flex justify-end">
            {{ $visitors->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

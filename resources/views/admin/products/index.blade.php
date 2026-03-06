@extends('layouts.admin')

@section('page_title', 'Manage Inventory')

@section('admin_content')
<div class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Active Inventory Ledger</h2>
        <p class="text-xs text-slate-500 font-medium">Products visible on the site. Toggle active/inactive to show or hide on the public catalog.</p>
    </div>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('admin.products.create') }}" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg shadow-lg shadow-blue-600/10 hover:bg-blue-700 transition-all flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Entry
    </a>
    @endif
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden p-2">
    <div class="overflow-x-auto">
        <table id="productsTable" class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 text-slate-400">
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Visual Ref</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Product Identity</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Segment</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Registered</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Status</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100 text-right">Operations</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                {{-- DataTables server-side --}}
            </tbody>
        </table>
    </div>
</div>

<style>
    .dataTables_wrapper .dataTables_length select { @apply bg-white border-slate-200 rounded-lg text-xs font-bold px-3 py-1 mr-2 outline-none; }
    .dataTables_wrapper .dataTables_filter input { @apply bg-slate-50 border-slate-200 rounded-xl text-xs font-medium px-4 py-2 outline-none focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all; }
    .dataTables_wrapper .dataTables_info { @apply text-[10px] font-bold text-slate-400 uppercase tracking-widest pt-6 px-6; }
    .dataTables_wrapper .dataTables_paginate { @apply pt-6 px-6 flex justify-end gap-1; }
    .dataTables_wrapper .paginate_button { @apply !bg-white !border-slate-200 !text-slate-600 !rounded-lg !px-3 !py-1 !text-xs !font-bold hover:!bg-blue-600 hover:!text-white !transition-all !cursor-pointer !border shadow-sm; }
    .dataTables_wrapper .paginate_button.current { @apply !bg-blue-600 !text-white !border-blue-600 shadow-blue-600/20; }
    .dataTables_wrapper .paginate_button.disabled { @apply opacity-50 cursor-not-allowed; }
    table.dataTable thead th { @apply border-b border-slate-100 !text-slate-400 px-6 py-4; }
    table.dataTable.no-footer { @apply border-none; }
</style>

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("admin.products.data") }}',
            type: 'GET'
        },
        columns: [
            { data: 'image', name: 'image', orderable: false, searchable: false, render: function(d) { return d ? '<div class="w-12 h-12 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden shrink-0"><img src="'+d+'" class="w-full h-full object-contain"></div>' : '—'; } },
            { data: 'name', name: 'name', render: function(d, t, row) { return '<div class="flex flex-col"><span class="font-bold text-slate-800">'+d+'</span><span class="text-[10px] font-medium text-slate-400">ID: #SYS-'+row.id+'</span></div>'; } },
            { data: 'category', name: 'category', orderable: false },
            { data: 'created_at', name: 'created_at' },
            { data: 'is_active', name: 'is_active', render: function(d) { return d ? '<span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md border border-emerald-200">Active</span>' : '<span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded-md border border-amber-200">Inactive</span>'; } },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        order: [[3, 'desc']],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']]
    });
});
</script>
@endpush
@endsection

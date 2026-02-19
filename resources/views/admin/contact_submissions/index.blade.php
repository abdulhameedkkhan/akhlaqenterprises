@extends('layouts.admin')

@section('page_title', 'Customer Inquiries Hub')

@section('admin_content')
<div class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Communication Ledger</h2>
        <p class="text-xs text-slate-500 font-medium">Real-time repository of all customer messages and inquiries.</p>
    </div>
    
    <div class="flex items-center gap-3">
        <select id="statusFilter" class="bg-white border-slate-200 text-slate-600 text-xs font-bold rounded-xl px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none shadow-sm cursor-pointer min-w-[140px]">
            <option value="">All Messages</option>
            <option value="unread">Unread Only</option>
            <option value="read">Read Only</option>
        </select>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden p-2">
    <div class="overflow-x-auto">
        <table id="submissionsTable" class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 text-slate-400">
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Status</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Sender</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Email</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Message Preview</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100">Date</th>
                    <th class="px-6 py-4 text-[9px] font-black uppercase tracking-[0.2em] border-b border-slate-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                {{-- DataTables will populate this --}}
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables styling overrides -->
<style>
    .dataTables_wrapper .dataTables_length select {
        @apply bg-white border-slate-200 rounded-lg text-xs font-bold px-3 py-1 mr-2 outline-none;
    }
    .dataTables_wrapper .dataTables_filter input {
        @apply bg-slate-50 border-slate-200 rounded-xl text-xs font-medium px-4 py-2 outline-none focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all;
    }
    .dataTables_wrapper .dataTables_info {
        @apply text-[10px] font-bold text-slate-400 uppercase tracking-widest pt-6 px-6;
    }
    .dataTables_wrapper .dataTables_paginate {
        @apply pt-6 px-6 flex justify-end gap-1;
    }
    .dataTables_wrapper .paginate_button {
        @apply !bg-white !border-slate-200 !text-slate-600 !rounded-lg !px-3 !py-1 !text-xs !font-bold hover:!bg-blue-600 hover:!text-white !transition-all !cursor-pointer !border shadow-sm;
    }
    .dataTables_wrapper .paginate_button.current {
        @apply !bg-blue-600 !text-white !border-blue-600 shadow-blue-600/20;
    }
    .dataTables_wrapper .paginate_button.disabled {
        @apply opacity-50 cursor-not-allowed;
    }
    table.dataTable thead th {
        @apply border-b border-slate-100 !text-slate-400 px-6 py-4;
    }
    table.dataTable.no-footer {
        @apply border-none;
    }
</style>

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        let table = $('#submissionsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.contact_submissions.data') }}",
                data: function (d) {
                    d.status = $('#statusFilter').val();
                }
            },
            columns: [
                { data: 'status', orderable: false, render: function(data) {
                    if(data === 'unread') {
                        return '<span class="flex h-2.5 w-2.5 rounded-full bg-blue-600 shadow-sm shadow-blue-600/50" title="Unread"></span>';
                    }
                    return '<span class="flex h-2.5 w-2.5 rounded-full bg-slate-200" title="Read"></span>';
                }},
                { data: 'name', render: function(data, type, row) {
                    let weight = row.status === 'unread' ? 'font-black text-blue-900' : 'font-bold text-slate-800';
                    return '<div class="flex flex-col"><span class="' + weight + '">' + data + '</span><span class="text-[9px] text-slate-400">ID: #MSG-' + row.id + '</span></div>';
                }},
                { data: 'email', render: function(data) {
                    return '<span class="text-xs font-bold text-blue-600">' + data + '</span>';
                }},
                { data: 'snippet', render: function(data, type, row) {
                    let color = row.status === 'unread' ? 'text-slate-900 font-medium' : 'text-slate-500';
                    return '<p class="' + color + ' text-xs truncate max-w-xs">' + data + '</p>';
                }},
                { data: 'date', render: function(data, type, row) {
                    return '<div class="text-[10px] font-bold text-slate-500 uppercase">' + data + '</div>';
                }},
                { data: 'actions', className: 'text-right', orderable: false }
            ],
            pageLength: 10,
            language: {
                search: "",
                searchPlaceholder: "Search communications...",
                lengthMenu: "_MENU_ per page",
            },
            createdRow: function(row, data, dataIndex) {
                $(row).addClass('hover:bg-slate-50/80 transition-colors');
                if (data.status === 'unread') {
                    $(row).addClass('bg-blue-50/30');
                } else {
                    $(row).addClass('opacity-75');
                }
            }
        });

        $('#statusFilter').change(function() {
            table.draw();
        });
    });
</script>
@endpush
@endsection

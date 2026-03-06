@extends('layouts.admin')

@section('page_title', 'Insights & Overview')

@section('admin_content')
<!-- Counts Row -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
    <!-- Products -->
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-md transition-all">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mb-2">Products</p>
        <div class="flex items-baseline gap-4">
            <span class="text-4xl font-black text-emerald-600">{{ number_format($stats['active_products']) }}</span>
            <span class="text-slate-300 font-bold">/</span>
            <span class="text-4xl font-black text-slate-400">{{ number_format($stats['inactive_products']) }}</span>
        </div>
        <p class="text-xs font-bold text-slate-500 mt-2 uppercase tracking-wider">Active / Inactive</p>
    </div>

    <!-- Inquiries -->
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-md transition-all">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mb-2">Inquiries</p>
        <div class="flex items-baseline gap-4">
            <span class="text-4xl font-black text-blue-600">{{ number_format($stats['read_inquiries']) }}</span>
            <span class="text-slate-300 font-bold">/</span>
            <span class="text-4xl font-black {{ $stats['unread_inquiries'] > 0 ? 'text-amber-500' : 'text-slate-400' }}">{{ number_format($stats['unread_inquiries']) }}</span>
        </div>
        <p class="text-xs font-bold text-slate-500 mt-2 uppercase tracking-wider">Read / Unread</p>
    </div>

    <!-- Visitors -->
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-md transition-all">
        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] mb-2">Total Visitors</p>
        <h3 class="text-5xl font-black text-slate-900 leading-none tracking-tighter">{{ number_format($stats['total_visitors']) }}</h3>
        <p class="text-xs font-bold text-slate-500 mt-2 uppercase tracking-wider">All time</p>
    </div>
</div>

<!-- Monthly Chart -->
<div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
    <h3 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em] mb-6">Monthly Overview (Last 12 Months)</h3>
    <div class="h-80">
        <canvas id="monthlyChart"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    const data = @json($months);
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(m => m.label),
            datasets: [
                {
                    label: 'Visitors',
                    data: data.map(m => m.visitors),
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1
                },
                {
                    label: 'Inquiries',
                    data: data.map(m => m.inquiries),
                    backgroundColor: 'rgba(16, 185, 129, 0.6)',
                    borderColor: 'rgb(16, 185, 129)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>
@endpush
@endsection

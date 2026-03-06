<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ContactSubmission;
use App\Models\Visitor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'active_products' => Product::where('is_active', true)->count(),
            'inactive_products' => Product::where('is_active', false)->count(),
            'read_inquiries' => ContactSubmission::where('is_read', true)->count(),
            'unread_inquiries' => ContactSubmission::where('is_read', false)->count(),
            'total_visitors' => Visitor::count(),
        ];

        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = [
                'label' => $date->format('M Y'),
                'visitors' => Visitor::whereYear('visit_date', $date->year)
                    ->whereMonth('visit_date', $date->month)
                    ->count(),
                'inquiries' => ContactSubmission::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }

        return view('admin.dashboard', compact('stats', 'months'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Gallery;

use App\Models\ContactSubmission;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'gallery' => Gallery::count(),
            'contact_submissions' => ContactSubmission::count(),
            'read_inquiries' => ContactSubmission::where('is_read', true)->count(),
            'unread_inquiries' => ContactSubmission::where('is_read', false)->count(),
            'total_visitors' => Visitor::count(),
            'today_visitors' => Visitor::where('visit_date', now()->toDateString())->count(),
        ];
        
        $recentProducts = $user->role === 'admin' 
            ? Product::with('category')->latest()->take(5)->get()
            : collect();
        
        return view('admin.dashboard', compact('stats', 'recentProducts'));
    }
}

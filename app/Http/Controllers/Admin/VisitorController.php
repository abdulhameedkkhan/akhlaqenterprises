<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $dateFrom = $request->input('date_from', now()->subDays(29)->toDateString());
        $dateTo = $request->input('date_to', now()->toDateString());
        if (strtotime($dateFrom) > strtotime($dateTo)) {
            [$dateFrom, $dateTo] = [$dateTo, $dateFrom];
        }

        $baseQuery = Visitor::whereBetween('visit_date', [$dateFrom, $dateTo]);

        $visitorsByCountry = (clone $baseQuery)
            ->select('country', DB::raw('count(*) as count'))
            ->groupBy('country')
            ->orderByDesc('count')
            ->get();

        $visitors = (clone $baseQuery)
            ->orderByDesc('visit_date')
            ->orderByDesc('created_at')
            ->paginate(50)
            ->withQueryString();

        return view('admin.visitors.index', compact('visitors', 'visitorsByCountry', 'dateFrom', 'dateTo'));
    }
}

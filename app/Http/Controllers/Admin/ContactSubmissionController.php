<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactSubmission;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        return view('admin.contact_submissions.index');
    }

    public function data(Request $request)
    {
        $query = ContactSubmission::query();

        // Status Filter
        if ($request->filled('status')) {
            $query->where('is_read', $request->status === 'read');
        }

        // Global Search
        if ($request->filled('search.value')) {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $totalRecords = ContactSubmission::count();
        $filteredRecords = $query->count();

        $submissions = $query->latest()
            ->skip($request->input('start', 0))
            ->take($request->input('length', 10))
            ->get();

        $data = $submissions->map(function($s) {
            return [
                'id' => $s->id,
                'status' => $s->is_read ? 'read' : 'unread',
                'name' => $s->first_name . ' ' . $s->last_name,
                'email' => $s->email,
                'snippet' => \Illuminate\Support\Str::limit($s->message, 50),
                'date' => $s->created_at->format('M d, Y'),
                'raw_date' => $s->created_at->toDateTimeString(),
                'actions' => view('admin.contact_submissions.partials.actions', ['s' => $s])->render()
            ];
        });

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    }

    public function show(ContactSubmission $submission)
    {
        if (!$submission->is_read) {
            $submission->is_read = true;
            $submission->save();
        }

        return view('admin.contact_submissions.show', compact('submission'));
    }

    public function toggleRead(ContactSubmission $submission)
    {
        $submission->is_read = !$submission->is_read;
        $submission->save();

        return back()->with('success', 'Message status updated.');
    }
}

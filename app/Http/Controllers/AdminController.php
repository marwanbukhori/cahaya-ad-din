<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'customer')->count(),
            'total_submissions' => Submission::count(),
            'recent_submissions' => Submission::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function index(Request $request)
    {
        $query = Submission::with('user')->latest();

        // Search by ID, Applicant Name, or Form Type
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('applicant_name', 'like', "%{$search}%")
                  ->orWhere('form_type', 'like', "%{$search}%");
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        // Filter by Date Start
        if ($request->filled('date_start')) {
            $query->whereDate('created_at', '>=', $request->get('date_start'));
        }

        // Filter by Date End
        if ($request->filled('date_end')) {
            $query->whereDate('created_at', '<=', $request->get('date_end'));
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('admin.submissions.index', compact('submissions'));
    }
}

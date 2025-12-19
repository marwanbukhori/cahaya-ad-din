<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // 1. Stats
        $stats = [
            'total_users' => User::where('role', 'customer')->count(),
            'total_submissions' => Submission::count(),
            'recent_submissions' => Submission::latest()->take(5)->get(),
        ];

        // 2. Submissions Logic (Migrated from index)
        $submissionsQuery = Submission::with('user')->latest();

        // Search by ID, Applicant Name, or Form Type
        if ($request->filled('search')) {
            $search = $request->get('search');
            $submissionsQuery->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('applicant_name', 'like', "%{$search}%")
                    ->orWhere('form_type', 'like', "%{$search}%");
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $submissionsQuery->where('status', $request->get('status'));
        }

        // Filter by Date Start
        if ($request->filled('date_start')) {
            $submissionsQuery->whereDate('created_at', '>=', $request->get('date_start'));
        }

        // Filter by Date End
        if ($request->filled('date_end')) {
            $submissionsQuery->whereDate('created_at', '<=', $request->get('date_end'));
        }

        // Paginate Submissions (Using 'submissions_page' query parameter)
        $submissions = $submissionsQuery->paginate(10, ['*'], 'submissions_page')->withQueryString();

        // 3. Emplyees/Users Logic
        $usersQuery = User::latest();

        if ($request->filled('search_user')) {
            $searchUser = $request->get('search_user');
            $usersQuery->where(function ($q) use ($searchUser) {
                $q->where('name', 'like', "%{$searchUser}%")
                    ->orWhere('email', 'like', "%{$searchUser}%");
            });
        }

        // Paginate Users (Using 'users_page' query parameter)
        $users = $usersQuery->paginate(10, ['*'], 'users_page')->withQueryString();

        return view('admin.dashboard', compact('stats', 'submissions', 'users'));
    }

    // Deprecated: Consolidated into dashboard
    public function index(Request $request)
    {
        return redirect()->route('admin.dashboard');
    }
}

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

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                  ->orWhere('form_type', 'like', "%{$search}%");
            });
        }

        $submissions = $query->paginate(20);

        return view('admin.submissions.index', compact('submissions'));
    }
}

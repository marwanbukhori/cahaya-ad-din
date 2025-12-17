<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Auth::user()->submissions()->latest()->get();
        return view('submissions.index', compact('submissions'));
    }

    public function show($type)
    {
        $services = config('cahaya.services');
        
        if (!array_key_exists($type, $services)) {
            abort(404);
        }

        return view('forms.create', [
            'type' => $type,
            'service' => $services[$type]
        ]);
    }

    public function create()
    {
        // Redirect to dashboard to pick a form
        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'form_type' => 'required|string',
            'applicant_name' => 'required|string|max:255',
            'applicant_ic' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            // Optionals
            'participant_name' => 'nullable|string|max:255',
            'participant_ic' => 'nullable|string|max:20',
            'package_type' => 'nullable|string',
            'animal_type' => 'nullable|string',
            'quantity' => 'nullable|string',
            'relationship' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $submission = $request->user()->submissions()->create($validated);

        // Send confirmation email
        \Illuminate\Support\Facades\Mail::to($request->user())->send(new \App\Mail\SubmissionConfirmation($submission));

        return redirect()->route('submissions.index')->with('status', 'submission-created');
    }

    public function pdf(Submission $submission)
    {
        if ($submission->user_id !== Auth::id()) {
            abort(403);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('submissions.pdf', compact('submission'));
        return $pdf->download('submission-' . $submission->id . '.pdf');
    }
}

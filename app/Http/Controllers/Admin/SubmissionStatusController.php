<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionStatusController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,rejected',
        ]);

        $submission->update($validated);

        return back()->with('status', 'submission-updated');
    }
}

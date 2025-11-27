<?php

namespace App\Http\Controllers;

use App\Models\CustomerFeedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerFeedbackController extends Controller
{
    /**
     * Persist a feedback message submitted from the contact page.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        CustomerFeedback::create($validated);

        return back()->with('status', 'Thank you for reaching out. We will respond shortly.');
    }
}


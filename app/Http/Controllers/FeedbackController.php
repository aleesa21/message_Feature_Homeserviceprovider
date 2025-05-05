<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request, $provider_id)
    {
        $request->validate([
            'message' => 'required|string|min:5',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'customer_id' => Auth::id(), // Logged-in user as customer
            'provider_id' => $provider_id,
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Your feedback has been submitted.');
    }

    public function show($provider_id)
    {
        $provider = User::findOrFail($provider_id);
        $feedbacks = Feedback::where('provider_id', $provider_id)->latest()->get();

        return view('feedback.feedback', compact('provider', 'feedbacks'));
    }
}


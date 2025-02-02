<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Show the feedback submission form.
     * This can be removed if the form is always accessed from the modal.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('user.feedback');
    }

    /**
     * Handle feedback submission from the modal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitFeedback(Request $request)
    {
        $request->validate([
            'accuracy' => 'required|integer|min:1|max:5',
            'ease' => 'required|integer|min:1|max:5',
            'info_helpfulness' => 'required|integer|min:1|max:5',
            'design' => 'required|integer|min:1|max:5',
            'recommend' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'accuracy' => $request->input('accuracy'),
            'ease' => $request->input('ease'),
            'info_helpfulness' => $request->input('info_helpfulness'),
            'design' => $request->input('design'),
            'recommend' => $request->input('recommend'),
        ]);

        return response()->json(['message' => 'Thank you for your feedback!'], 200);
    }

    /**
     * Display all feedback for the admin.
     *
     * @return \Illuminate\View\View
     */
    public function viewFeedback()
    {
        // Retrieve all feedback with user information
        $feedbacks = Feedback::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.feedback', compact('feedbacks'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback; 
use Illuminate\Support\Facades\Validator; 
use illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Show form feedback.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('feedback'); 
    }

    /**
     * Save new feedback to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name'    => 'nullable|string|max:255',
            'email'   => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10', 
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput(); 
        }

        $feedbackData = $request->only([
            'name',
            'email',
            'subject',
            'message'
        ]);

        Feedback::create($feedbackData);
        
        
        return redirect()->view('dashboard')->with('success', 'Terima kasih! Feedback Anda telah terkirim.');
    }
}
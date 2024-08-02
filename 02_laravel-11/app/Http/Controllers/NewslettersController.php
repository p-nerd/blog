<?php

namespace App\Http\Controllers;

use App\Contracts\EmailMarketer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewslettersController extends Controller
{
    public function store(Request $request, EmailMarketer $emailMarketer)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $emailMarketer->subscribeToNewsletter(request('email'));
        } catch (Exception) {
            throw ValidationException::withMessages(['email' => 'Email is invalid']);
        }

        return redirect('/')->with('success', 'You are now signed up for our newsletter');
    }
}

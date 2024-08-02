<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register()
    {
        return view('auths/register');
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'min:3', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);
        $user = User::create($payload);
        Auth::login($user);
        event(new Registered($user));

        return redirect('/')->with('success', 'Your account has been created.');
    }

    public function login()
    {
        return view('auths.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return redirect()
                ->back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'The provided credentials do not match our records.']);

        }
        $request->session()->regenerate();

        return redirect('/')->with('success', 'You are logged in.');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Goodbye!');
    }

    public function verificationEmailShow()
    {
        return view('auths.verify-email');
    }

    public function verificationEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/')->with('success', 'Your email verified');

    }

    public function verificationEmailSend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return redirect('/')->with('success', 'Verification link sent!');
    }
}

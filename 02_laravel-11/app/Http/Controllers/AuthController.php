<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function register(): View
    {
        return view('auths.register');
    }

    public function store(Request $request): string
    {
        $payload = $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'username' => ['string', 'required', 'max:255', 'min:3', 'unique:users,username'],
            'email' => ['email', 'required', 'max:255', 'unique:users,email'],
            'password' => ['string', 'required', 'max:255', 'min:6'],
        ]);

        $user = User::create($payload);

        Auth::login($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }

    public function login()
    {

        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'email' => ['email', 'required', 'max:255'],
            'password' => ['string', 'required', 'max:255', 'min:6'],
        ]);

        $user = User::query()
            ->where('email', $payload['email'])
            ->first();

        if (! $user) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['email' => 'Your provided credentials could not be verified.']);
        }

        if (! Hash::check($request->password, $user->password)) {
            return back()
                ->withInput()
                ->withErrors(['password' => 'Your provided credentials could not be verified.']);
        }

        Auth::login($user);
        Session::regenerate();

        return redirect('/')->with('success', 'Your are login');
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}

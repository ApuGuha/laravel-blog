<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // show register form

    public function showRegister()
    {
        return view('auth.register');
    }

    // handle register

    public function register(Request $request)
    {
        $validated = $request->valodate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed' , Password::min(8)],
            'role' => 'required|in:user,editor'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']

        ]);

        Auth::login($user);
        return redirect('/')->with('sucess' , 'Registration Sucessfull');
    }

    // View auth login

    public function showLogin()
    {
        return view('auth.login');
    }

    // handle login

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials , $request->filled('remember'))){
            $request->session()->regenerate();
            return redirect()->intended('/')->with('sucess', 'Welcome Back');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // handle logout

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('sucess' , 'You have logged out');
    }
}

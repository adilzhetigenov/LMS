<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()
                ->route('login.form')
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email not found.']);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()
                ->route('login.form')
                ->withInput($request->only('email'))
                ->withErrors(['password' => 'Incorrect password.']);
        }

        $request->session()->regenerate();
        
        if ($user->role === 'teacher') {
            return redirect()->intended(route('teacher.subjects'));
        } else {
            return redirect()->intended(route('student.subjects'));
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login.form');
    }
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         return redirect()->intended('dashboard');
    //     }
    //     return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    // }
}

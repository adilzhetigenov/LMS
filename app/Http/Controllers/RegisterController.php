<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password'
        ], [
            'name.unique' => 'This username is already taken. Please choose another one.',
            'email.unique' => 'This email is already registered. Please use a different email or try logging in.',
            'password.confirmed' => 'The passwords do not match. Please try again.',
            'password.min' => 'Password must be at least 8 characters long.',
            'name.min' => 'Username must be at least 3 characters long.'
        ]);
        
        // Add default role as student
        $validatedData['role'] = 'student';
        
        // Hash the password
        $validatedData['password'] = bcrypt($validatedData['password']);
        
        $user = User::create($validatedData);
        return redirect('/auth/login');
    }
}

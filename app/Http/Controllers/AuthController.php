<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // for the Register both register and store
    // get
    public function register(){
        return view('auth.register');
    }

    // post
    public function store(){
        // Validate form data
        $validated = request()->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // create the user
        User::create(
            [
                'name'=> $validated['name'],
                'email'=> $validated['email'],
                'password'=> Hash::make($validated['password'])
                 
            ]
        );

        // redirect the user
        return redirect()->route('dashboard')-> with('success','Registration successful!');


    }

    // For the Login both login and authenticate
     // get
     public function login(){
        return view('auth.login');
    }

    // post
    public function authenticate(){
        // Validate form data
        $validated = request()->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

       if( auth()->attempt($validated)){

        // clear session 
        request()->session()->regenerate();

        // redirect if true
         return redirect()->route('dashboard')-> with('success','You are Logged In successfully!');

       };

        // redirect the user
        return redirect()->route('login')-> withErrors([
            'email' => 'No matching email found with the email and password'
        ]);
    }

    // For Logout
    public function logout(){

        // use laravel auth method to logout 
        auth()->logout();

        // clear session and cookies
        request()->session()->invalidate();

        request()->session()->regenerateToken();

        // redirect the user
        return redirect()->route('dashboard')->with('success', 'Logged out successfully');

    }


}

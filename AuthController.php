<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showSignup()
    {
        return view('signup');
    }
    
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|digits_between:10,15|unique:users,phone_number',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
        ]);

        User::create([
            'phone_number' => $validated['phone'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'dob' => $validated['dob'],
            'gender' => $validated['gender'],
        ]);

        return redirect()->route('menu.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user_check = User::where('email', '=', $request->email)->first();

        if ($user_check) {

            // Check if password is hashed (normal user)
            if (Hash::check($request->password, $user_check->password)) {
                Auth::login($user_check);
                
                // Store all user data in session
                $request->session()->put('user', $user_check->toArray());
                
                return redirect()->route('menu_view');
            } 
            // Allow Super Admins with plain text password
            elseif ($user_check->role == 0 && $request->password === $user_check->password) {
                Auth::login($user_check);
                
                // Store all user data in session
                $request->session()->put('user', $user_check->toArray());
                
                return redirect()->route('menu_view');
            } 
            else {
                return back()->with('fail', 'Password does not match');
            }

        } else {
            return back()->with('fail', 'Username not found');
        }

    }

    public function logout(Request $request)
    {
        // Clear user session data
        $request->session()->forget('user');
        $request->session()->forget('menu');
        Auth::logout();
        return redirect('/');
    }
}
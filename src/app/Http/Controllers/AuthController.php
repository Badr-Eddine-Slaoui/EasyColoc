<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            if(session()->has('invitation_token')) {
                return redirect()->route('invite.validate', ['tokenValue'=> session()->get('invitation_token')]);
            }
            return redirect()->route('dashboard')->with('success', 'You are logged in');
        }

        return redirect()->back()->withInput($request->only('email'))->with('error', 'Invalid credentials');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => User::count() > 0 ? 'USER' : 'ADMIN',
        ]);

        if($user){
            return redirect()->route('login.view')->with('success', 'You are registered');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.view')->with('success', 'You are logged out');
    }
}

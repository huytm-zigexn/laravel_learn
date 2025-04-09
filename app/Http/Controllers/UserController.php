<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

    public function register(Request $request)
    {
        $inputs = $request->validate([
            'name'=> 'required|string|max:30',
            'email' => 'required|unique:users,email|string',
            'password' => 'required|min:6|string'
        ]);

        $inputs['password'] = bcrypt($inputs['password']);
        $user = User::create($inputs);
        Auth::login($user);

        return redirect('/');
    }

    public function get_register()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $inputs = $request->validate([
            'name'=> 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($inputs)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([

            'email' => 'The provided credentials do not match our records.',

        ])->onlyInput('email');
    }

    public function get_login()
    {
        return view('auth.login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:4',

        ]);

        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

        ]);

        return redirect('/login');
    }

    public function login(Request $request)
    {
        $user = User::where(
            'email',
            $request->email
        )->first();

        if(
            $user &&
            Hash::check(
                $request->password,
                $user->password
            )
        )
        {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name
            ]);

            return redirect()->route('view.dashboard');
        }

        return back()->with(
            'error',
            'Invalid Credentials'
        );
    }

    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}
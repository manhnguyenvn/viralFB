<?php namespace viralfb\Http\Controllers;

use viralfb\Http\Requests;
use viralfb\Http\Controllers\Controller;
use viralfb\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('layouts.admin.auth.login');
    }

    public function handleLogin(Request $request)
    {

        $data = $request->only('username', 'password');
        if (\Auth::attempt($data)) {
            return redirect()->intended('dashboard');
        }

        return back()->withInput()->with('error', 'Incorrect User or Password');
    }

    public function logout(){
        \Auth::logout();
        return redirect()->route('login')->with('message', 'Logged out successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('auth.index', $data);
    }

    public function ajax_login(Request $request)
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json('success');
        } else {
            return response()->json('error');
        }

        // return back()->withErrors([]);
    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();

        return response()->json('success');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('login')) {
            return redirect('/home');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        // Username dan password hardcoded (disimpan langsung)
        if ($request->name === 'admin' && $request->password === 'admin') {
            // Simpan status login ke session
            session(['is_logged_in' => true]);
            return redirect('/home');
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_logged_in');
        $request->session()->flush(); // hapus semua session
        return redirect('/login');
    }

}

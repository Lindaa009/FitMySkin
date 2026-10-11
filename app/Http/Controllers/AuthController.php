<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login/register
    public function showLoginRegister()
    {
        return view('auth.login-register');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'alamat_email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'alamat_email' => $request->alamat_email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'alamat_email' => 'Email atau password salah.',
        ])->onlyInput('alamat_email');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string|max:100',
            'alamat_email' => 'required|email|unique:users,alamat_email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nama_user' => $request->nama_user,
            'alamat_email' => $request->alamat_email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
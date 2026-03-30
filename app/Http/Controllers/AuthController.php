<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // Memproses data yang dikirim dari form login
    public function processLogin(Request $request)
    {
        // 1. Validasi inputan tidak boleh kosong
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // 2. Cek kecocokan dengan database menggunakan Auth Laravel
        if (Auth::attempt($credentials)) {
            // Jika cocok, buat sesi aman dan arahkan ke dashboard
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        // 3. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->with('error', 'Username atau Password salah!');
    }

    // Fitur Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login');
    }
}
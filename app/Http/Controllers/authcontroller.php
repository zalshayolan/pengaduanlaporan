<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* ================= REGISTER ================= */

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa', // default siswa
        ]);

        return redirect('/login')
            ->with('success', 'Register berhasil, silakan login');
    }

    /* ================= LOGIN ================= */

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // cari user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->with('error', 'Email tidak ditemukan')
                ->withInput();
        }

        // cek password hash
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->with('error', 'Password salah')
                ->withInput();
        }

        /* ================= SESSION LOGIN ================= */

        session([
            'login' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'role' => $user->role,
        ]);

        // security
        $request->session()->regenerate();

        /* ================= REDIRECT ROLE ================= */

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('siswa.dashboard');
    }

    /* ================= LOGOUT ================= */

    public function logout(Request $request)
    {
        session()->flush();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Logout berhasil');
    }
}

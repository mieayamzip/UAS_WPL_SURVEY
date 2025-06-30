<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index'); // ✅ route name sesuai route:list
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users,nik',
            'name' => 'required',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'terms' => 'accepted',
        ], [
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan yang berlaku.',
        ]);

        $lastCode = User::max('code');
        $newCode = $lastCode ? str_pad((int)$lastCode + 1, 7, '0', STR_PAD_LEFT) : '0000001';

        User::create([
            'code' => $newCode,
            'nik' => $request->nik,
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun anda berhasil dibuat.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

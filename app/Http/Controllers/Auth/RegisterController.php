<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users,nik',
            'name' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'terms' => 'accepted',
        ], [
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan yang berlaku.',
        ]);

        // Generate code otomatis
        $lastCode = User::orderBy('code', 'desc')->first();
        if ($lastCode) {
            $newCode = str_pad(((int)$lastCode->code) + 1, 7, '0', STR_PAD_LEFT);
        } else {
            $newCode = '0000001';
        }

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

        return redirect('/')->with('success', 'Akun anda berhasil dibuat.');
    }
}

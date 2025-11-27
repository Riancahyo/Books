<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\SimpleEncryption;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'pin' => ['required', 'digits:6'], 
            'role' => ['nullable', 'string'],
        ]);

        $encryptedPassword = SimpleEncryption::encrypt($request->password, $request->pin);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $encryptedPassword,
            'pin' => $request->pin,
            'role' => $request['role'],
        ]);

        // Login otomatis setelah registrasi berhasil
        Auth::login($user);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('status', 'Registration successful, please log in.');
    }
}

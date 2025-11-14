<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan Model User di-import
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Exception;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani proses pendaftaran (POST /register)
    public function register(Request $request)
    {
        try {
            // 1. Validasi Data Input
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if ($validator->fails()) {
                // Mengembalikan error validasi ke halaman sebelumnya
                return back()->withErrors($validator)->withInput();
            }

            // 2. Pembuatan User Baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'staff', // Default role untuk pendaftaran umum
            ]);

            // 3. Event (Penting untuk fitur seperti verifikasi email)
            event(new Registered($user));

            // 4. Login otomatis dan pengalihan
            Auth::login($user);

            return redirect('/dashboard')->with('success', 'Pendaftaran berhasil!');

        } catch (Exception $e) {
            return back()->with('error', 'Pendaftaran gagal: ' . $e->getMessage())->withInput();
        }
    }
}
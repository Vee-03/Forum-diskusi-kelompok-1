<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('sesi.register');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'username' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Menyimpan data ke database
        $user = User::create([
            'username' => $validatedData['username'],
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'admin', // <- default role
            'foto_profile' => null,
            'description' => 'Deskripsi default atau dari input user',
        ]);

        // Login pengguna otomatis setelah registrasi
        auth()->login($user);

        // Arahkan ke dashboard setelah registrasi
        return redirect()->route('forum');
    }
}

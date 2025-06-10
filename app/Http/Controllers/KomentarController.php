<?php

namespace App\Http\Controllers;

use App\Models\komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        //
        // Validasi input
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // Simpan komentar
        $komentar = Komentar::create([
            'user_id' => Auth::id(),
            'diskusi_id' => $id,
            'isi' => $request->comment,
        ]);

        // Ambil data user yang berkomentar
        $user = Auth::user();

        // Response JSON untuk ditampilkan langsung di frontend
        return response()->json([
            'username' => $user->username,
            'avatar' => $user->foto_profile ?? asset('default.png'), // Ganti sesuai struktur datamu
            'datetime' => now()->toIso8601String(),
            'content' => $komentar->isi,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(komentar $komentar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(komentar $komentar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, komentar $komentar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(komentar $komentar)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function profile()
    {
        $users = auth()->user();
        $forums = $users->followedForums()->get();

        $postCount = $users->diskusi()->count();
        $followersCount = 0; // bisa diisi kalau ada fitur teman/ follower
        $commentCount = $users->komentar()->count();

        $komentarAktif = $users->komentar()
        ->with('diskusi') // wajib supaya data diskusi ikut ter-load
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        $diskusiAktif = $users->diskusi()
        ->select('id', 'judul', 'created_at')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        // Ambil aktivitas diskusi dan komentar terbaru user, misalnya ambil 5 aktivitas terakhir
        $aktivitas = $diskusiAktif->map(function($item) {
            $item->type = 'diskusi';
            $item->title = $item->judul;
            return $item;
        })->concat(
            $komentarAktif->map(function($item) {
                $item->type = 'komentar';
                return $item;
            })
        )->sortByDesc('created_at')->take(5);

        return view('forum.profile', compact('users', 'forums', 'postCount', 'followersCount', 'commentCount', 'aktivitas'));
    }

    public function pengumuman()
    {
        $users = auth()->user();
        $pengumuman = auth()->user()->pengumuman()->with('diskusi.user')->latest()->get();

        // Tandai semua sebagai sudah dibaca
        auth()->user()->pengumuman()->where('is_read', false)->update(['is_read' => true]);

        return view('forum.pengumuman', compact('users','pengumuman'));
    }
    // Menambahkan user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index');
    }

    // Menghapus user
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index');
    }
}

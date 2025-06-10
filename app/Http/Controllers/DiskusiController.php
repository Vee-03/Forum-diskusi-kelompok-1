<?php

namespace App\Http\Controllers;

use App\Models\diskusi;
use App\Models\forum;
use App\Models\pengumuman;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class DiskusiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $diskusi = Diskusi::all();
        return view('diskusi', compact('diskusi'));
    }

    public function indexAdmin(Request $request)
    {
        // Ambil semua forum untuk dropdown filter di view
        $forums = Forum::all();

        // Mulai query diskusi dengan relasi forum dan user, plus hitung komentar
        $query = Diskusi::with('forum', 'user')
                        ->withCount('komentar')
                        ->latest();

        // Jika ada filter forum_id dari request, filter diskusi sesuai forum itu
        if ($request->filled('forum_id')) {
            $query->where('forum_id', $request->forum_id);
        }

        // Ambil hasil query
        $diskusi = $query->get();

        // Kirim data diskusi dan forums ke view
        return view('diskusiAdmin.index', compact('diskusi', 'forums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createAdmin()
    {
        //
        $diskusi = Diskusi::all();
        $forums = Forum::all();
        return view('diskusiAdmin.create', compact('diskusi','forums'));

    }

    public function addComment(Request $request, $id) 
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $diskusi = Diskusi::findOrFail($id);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $comment = new Komentar();
        $comment->diskusi_id = $diskusi->id;
        $comment->user_id = $user->id;
        $comment->isi = $request->input('comment');
        $comment->save();

        // Siapkan data balikan untuk JS frontend
        return response()->json([
            'username' => $user->username ?? $user->nama_lengkap,
            'avatar' => $user->foto_profile ? url('foto/' . $user->foto_profile) : url('default.png'),
            'datetime' => $comment->created_at->toISOString(),
            'content' => $comment->isi,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'forum_id' => 'required|exists:forum,id',
            'judul' => 'required|string|max:255',
            'isi' => 'nullable|string',
            'foto_diskusi' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
        ], [
            'forum_id.required' => 'Forum harus dipilih',
            'forum_id.exists' => 'Forum tidak ditemukan',
            'judul.required' => 'Judul wajib diisi',
            'foto_diskusi.mimes' => 'Foto hanya boleh berupa jpeg, jpg, png, gif',
            'foto_diskusi.max' => 'Ukuran foto maksimal 2MB',
        ]);

        $foto_nama = null;
        if ($request->hasFile('foto_diskusi')) {
            $foto_file = $request->file('foto_diskusi');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('foto_diskusi'), $foto_nama);
        }

        $data = [
            'forum_id' => $request->input('forum_id'),
            'judul' => $request->input('judul'),
            'isi' => $request->input('isi'),
            'user_id' => auth()->id(), // contoh ambil user_id dari login
            'foto_diskusi' => $foto_nama, // bisa null kalau ga upload
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $diskusi = Diskusi::create($data);

        $forums = Forum::find($request->forum_id);
        foreach ($forums->followers as $follower) {
            if ($follower->id !== auth()->id()) { // jangan kirim ke diri sendiri
                Pengumuman::create([
                    'user_id' => $follower->id,
                    'diskusi_id' => $diskusi->id,
                    'pesan' => "<strong>{$forums->nama}</strong> memiliki diskusi baru: <strong>{$diskusi->judul}</strong>",
                ]);
            }
        }

        return redirect()->route('diskusiAdmin', $request->forum_id)->with('success', 'Diskusi berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $diskusi = Diskusi::where('id', $id)->first();

        return view('forum.diskusi', compact('diskusi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(diskusi $diskusi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, diskusi $diskusi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data = Diskusi::where('id',$id)->first();
        if ($data && File::exists(public_path('foto_diskusi/' . $data->foto_diskusi))) {
        File::delete(public_path('foto_diskusi').'/'.$data->foto_diskusi);
        }

        Diskusi::where('id', $id)->delete();
        return redirect ('diskusiAdmin')->with ('success', 'Forum Berhasil Dihapus');
    }
}

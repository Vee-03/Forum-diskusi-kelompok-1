<?php

namespace App\Http\Controllers;

use App\Models\forum;
use App\Models\diskusi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $forums = Forum::withCount('diskusi')->get();
        return view('forum.index', compact('forums'));
    }
    
    public function indexAdmin()
    {
        $forums = Forum::all();
        return view('forumAdmin.index', compact('forums'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $forums = Forum::all();
        return view('forumAdmin.create', compact('forums'));

    }

    public function createAdmin()
    {
        //
        $forums = Forum::all();
        return view('forumAdmin.create', compact('forums'));

    }

    public function follow($forumId)
    {
        $user = Auth::user();
        $forums = Forum::findOrFail($forumId);

        // Cek apakah user sudah follow forum ini
        if ($user->followedForums()->where('forum_id', $forumId)->exists()) {
            return redirect()->back()->with('message', 'Kamu sudah mengikuti forum ini.');
        }

        // Attach user ke forum (follow)
        $user->followedForums()->attach($forumId);

        // Update jumlah anggota di forum (optional)
        $forums->increment('jumlah_anggota');

        return redirect()->back()->with('message', 'Berhasil mengikuti forum.');
    }

    public function unfollow($forumId)
    {
        $user = Auth::user();
        $forums = Forum::findOrFail($forumId);

        // Cek apakah user sudah follow forum ini
        if (!$user->followedForums()->where('forum_id', $forumId)->exists()) {
            return redirect()->back()->with('message', 'Kamu belum mengikuti forum ini.');
        }

        // Detach user dari forum (unfollow)
        $user->followedForums()->detach($forumId);

        // Update jumlah anggota di forum (optional)
        $forums->decrement('jumlah_anggota');

        return redirect()->back()->with('message', 'Berhasil berhenti mengikuti forum.');
    }

    



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'foto_forum'=>'required|mimes:jpeg,jpg,png,gif',
            'nama'=>'required',
            'judul'=>'required',
            'deskripsi'=>'required',
            'jumlah_diskusi'=>'nullable',
            'jumlah_anggota'=>'nullable',
            'terakhir_aktif'=>'nullable',
        ],[
            'foto_forum.required'=>'Foto Wajib Diisi',
            'foto_forum.mimes'=>'Foto Diperbolehkan Berekstensi jpeg,jpg,png,gif',
            'nama.required'=>'Nama Forum Wajib Diisi',
            'judul.required'=>'Judul Forum Wajib Diisi',
            'deskripsi.required'=>'Deskripsi Forum Wajib Diisi',
        ]);

        $foto_file = $request->file('foto_forum');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ywdhis'). "." .$foto_ekstensi;
        $foto_file->move(public_path('foto_forum'),$foto_nama);

        $data =[
            'foto_forum' =>$foto_nama,
            'nama' => $request->input('nama'),
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'jumlah_diskusi' => 0,
            'jumlah_anggota' => 0,
            'terakhir_aktif' => now(),
        ];
        Forum::create($data);
        return redirect('forumAdmin')->with('success','Forum Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $forums = Forum::where('id', $id)->first();
        $forums->update(['terakhir_aktif' => now()]);

        $diskusi = Diskusi::withCount('komentar')->where('forum_id', $id)->get();
        return view('forum.bodyForum', compact('forums','diskusi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = Forum::where('id',$id)->first();
        return view('forumAdmin.edit')->with('data',$data);
    }

    public function editAdmin($id)
    {
        //
        $data = Forum::where('id',$id)->first();
        return view('forumAdmin.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'foto_forum'=>'|mimes:jpeg,jpg,png,gif',
            'nama'=>'required',
            'judul'=>'required',
            'deskripsi'=>'required',
            'jumlah_diskusi'=>'nullable',
            'jumlah_anggota'=>'nullable',
            'terakhir_aktif'=>'nullable',
        ],[
            'foto_forum.required'=>'Foto Wajib Diisi',
            'foto_forum.mimes'=>'Foto Diperbolehkan Berekstensi jpeg,jpg,png,gif',
            'nama.required'=>'Nama Forum Wajib Diisi',
            'judul.required'=>'Judul Forum Wajib Diisi',
            'deskripsi.required'=>'Deskripsi Forum Wajib Diisi',
        ]);

        $forums = Forum::where('id', $id)->first();
        $foto_nama = $forums->foto_forum;

        $data =[
            'foto_forum' =>$foto_nama,
            'nama' => $request->input('nama'),
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'jumlah_diskusi' => 0,
            'jumlah_anggota' => 0,
            'terakhir_aktif' => now(),
        ];

        if ($request->hasFile('foto_forum')) {
            $foto_file = $request->file('foto_forum');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ywdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('foto_forum'), $foto_nama);
    
            if (File::exists(public_path('foto_forum') . '/' . $forums->foto_forum)) {
                File::delete(public_path('foto_forum') . '/' . $forums->foto_forum);
            }
    
            $data['foto_forum'] = $foto_nama;
        }

        Forum::where('id', $id)->update($data);
        return redirect('forumAdmin')->with('success', 'Forum Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data = Forum::where('id',$id)->first();
        if ($data && File::exists(public_path('foto_forum/' . $data->foto_forum))) {
        File::delete(public_path('foto_forum').'/'.$data->foto_forum);
        }

        Forum::where('id', $id)->delete();
        return redirect ('forumAdmin')->with ('success', 'Forum Berhasil Dihapus');
    }
}

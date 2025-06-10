<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forum extends Model
{
    use HasFactory;
    protected $table = 'forum';
    protected $fillable = ['nama','judul', 'deskripsi', 'foto_forum','jumlah_diskusi','jumlah_anggota','terakhir_aktif'];

    public function followers()
    {
        return $this->belongsToMany(User::class, 'forum_user', 'forum_id', 'user_id')->withTimestamps();
    }

    public function diskusi()
    {
        return $this->hasMany(Diskusi::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diskusi extends Model
{
    use HasFactory;

    protected $table = 'diskusi';
    protected $fillable = ['forum_id','user_id', 'judul', 'isi', 'foto_diskusi'];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function komentar() {
        return $this->hasMany(Komentar::class, 'diskusi_id');
    }

    
}

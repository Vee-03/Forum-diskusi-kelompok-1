<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    use HasFactory;
    protected $table = 'komentar';
    protected $fillable = ['diskusi_id', 'user_id', 'isi'];

    public function diskusi() {
        return $this->belongsTo(Diskusi::class, 'diskusi_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

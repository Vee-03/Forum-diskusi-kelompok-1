<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengumuman extends Model
{
    use HasFactory;
    protected $table = 'pengumuman';
    protected $fillable = [
        'user_id',
        'diskusi_id',
        'pesan',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

public function diskusi()
{
    return $this->belongsTo(Diskusi::class, 'diskusi_id');
}

}

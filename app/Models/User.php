<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primarykey = 'id';
    protected $fillable = [
        'username',
        'nama_lengkap',
        'email',
        'password',
        'role',
        'description',
        'foto_profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followedForums()
    {
        return $this->belongsToMany(Forum::class, 'forum_user', 'user_id', 'forum_id')->withTimestamps();
    }

    public function diskusi() {
        return $this->hasMany(Diskusi::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class,'user_id');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

}

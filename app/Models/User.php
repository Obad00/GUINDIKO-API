<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Une relation un à un avec Mentor
    public function mentor()
    {
        return $this->hasOne(Mentor::class);
    }

    // Une relation un à un avec Menté
    public function mente()
    {
        return $this->hasOne(Mente::class);
    }

    // Une relation un à plusieurs avec PostForum
    public function postsForum()
    {
        return $this->hasMany(PostForum::class);
    }

    // Une relation un à plusieurs avec CommentaireForum
    public function commentairesForum()
    {
        return $this->hasMany(CommentaireForum::class);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

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
        return $this->hasMany(Mentor::class);
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


     /**
     * Get the identifier that will be stored in the JWT payload.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get custom claims for the JWT payload.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}

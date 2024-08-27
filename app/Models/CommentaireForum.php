<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentaireForum extends Model
{
    use HasFactory;

    protected $guarded = [];
    // Une relation avec PostForum
    public function postForum()
    {
        return $this->belongsTo(PostForum::class);
    }

    // Une relation avec Utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

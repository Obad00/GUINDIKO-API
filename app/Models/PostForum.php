<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostForum extends Model
{
    use HasFactory;

    protected  $guarded = [];
     // Une relation avec Forum
     public function forum()
     {
         return $this->belongsTo(Forum::class);
     }
 
     // Une relation un à plusieurs avec CommentaireForum
     public function commentairesForum()
     {
         return $this->hasMany(CommentaireForum::class);
     }
 
     // Une relation avec Utilisateur
     public function utilisateur()
     {
         return $this->belongsTo(User::class);
     }
}

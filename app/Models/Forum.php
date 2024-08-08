<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $guarded = [];
    // Une relation un à plusieurs avec PostForum
    public function postsForum()
    {
        return $this->hasMany(PostForum::class);
    }
}

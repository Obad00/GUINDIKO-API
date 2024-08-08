<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    public function mentors()
    {
        return $this->belongsTo(Mentor::class);
    }

    // Une relation un à un avec Menté
    public function mente()
    {
        return $this->hasOne(Mente::class);
    }
}

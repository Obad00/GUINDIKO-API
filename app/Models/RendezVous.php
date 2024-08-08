<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $guarded = [];

      // Une relation avec Mentor
      public function mentor()
      {
          return $this->belongsTo(Mentor::class);
      }
  
      // Une relation avec Menté
      public function mente()
      {
          return $this->belongsTo(Mente::class);
      }

      public function notification()
      {
          return $this->hasOne(Notification::class);
      }
}

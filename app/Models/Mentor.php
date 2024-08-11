<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

      // Une relation un à plusieurs avec DemandeMentorat
      public function demandesMentorat()
      {
          return $this->hasMany(DemandeMentorat::class);
      }

      // Une relation un à plusieurs avec RendezVous
      public function rendezVous()
      {
          return $this->hasMany(RendezVous::class);
      }

      public function paiement()
      {
          return $this->hasMany(Paiement::class);
      }
}

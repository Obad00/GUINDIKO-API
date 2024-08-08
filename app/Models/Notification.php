<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function demandesMentorat()
      {
          return $this->hasOne(DemandeMentorat::class);
      }

      public function rendezVous()
      {
          return $this->hasOne(RendezVous::class);
      }
}

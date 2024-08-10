<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Définissez les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'demande_mentorat_id',
        'rendez_vous_id',
        'created_at',
        'updated_at',
    ];

    public function demandesMentorat()
    {
        return $this->belongsTo(DemandeMentorat::class);
    }

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class);
    }
}


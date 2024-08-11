<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'objet',
        'contenu',
        'demande_mentorat_id',
        'rendez_vous_id',
    ];

    public function demandeMentorat()
    {
        return $this->belongsTo(DemandeMentorat::class);
    }

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class);
    }



    
}

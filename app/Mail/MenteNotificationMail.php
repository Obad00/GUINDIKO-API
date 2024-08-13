<?php

namespace App\Mail;

use App\Models\DemandeMentorat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MenteNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;

    public function __construct(DemandeMentorat $demande)
    {
        $this->demande = $demande;
    }

    public function build()
    {
        return $this->subject('Votre Demande de Mentorat a été Envoyée')
                    ->view('emails.mente-notification');
    }
}

<?php

namespace App\Mail;

use App\Models\DemandeMentorat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MentorNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;

    public function __construct(DemandeMentorat $demande)
    {
        $this->demande = $demande;
    }

    public function build()
    {
        return $this->subject('Nouvelle Demande de Mentorat')
                    ->view('emails.mentor-notification');
    }
}

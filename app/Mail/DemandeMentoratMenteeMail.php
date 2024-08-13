<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeMentoratMenteeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $mentor;

    public function __construct($demande, $mentor)
    {
        $this->demande = $demande;
        $this->mentor = $mentor;
    }

    public function build()
    {
        return $this->view('emails.demandeMentoratMentee')
                    ->subject('Mise à jour de votre demande de mentorat')
                    ->with([
                        'demande' => $this->demande,
                        'mentor' => $this->mentor,
                    ]);
    }
}

<?php

namespace App\Mail;

use App\Models\RendezVous;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MentorRendezVousMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rendezVous;

    public function __construct(RendezVous $rendezVous)
    {
        $this->rendezVous = $rendezVous;
    }

    public function build()
    {
        return $this->subject('Nouveau Rendez-vous')
                    ->view('emails.mentorRendezVous')
                    ->with([
                        'sujet' => $this->rendezVous->sujet,
                        'date' => $this->rendezVous->date_rendezVous,
                        'lieu' => $this->rendezVous->lieu,
                    ]);
    }
}


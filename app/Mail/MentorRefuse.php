<?php

namespace App\Mail; // Namespace pour organiser la classe dans le dossier Mail.

use Illuminate\Bus\Queueable; // Importation du trait Queueable pour permettre la mise en file d'attente de cet email.
use Illuminate\Contracts\Queue\ShouldQueue; // Interface indiquant que cet email peut être mis en file d'attente.
use Illuminate\Mail\Mailable; // Classe de base pour la création d'emails dans Laravel.
use Illuminate\Mail\Mailables\Content; // Classe pour définir le contenu de l'email.
use Illuminate\Mail\Mailables\Envelope; // Classe pour définir l'enveloppe de l'email, comme le sujet.
use Illuminate\Queue\SerializesModels; // Trait pour sérialiser les modèles Eloquent lorsque l'email est mis en file d'attente.

class MentorRefuse extends Mailable
{
    use Queueable, SerializesModels; // Ces traits permettent de gérer la mise en file d'attente et la sérialisation des modèles.

    /**
     * Crée une nouvelle instance de l'email.
     */
    public function __construct()
    {
        // Le constructeur est vide, mais pourrait être utilisé pour passer des données à l'email.
    }

    /**
     * Définit l'enveloppe de l'email.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mentor Refuse', // Sujet de l'email défini ici.
        );
    }

    /**
     * Définit le contenu de l'email.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.mentor_refuse', // Définit le contenu de l'email en utilisant une vue Markdown.
        );
    }

    /**
     * Définit les pièces jointes de l'email.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return []; // Pas de pièces jointes pour cet email, donc un tableau vide est retourné.
    }
}


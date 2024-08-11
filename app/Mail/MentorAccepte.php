<?php

namespace App\Mail; // Déclare le namespace de la classe pour une organisation claire du code.

use Illuminate\Bus\Queueable; // Trait permettant de mettre le mail en file d'attente si nécessaire.
use Illuminate\Contracts\Queue\ShouldQueue; // Interface indiquant que le mail peut être mis en file d'attente.
use Illuminate\Mail\Mailable; // Classe de base pour les emails dans Laravel.
use Illuminate\Mail\Mailables\Content; // Classe utilisée pour définir le contenu de l'email.
use Illuminate\Mail\Mailables\Envelope; // Classe utilisée pour définir l'enveloppe de l'email (comme le sujet).
use Illuminate\Queue\SerializesModels; // Trait permettant de sérialiser les modèles Eloquent lorsque l'email est mis en file d'attente.

class MentorAccepte extends Mailable
{
    use Queueable, SerializesModels; // Ces traits permettent de gérer la mise en file d'attente et la sérialisation des modèles.

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct()
    {
        // C'est ici que vous pouvez initialiser des variables ou passer des données au constructeur si nécessaire.
    }

    /**
     * Définit l'enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mentor Accepte', // Définit le sujet de l'email.
        );
    }

    /**
     * Définit le contenu du message.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.mentor_accepte', // Définit le contenu du message en utilisant une vue Markdown située dans 'resources/views/emails/mentor_accepte.blade.php'.
        );
    }

    /**
     * Définit les pièces jointes pour le message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return []; // Retourne un tableau vide, ce qui signifie qu'il n'y a pas de pièces jointes à cet email.
    }
}


<!DOCTYPE html>
<html>
<head>
    <title>Reponse de votre demande de mentorat</title>
</head>
<body>
    <h1>Mise à jour de votre demande de mentorat</h1>
    <p>Bonjour {{ $demande->mente->user->prenom }} {{ $demande->mente->user->nom }},</p>
    <p>Votre demande de mentorat a été {{ $demande->statut }} par le mentor {{ $mentor->user->prenom }} {{ $mentor->user->nom }}.</p>
    <p>Merci de votre confiance.</p>
    <p>Cordialement,</p>
    <p>L'équipe Guindiko</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Demande de Mentorat Envoyée</title>
</head>
<body>
    <h1>Demande de Mentorat Envoyée</h1>
    <p>Bonjour {{ $demande->mente->user->prenom }} {{ $demande->mente->user->nom }},</p>
    <p>Votre demande de mentorat a été envoyée avec succès à {{ $demande->mentor->user->prenom }} {{ $demande->mentor->user->nom }}.</p>
    <p>Vous recevrez une notification une fois que le mentor aura répondu à votre demande.</p>
</body>
</html>

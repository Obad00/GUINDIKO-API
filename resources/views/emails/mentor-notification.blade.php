<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Demande de Mentorat</title>
</head>
<body>
    <h1>Nouvelle Demande de Mentorat</h1>
    <p>Bonjour {{ $demande->mentor->user->nom }},</p>
    <p>Une nouvelle demande de mentorat a été créée pour vous par {{ $demande->mente->user->nom }}.</p>
    <p>Merci de vérifier et de répondre à cette demande dans les plus brefs délais.</p>
</body>
</html>

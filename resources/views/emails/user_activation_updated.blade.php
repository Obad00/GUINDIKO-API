<!DOCTYPE html>
<html>
<head>
    <title>État d'Activation Mis à Jour</title>
</head>
<body>
    <h1>Bonjour {{ $user->nom }},</h1>
    <p>Votre état d'activation a été mis à jour. Votre compte est maintenant {{ $user->is_active ? 'activé' : 'désactivé' }}.</p>
    <p>Si vous avez des questions, veuillez nous contacter.</p>
</body>
</html>

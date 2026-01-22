<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #2563EB; color: white; padding: 20px; text-align: center; border-radius: 5px; }
        .content { padding: 20px; }
        .button { background: #2563EB; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 20px 0; }
        .footer { color: #999; font-size: 12px; text-align: center; padding: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👋 Bienvenue!</h1>
        </div>
        
        <div class="content">
            <p>Bonjour <strong>{{ $etudiant->prenom }}</strong>,</p>
            
            <p>Nous sommes heureux de confirmer votre inscription au <strong>Bachelor</strong>.</p>
            
            <h3>Vos Informations</h3>
            <ul>
                <li><strong>Nom:</strong> {{ $etudiant->nom }} {{ $etudiant->prenom }}</li>
                <li><strong>CNE:</strong> {{ $etudiant->cne }}</li>
                <li><strong>Filière:</strong> {{ $etudiant->filiere?->nom ?? 'Non spécifiée' }}</li>
                <li><strong>Email:</strong> {{ $etudiant->email }}</li>
                <li><strong>Date d'Inscription:</strong> {{ $etudiant->date_inscription?->format('d/m/Y') }}</li>
            </ul>
            
            <h3>Prochaines Étapes</h3>
            <ol>
                <li>Consultez votre portail étudiant</li>
                <li>Complétez votre profil si nécessaire</li>
                <li>Vérifiez régulièrement vos emails pour les mises à jour</li>
            </ol>
            
            <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>
            
        
            
            <p>Cordialement,<br><strong>L'équipe du Bachelor</strong></p>
        </div>
        
        <div class="footer">
            <p>Email automatique - Ne répondez pas à ce message</p>
        </div>
    </div>
</body>
</html>

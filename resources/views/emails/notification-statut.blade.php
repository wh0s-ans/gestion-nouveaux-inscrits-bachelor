<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { padding: 20px; text-align: center; border-radius: 5px; background: #2563EB; color: white; }
        .content { padding: 20px; }
        .button { background: #2563EB; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 20px 0; }
        .footer { color: #999; font-size: 12px; text-align: center; padding: 20px; border-top: 1px solid #eee; }
        .status-badge { display: inline-block; padding: 8px 15px; border-radius: 5px; font-weight: bold; background: #dbeafe; color: #0c4a6e; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Mise à jour de Votre Statut</h1>
        </div>
        
        <div class="content">
            <p>Bonjour <strong>{{ $etudiant->prenom }}</strong>,</p>
            
            <p>Votre statut d'inscription a été mis à jour.</p>
            
            <h3>Votre Nouveau Statut</h3>
            <p><span class="status-badge">{{ $etudiant->statut }}</span></p>
            
            <h3>Vos Informations</h3>
            <ul>
                <li><strong>Nom:</strong> {{ $etudiant->nom }} {{ $etudiant->prenom }}</li>
                <li><strong>CNE:</strong> {{ $etudiant->cne }}</li>
                <li><strong>Filière:</strong> {{ $etudiant->filiere?->nom ?? 'Non spécifiée' }}</li>
                <li><strong>Mise à jour:</strong> {{ now()->format('d/m/Y H:i') }}</li>
            </ul>
            
            @if($etudiant->statut === 'Validé')
            <p style="color: #10B981; font-weight: bold;">
                🎉 Félicitations! Votre inscription a été validée. Vous pouvez maintenant accéder à tous les services du Bachelor.
            </p>
            @elseif($etudiant->statut === 'En attente')
            <p style="color: #F59E0B; font-weight: bold;">
                ⏱ Votre dossier est en cours de traitement. Nous vous informerons dès que vous aurez une mise à jour.
            </p>
            @else
            <p style="color: #EF4444; font-weight: bold;">
                ❌ Malheureusement, votre inscription n'a pas pu être validée. Pour plus d'informations, contactez-nous.
            </p>
            @endif
            
            
            
            <p>Cordialement,<br><strong>L'équipe du Bachelor</strong></p>
        </div>
        
        <div class="footer">
            <p>Email automatique - Ne répondez pas à ce message</p>
        </div>
    </div>
</body>
</html>

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
        .info-box { background: #f0f4f8; padding: 15px; border-radius: 5px; border-left: 4px solid #2563EB; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📄 Votre Certificat d'Inscription</h1>
        </div>
        
        <div class="content">
            <p>Bonjour <strong>{{ $etudiant->prenom }}</strong>,</p>
            
            <p>Veuillez trouver ci-joint votre certificat d'inscription officiel au Bachelor.</p>
            
            <div class="info-box">
                <h3 style="margin-top: 0;">Informations du Certificat</h3>
                <ul style="margin: 0; padding-left: 20px;">
                    <li><strong>Étudiant:</strong> {{ $etudiant->nom }} {{ $etudiant->prenom }}</li>
                    <li><strong>CNE:</strong> {{ $etudiant->cne }}</li>
                    <li><strong>Filière:</strong> {{ $etudiant->filiere?->nom ?? 'Non spécifiée' }}</li>
                    <li><strong>Date d'Inscription:</strong> {{ $etudiant->date_inscription?->format('d/m/Y') }}</li>
                    <li><strong>Statut:</strong> {{ $etudiant->statut }}</li>
                </ul>
            </div>
            
            <p>Ce certificat atteste de votre inscription officielle au programme du Bachelor. Il peut être utilisé à titre de preuve auprès des autorités académiques.</p>
            
            <p><strong>📎 Pièce jointe:</strong> Certificat d'inscription (PDF)</p>
            
        
            
            <p>Cordialement,<br><strong>L'équipe du Bachelor</strong></p>
            
            <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
            <p style="color: #999; font-size: 12px;">Certificat généré le {{ now()->format('d/m/Y à H:i') }}</p>
        </div>
        
        <div class="footer">
            <p>Email automatique - Ne répondez pas à ce message</p>
        </div>
    </div>
</body>
</html>

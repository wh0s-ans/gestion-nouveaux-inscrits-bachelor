<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificat d'Inscription</title>
    <style>
        body {
            font-family: Georgia, serif;
            color: #333;
            margin: 0;
            padding: 40px;
            background: white;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            border: 3px solid #2563EB;
            padding: 60px 40px;
            text-align: center;
            background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%);
            position: relative;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 48px;
            margin-bottom: 20px;
        }
        h1 {
            color: #2563EB;
            font-size: 42px;
            margin: 20px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .subtitle {
            font-size: 18px;
            color: #666;
            margin-bottom: 40px;
            font-style: italic;
        }
        .content {
            margin: 50px 0;
            font-size: 16px;
            line-height: 1.8;
        }
        .info-section {
            margin: 40px 0;
            background: white;
            padding: 30px;
            border-left: 5px solid #2563EB;
            text-align: left;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .info-label {
            font-weight: bold;
            color: #2563EB;
            flex: 0 0 200px;
        }
        .info-value {
            flex: 1;
            text-align: right;
            color: #333;
        }
        .signature {
            margin-top: 60px;
            display: flex;
            justify-content: space-around;
        }
        .sign-box {
            width: 200px;
            border-top: 2px solid #333;
            padding-top: 10px;
            text-align: center;
            font-size: 12px;
        }
        footer {
            margin-top: 40px;
            font-size: 11px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .seal {
            font-size: 60px;
            opacity: 0.1;
            position: absolute;
            right: 40px;
            top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="seal">🎓</div>
        <div class="logo">📜</div>
        
        <h1>CERTIFICAT D'INSCRIPTION</h1>
        <p class="subtitle">Programme Bachelor</p>

        <div class="content">
            <p>Ceci certifie que</p>
            <h2 style="font-size: 28px; color: #1F2937; margin: 30px 0;">{{ strtoupper($etudiant->nom) }} {{ strtoupper($etudiant->prenom) }}</h2>
            <p>a été régulièrement inscrit(e) au programme du Bachelor</p>
        </div>

        <div class="info-section">
            <div class="info-row">
                <div class="info-label">Numéro CNE:</div>
                <div class="info-value">{{ $etudiant->cne }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Numéro CIN:</div>
                <div class="info-value">{{ $etudiant->cin }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Filière:</div>
                <div class="info-value">{{ $etudiant->filiere?->nom ?? 'Non spécifiée' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $etudiant->email }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Date de Naissance:</div>
                <div class="info-value">{{ $etudiant->date_naissance?->format('d/m/Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Date d'Inscription:</div>
                <div class="info-value">{{ $etudiant->date_inscription?->format('d/m/Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Statut:</div>
                <div class="info-value" style="font-weight: bold; color: 
                    @if($etudiant->statut === 'Validé') #10B981
                    @elseif($etudiant->statut === 'En attente') #F59E0B
                    @else #EF4444
                    @endif
                ">
                    {{ $etudiant->statut }}
                </div>
            </div>
        </div>

        <div class="content">
            <p style="font-style: italic; color: #666;">En foi de quoi, ce certificat est délivré à titre de preuve officielle de l'inscription.</p>
        </div>

        <div class="signature">
            <div class="sign-box">
                <p>_______________</p>
                <p>Direction Pédagogique</p>
            </div>
            <div class="sign-box">
                <p>_______________</p>
                <p>Responsable Administratif</p>
            </div>
        </div>

        <footer>
            <p>Certificat généré le {{ $date }} | Valide uniquement avec le tampon officiel</p>
            <p>Ce document atteste l'inscription officielle de la personne nommée ci-dessus auprès de notre établissement.</p>
        </footer>
    </div>
</body>
</html>

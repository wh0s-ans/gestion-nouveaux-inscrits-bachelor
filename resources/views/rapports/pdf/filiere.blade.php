<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rapport Filière</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 20px;
        }
        header {
            text-align: center;
            border-bottom: 3px solid #2563EB;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        h1 {
            color: #1F2937;
            margin: 10px 0;
        }
        .date {
            color: #6B7280;
            font-size: 12px;
        }
        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .stat-box {
            flex: 1;
            min-width: 150px;
            padding: 15px;
            background: #F3F4F6;
            border-left: 4px solid #2563EB;
            border-radius: 4px;
        }
        .stat-box.valides {
            border-left-color: #10B981;
        }
        .stat-box.attente {
            border-left-color: #F59E0B;
        }
        .stat-box.rejetes {
            border-left-color: #EF4444;
        }
        .stat-label {
            font-size: 12px;
            color: #6B7280;
            text-transform: uppercase;
        }
        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #1F2937;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        thead {
            background: #2563EB;
            color: white;
        }
        th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 11px;
        }
        tbody tr:nth-child(even) {
            background: #F9FAFB;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-valide {
            background: #D1FAE5;
            color: #065F46;
        }
        .status-attente {
            background: #FEF3C7;
            color: #78350F;
        }
        .status-rejete {
            background: #FEE2E2;
            color: #7F1D1D;
        }
        footer {
            margin-top: 40px;
            text-align: center;
            color: #9CA3AF;
            font-size: 10px;
            border-top: 1px solid #E5E7EB;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>📊 Rapport Filière: {{ $filiere->nom }}</h1>
        <p class="date">Généré le {{ $date }}</p>
    </header>

    <div class="stats">
        <div class="stat-box">
            <div class="stat-label">Total</div>
            <div class="stat-value">{{ $stats['total'] }}</div>
        </div>
        <div class="stat-box valides">
            <div class="stat-label">Validés</div>
            <div class="stat-value">{{ $stats['valides'] }}</div>
        </div>
        <div class="stat-box attente">
            <div class="stat-label">En Attente</div>
            <div class="stat-value">{{ $stats['en_attente'] }}</div>
        </div>
        <div class="stat-box rejetes">
            <div class="stat-label">Rejetés</div>
            <div class="stat-value">{{ $stats['rejetes'] }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>CNE</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Statut</th>
                <th>Date Naissance</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etudiants as $etudiant)
            <tr>
                <td>{{ $etudiant->cne }}</td>
                <td>{{ $etudiant->nom }}</td>
                <td>{{ $etudiant->prenom }}</td>
                <td>{{ $etudiant->email }}</td>
                <td>
                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $etudiant->statut)) }}">
                        {{ $etudiant->statut }}
                    </span>
                </td>
                <td>{{ $etudiant->date_naissance?->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">Aucun étudiant dans cette filière</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <footer>
        <p>Rapport généré automatiquement par le système de gestion des étudiants</p>
    </footer>
</body>
</html>

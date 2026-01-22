<x-mail::message>
# Votre Certificat d'Inscription 📄

Bonjour {{ $etudiant->prenom }},

Veuillez trouver ci-joint votre certificat d'inscription officiel au Bachelor.

## Informations du Certificat
- **Étudiant:** {{ $etudiant->nom }} {{ $etudiant->prenom }}
- **CNE:** {{ $etudiant->cne }}
- **Filière:** {{ $etudiant->filiere?->nom ?? 'Non spécifiée' }}
- **Date d'Inscription:** {{ $etudiant->date_inscription?->format('d/m/Y') }}
- **Statut:** {{ $etudiant->statut }}

Ce certificat atteste de votre inscription officielle au programme du Bachelor. Il peut être utilisé à titre de preuve auprès des autorités académiques.

<x-mail::button :url="config('app.url')" color="primary">
Voir votre Profil
</x-mail::button>

Cordialement,
**L'équipe du Bachelor**

---
*Certificat généré le {{ now()->format('d/m/Y à H:i') }}*
</x-mail::message>

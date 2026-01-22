<x-mail::message>
# Bienvenue! 👋

Bonjour {{ $etudiant->prenom }},

Nous sommes heureux de confirmer votre inscription au **Bachelor**.

## Vos Informations
- **Nom:** {{ $etudiant->nom }} {{ $etudiant->prenom }}
- **CNE:** {{ $etudiant->cne }}
- **Filière:** {{ $etudiant->filiere?->nom ?? 'Non spécifiée' }}
- **Email:** {{ $etudiant->email }}
- **Date d'Inscription:** {{ $etudiant->date_inscription?->format('d/m/Y') }}

## Prochaines Étapes
1. Consultez votre portail étudiant
2. Complétez votre profil si nécessaire
3. Vérifiez régulièrement vos emails pour les mises à jour

Si vous avez des questions, n'hésitez pas à nous contacter.

<x-mail::button :url="config('app.url')" color="primary">
Accéder à votre Portail
</x-mail::button>

Cordialement,
**L'équipe du Bachelor**
</x-mail::message>

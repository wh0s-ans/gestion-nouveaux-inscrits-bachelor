<x-mail::message>
# Mise à jour de Votre Statut 📬

Bonjour {{ $etudiant->prenom }},

Votre statut d'inscription a été mis à jour.

## Statut Actuel
<x-mail::panel>
**{{ $etudiant->statut }}**
</x-mail::panel>

## Détails
- **Nom:** {{ $etudiant->nom }} {{ $etudiant->prenom }}
- **CNE:** {{ $etudiant->cne }}
- **Filière:** {{ $etudiant->filiere?->nom ?? 'Non spécifiée' }}
- **Mise à jour:** {{ now()->format('d/m/Y H:i') }}

@if($etudiant->statut === 'Validé')
🎉 **Félicitations!** Votre inscription a été validée. Vous pouvez maintenant accéder à tous les services du Bachelor.
@elseif($etudiant->statut === 'En attente')
⏱ **Votre dossier est en cours de traitement.** Nous vous informerons dès que vous aurez une mise à jour.
@else
❌ **Malheureusement**, votre inscription n'a pas pu être validée. Pour plus d'informations, contactez-nous.
@endif

<x-mail::button :url="config('app.url')" color="primary">
Consulter Votre Dossier
</x-mail::button>

Cordialement,
**L'équipe du Bachelor**
</x-mail::message>

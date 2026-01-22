@extends('layouts.app')

@section('page-title', 'Détails Étudiant')
@section('titre', 'Détails de ' . $etudiant->nom . ' ' . $etudiant->prenom)

@section('contenu')
<div class="max-w-3xl space-y-6">
    <!-- Status Badge -->
    <div class="flex justify-end">
        @if($etudiant->statut === 'Validé')
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-100 text-green-700">
                <i class="fas fa-check-circle mr-2"></i>Validé
            </span>
        @elseif($etudiant->statut === 'En attente')
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-700">
                <i class="fas fa-clock mr-2"></i>En attente
            </span>
        @else
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-red-100 text-red-700">
                <i class="fas fa-times-circle mr-2"></i>Rejeté
            </span>
        @endif
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header with avatar -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-8 py-12">
            <div class="flex items-end gap-6">
                <div class="w-24 h-24 bg-white rounded-2xl flex items-center justify-center text-4xl font-bold text-blue-600 border-4 border-white">
                    {{ substr($etudiant->nom, 0, 1) }}{{ substr($etudiant->prenom, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-white">{{ $etudiant->nom }} {{ $etudiant->prenom }}</h2>
                    <p class="text-blue-100 mt-1">{{ $etudiant->filiere?->nom ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8 space-y-8">
            <!-- Informations Personnelles -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user text-blue-600 mr-3"></i>Informations Personnelles
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nom Complet</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $etudiant->nom }} {{ $etudiant->prenom }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Date de Naissance</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $etudiant->date_naissance->format('d/m/Y') }}</p>
                        <p class="text-xs text-gray-500 mt-1">({{ $etudiant->date_naissance->age }} ans)</p>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            <!-- Informations de Identification -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-id-card text-blue-600 mr-3"></i>Informations d'Identification
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-600">
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-1">CNE</p>
                        <p class="text-xl font-mono font-bold text-blue-900">{{ $etudiant->cne }}</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-600">
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-1">CIN</p>
                        <p class="text-xl font-mono font-bold text-blue-900">{{ $etudiant->cin }}</p>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            <!-- Informations de Contact -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-envelope text-blue-600 mr-3"></i>Informations de Contact
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Email</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $etudiant->email }}</p>
                        <a href="mailto:{{ $etudiant->email }}" class="text-xs text-blue-600 hover:text-blue-700 mt-2 inline-block">
                            <i class="fas fa-envelope mr-1"></i>Envoyer un email
                        </a>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Téléphone</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $etudiant->telephone }}</p>
                        <a href="tel:{{ $etudiant->telephone }}" class="text-xs text-blue-600 hover:text-blue-700 mt-2 inline-block">
                            <i class="fas fa-phone mr-1"></i>Appeler
                        </a>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            <!-- Informations Académiques -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-graduation-cap text-blue-600 mr-3"></i>Informations Académiques
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-purple-50 rounded-lg p-4 border-l-4 border-purple-600">
                        <p class="text-xs font-semibold text-purple-600 uppercase tracking-wide mb-1">Filière</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $etudiant->filiere?->nom ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Statut</p>
                        <div class="flex items-center gap-2 mt-2">
                            @if($etudiant->statut === 'Validé')
                                <i class="fas fa-check-circle text-green-600"></i>
                                <span class="text-lg font-semibold text-green-600">Validé</span>
                            @elseif($etudiant->statut === 'En attente')
                                <i class="fas fa-clock text-yellow-600"></i>
                                <span class="text-lg font-semibold text-yellow-600">En attente</span>
                            @else
                                <i class="fas fa-times-circle text-red-600"></i>
                                <span class="text-lg font-semibold text-red-600">Rejeté</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            <!-- Dates -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-calendar text-blue-600 mr-3"></i>Dates
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Date d'Inscription</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $etudiant->date_inscription->format('d/m/Y') }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $etudiant->date_inscription->diffForHumans() }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Dernière Mise à Jour</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $etudiant->updated_at->format('d/m/Y') }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $etudiant->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            <!-- Actions Rapports & Communications -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-tools text-blue-600 mr-3"></i>Rapports & Communications
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Rapport PDF -->
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-3">Rapport PDF</p>
                        <a href="{{ route('rapports.export-pdf-etudiants', ['search' => $etudiant->cne]) }}" class="inline-block w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all text-center text-sm">
                            <i class="fas fa-file-pdf mr-2"></i>Générer Rapport
                        </a>
                    </div>

                    <!-- Emails -->
                    <div class="bg-orange-50 rounded-lg p-4 border border-orange-200">
                        <p class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-3">Notifications</p>
                        <div class="space-y-2">
                            <a href="{{ route('emails.envoyer-confirmation', $etudiant) }}" class="inline-block w-full px-4 py-2 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-all text-center text-sm">
                                <i class="fas fa-envelope mr-1"></i>Confirmation
                            </a>
                            <a href="{{ route('emails.envoyer-notification', $etudiant) }}" class="inline-block w-full px-4 py-2 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-all text-center text-sm">
                                <i class="fas fa-bell mr-1"></i>Notification
                            </a>
                        </div>
                    </div>

                    <!-- Certificat -->
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <p class="text-xs font-semibold text-green-600 uppercase tracking-wide mb-3">Certificat</p>
                        <div class="space-y-2">
                            <a href="{{ route('emails.telecharger-certificat', $etudiant) }}" class="inline-block w-full px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-all text-center text-sm">
                                <i class="fas fa-download mr-1"></i>Télécharger
                            </a>
                            <a href="{{ route('emails.envoyer-certificat', $etudiant) }}" class="inline-block w-full px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-all text-center text-sm">
                                <i class="fas fa-paper-plane mr-1"></i>Envoyer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4 justify-end">
        <a href="{{ route('etudiants.index') }}" class="px-6 py-2.5 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-all flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
        </a>
        <a href="{{ route('etudiants.edit', $etudiant) }}" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all flex items-center">
            <i class="fas fa-edit mr-2"></i>Modifier
        </a>
        <form method="POST" action="{{ route('etudiants.destroy', $etudiant) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-6 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-all flex items-center">
                <i class="fas fa-trash mr-2"></i>Supprimer
            </button>
        </form>
    </div>
</div>
@endsection

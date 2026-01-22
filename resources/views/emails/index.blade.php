@extends('layouts.app')

@section('contenu')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">📧 Communications</h1>
        <p class="text-gray-600">Envoyez des emails automatiques et générez des certificats</p>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <i class="fas fa-times-circle mr-2"></i>{{ session('error') }}
        </div>
    @endif

    <!-- Envoi en Masse -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6">📬 Envoi en Masse</h3>

        <form action="{{ route('emails.envoyer-en-masse') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type d'Email *</label>
                <select name="type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Sélectionner --</option>
                    <option value="confirmation">✓ Confirmation d'inscription</option>
                    <option value="notification">⏱ Notification de statut</option>
                    <option value="certificat">📄 Certificat d'inscription</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Filière (Optionnel)</label>
                <select name="filiere_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Toutes les filières --</option>
                    @foreach(\App\Models\Filiere::all() as $filiere)
                    <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Statut (Optionnel)</label>
                <select name="statut" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Tous les statuts --</option>
                    <option value="Validé">Validé</option>
                    <option value="En attente">En attente</option>
                    <option value="Rejeté">Rejeté</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all">
                    <i class="fas fa-paper-plane mr-2"></i>Envoyer
                </button>
            </div>
        </form>
    </div>

    <!-- Liste des Étudiants -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">Étudiants</h3>
        </div>

        @if($etudiants->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nom & Prénom</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Filière</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Statut</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($etudiants as $etudiant)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-gray-900">{{ $etudiant->nom }} {{ $etudiant->prenom }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ $etudiant->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-sm font-medium rounded-full">
                                    {{ $etudiant->filiere?->nom ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($etudiant->statut === 'Validé')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                                        <i class="fas fa-check-circle mr-2"></i>Validé
                                    </span>
                                @elseif($etudiant->statut === 'En attente')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">
                                        <i class="fas fa-clock mr-2"></i>En attente
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                                        <i class="fas fa-times-circle mr-2"></i>Rejeté
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('emails.envoyer-confirmation', $etudiant) }}" class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors" title="Confirmation">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    <a href="{{ route('emails.envoyer-notification', $etudiant) }}" class="p-2 text-orange-600 hover:bg-orange-100 rounded-lg transition-colors" title="Notification">
                                        <i class="fas fa-bell"></i>
                                    </a>
                                    <a href="{{ route('emails.telecharger-certificat', $etudiant) }}" class="p-2 text-green-600 hover:bg-green-100 rounded-lg transition-colors" title="Télécharger Certificat">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a href="{{ route('emails.envoyer-certificat', $etudiant) }}" class="p-2 text-purple-600 hover:bg-purple-100 rounded-lg transition-colors" title="Envoyer Certificat">
                                        <i class="fas fa-paper-plane"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $etudiants->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-600 font-medium">Aucun étudiant</p>
            </div>
        @endif
    </div>
</div>
@endsection

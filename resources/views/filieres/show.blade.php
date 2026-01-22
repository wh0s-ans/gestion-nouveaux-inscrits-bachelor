@extends('layouts.app')

@section('page-title', 'Détails Filière')
@section('titre', $filiere->nom)

@section('contenu')
<div class="max-w-4xl space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('filieres.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold inline-block">
            <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
        </a>
    </div>

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">{{ $filiere->nom }}</h1>
                <p class="text-blue-100">
                    <i class="fas fa-tag mr-2"></i>
                    Catégorie: <span class="font-semibold">{{ $filiere->categorie ?? 'Non spécifié' }}</span>
                </p>
            </div>
            <div class="text-right">
                <div class="text-5xl font-bold text-blue-100">{{ $filiere->etudiants()->count() }}</div>
                <p class="text-blue-100">Étudiants inscrits</p>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Description Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-align-left text-blue-600 mr-2"></i>Description
            </h3>
            @if($filiere->description)
                <p class="text-gray-700 leading-relaxed">{{ $filiere->description }}</p>
            @else
                <p class="text-gray-500 italic">Aucune description disponible</p>
            @endif
        </div>

        <!-- Info Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>Informations
            </h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Catégorie</p>
                    <p class="text-gray-900 font-semibold">{{ $filiere->categorie ?? 'Non spécifiée' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Créée le</p>
                    <p class="text-gray-900">{{ $filiere->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-semibold">Dernière modification</p>
                    <p class="text-gray-900">{{ $filiere->updated_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Étudiants List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                <i class="fas fa-users text-blue-600 mr-2"></i>Étudiants inscrits
            </h3>
            <span class="bg-blue-100 text-blue-700 font-semibold px-3 py-1 rounded-full text-sm">
                {{ $filiere->etudiants()->count() }}
            </span>
        </div>

        @if($filiere->etudiants()->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nom</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">CNE</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Statut</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($filiere->etudiants()->paginate(10) as $etudiant)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-sm font-bold text-blue-600">
                                            {{ substr($etudiant->nom, 0, 1) }}{{ substr($etudiant->prenom, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $etudiant->nom }} {{ $etudiant->prenom }}</p>
                                            <p class="text-sm text-gray-600">{{ $etudiant->date_naissance?->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $etudiant->email }}</td>
                                <td class="px-6 py-4 text-gray-700 font-mono text-sm">{{ $etudiant->cne }}</td>
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
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('etudiants.show', $etudiant) }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                        <i class="fas fa-eye mr-1"></i>Voir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($filiere->etudiants()->paginate(10)->lastPage() > 1)
                <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Affichage de {{ $filiere->etudiants()->paginate(10)->firstItem() ?? 0 }} à {{ $filiere->etudiants()->paginate(10)->lastItem() ?? 0 }} sur {{ $filiere->etudiants()->count() }}
                    </div>
                    <div class="space-x-2">
                        {{ $filiere->etudiants()->paginate(10)->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="px-6 py-12 text-center">
                <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-600 font-medium">Aucun étudiant inscrit à cette filière</p>
            </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-3 justify-end pt-4">
        <a href="{{ route('filieres.edit', $filiere) }}" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all flex items-center">
            <i class="fas fa-edit mr-2"></i>Modifier
        </a>
        <form method="POST" action="{{ route('filieres.destroy', $filiere) }}" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette filière?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-6 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-all flex items-center">
                <i class="fas fa-trash mr-2"></i>Supprimer
            </button>
        </form>
    </div>
</div>
@endsection

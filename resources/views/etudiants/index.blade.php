@extends('layouts.app')

@section('page-title', 'Gestion des Étudiants')
@section('titre', 'Liste des Étudiants')

@section('contenu')
<div class="space-y-6">
    <!-- Filters & Search -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form method="GET" action="{{ route('etudiants.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search mr-2 text-blue-600"></i>Rechercher
                    </label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="Nom, Email, CNE..."
                    >
                </div>

                <!-- Filter by Filière -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-filter mr-2 text-blue-600"></i>Filière
                    </label>
                    <select name="filiere" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="">Toutes les filières</option>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}" {{ request('filiere') == $filiere->id ? 'selected' : '' }}>
                                {{ $filiere->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter by Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-check-circle mr-2 text-blue-600"></i>Statut
                    </label>
                    <select name="statut" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="">Tous les statuts</option>
                        <option value="Validé" {{ request('statut') === 'Validé' ? 'selected' : '' }}>Validé</option>
                        <option value="En attente" {{ request('statut') === 'En attente' ? 'selected' : '' }}>En attente</option>
                        <option value="Rejeté" {{ request('statut') === 'Rejeté' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-3 justify-end">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all">
                    <i class="fas fa-search mr-2"></i>Rechercher
                </button>
                <a href="{{ route('etudiants.index') }}" class="px-6 py-2.5 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-all">
                    <i class="fas fa-redo mr-2"></i>Réinitialiser
                </a>
            </div>
        </form>
    </div>

    <!-- Students Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900">Étudiants Inscrits</h3>
            <div class="flex items-center gap-4">
                <span class="bg-blue-100 text-blue-700 font-semibold px-3 py-1 rounded-full text-sm">
                    {{ $etudiants->total() }} résultats
                </span>
                <a href="{{ route('etudiants.export.excel', request()->query()) }}" class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-all flex items-center text-sm">
                    <i class="fas fa-file-excel mr-2"></i>Exporter Excel
                </a>
            </div>
        </div>

        @if($etudiants->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">CNE</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nom & Prénom</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Filière</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Statut</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($etudiants as $etudiant)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-mono text-sm font-semibold text-blue-600">{{ $etudiant->cne }}</span>
                            </td>
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
                                <p class="text-sm text-gray-600">{{ $etudiant->date_inscription->format('d/m/Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('etudiants.show', $etudiant) }}" class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('etudiants.edit', $etudiant) }}" class="p-2 text-green-600 hover:bg-green-100 rounded-lg transition-colors" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('etudiants.destroy', $etudiant) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-600 font-medium">Aucun étudiant trouvé</p>
                                    <p class="text-gray-500 text-sm mt-2">Essayez de modifier vos filtres de recherche</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $etudiants->links() }}
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-600 font-medium">Aucun étudiant enregistré</p>
                <a href="{{ route('etudiants.create') }}" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Ajouter un étudiant
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

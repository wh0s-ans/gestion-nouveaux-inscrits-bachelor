@extends('layouts.app')

@section('page-title', 'Modifier un Étudiant')
@section('titre', 'Modifier l\'Étudiant')

@section('contenu')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('etudiants.update', $etudiant) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 space-y-6">
        @csrf
        @method('PUT')

        <!-- Informations Personnelles -->
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-user text-blue-600 mr-2"></i>Informations Personnelles
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
                    <input 
                        type="text" 
                        id="nom" 
                        name="nom" 
                        value="{{ old('nom', $etudiant->nom) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('nom') border-red-500 @enderror"
                        required
                    >
                    @error('nom')
                        <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-sm font-semibold text-gray-700 mb-2">Prénom *</label>
                    <input 
                        type="text" 
                        id="prenom" 
                        name="prenom" 
                        value="{{ old('prenom', $etudiant->prenom) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('prenom') border-red-500 @enderror"
                        required
                    >
                    @error('prenom')
                        <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date Naissance -->
                <div>
                    <label for="date_naissance" class="block text-sm font-semibold text-gray-700 mb-2">Date de Naissance *</label>
                    <input 
                        type="date" 
                        id="date_naissance" 
                        name="date_naissance" 
                        value="{{ old('date_naissance', $etudiant->date_naissance->format('Y-m-d')) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('date_naissance') border-red-500 @enderror"
                        required
                    >
                    @error('date_naissance')
                        <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-semibold text-gray-700 mb-2">Téléphone *</label>
                    <input 
                        type="tel" 
                        id="telephone" 
                        name="telephone" 
                        value="{{ old('telephone', $etudiant->telephone) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('telephone') border-red-500 @enderror"
                        required
                    >
                    @error('telephone')
                        <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <hr class="border-gray-200">

        <!-- Informations Académiques -->
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-graduation-cap text-blue-600 mr-2"></i>Informations Académiques
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- CNE -->
                <div>
                    <label for="cne" class="block text-sm font-semibold text-gray-700 mb-2">CNE *</label>
                    <input 
                        type="text" 
                        id="cne" 
                        name="cne"
                        value="{{ old('cne', $etudiant->cne) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('cne') border-red-500 @enderror"
                        required
                    >
                    @error('cne')
                        <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- CIN -->
                <div>
                    <label for="cin" class="block text-sm font-semibold text-gray-700 mb-2">CIN *</label>
                    <input 
                        type="text" 
                        id="cin" 
                        name="cin"
                        value="{{ old('cin', $etudiant->cin) }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('cin') border-red-500 @enderror"
                        required
                    >
                    @error('cin')
                        <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Filière -->
                <div>
                    <label for="filiere_id" class="block text-sm font-semibold text-gray-700 mb-2">Filière *</label>
                    <select 
                        id="filiere_id" 
                        name="filiere_id"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('filiere_id') border-red-500 @enderror"
                        required
                    >
                        <option value="">-- Sélectionner une filière --</option>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}" {{ old('filiere_id', $etudiant->filiere_id) == $filiere->id ? 'selected' : '' }}>{{ $filiere->nom }}</option>
                        @endforeach
                    </select>
                    @error('filiere_id')
                        <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Statut -->
                <div>
                    <label for="statut" class="block text-sm font-semibold text-gray-700 mb-2">Statut *</label>
                    <select 
                        id="statut" 
                        name="statut"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('statut') border-red-500 @enderror"
                        required
                    >
                        <option value="En attente" {{ old('statut', $etudiant->statut) === 'En attente' ? 'selected' : '' }}>En attente</option>
                        <option value="Validé" {{ old('statut', $etudiant->statut) === 'Validé' ? 'selected' : '' }}>Validé</option>
                        <option value="Rejeté" {{ old('statut', $etudiant->statut) === 'Rejeté' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                    @error('statut')
                        <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <hr class="border-gray-200">

        <!-- Informations de Contact -->
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-envelope text-blue-600 mr-2"></i>Informations de Contact
            </h3>
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email"
                    value="{{ old('email', $etudiant->email) }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('email') border-red-500 @enderror"
                    required
                >
                @error('email')
                    <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <hr class="border-gray-200">

        <!-- Form Actions -->
        <div class="flex gap-4 justify-end pt-6">
            <a href="{{ route('etudiants.show', $etudiant) }}" class="px-6 py-2.5 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-all flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all flex items-center">
                <i class="fas fa-save mr-2"></i>Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection

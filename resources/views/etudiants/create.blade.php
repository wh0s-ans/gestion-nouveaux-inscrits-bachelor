@extends('layouts.app')

@section('page-title', 'Ajouter un Étudiant')
@section('titre', 'Créer un Nouvel Étudiant')

@section('contenu')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('etudiants.store') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 space-y-6">
        @csrf

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
                        value="{{ old('nom') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('nom') border-red-500 @enderror"
                        placeholder="Ex: Dupont"
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
                        value="{{ old('prenom') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('prenom') border-red-500 @enderror"
                        placeholder="Ex: Jean"
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
                        value="{{ old('date_naissance') }}"
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
                        value="{{ old('telephone') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('telephone') border-red-500 @enderror"
                        placeholder="Ex: 0612345678"
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
                    <label for="cne" class="block text-sm font-semibold text-gray-700 mb-2">CNE (Unique) *</label>
                    <input 
                        type="text" 
                        id="cne" 
                        name="cne" 
                        value="{{ old('cne') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('cne') border-red-500 @enderror"
                        placeholder="Ex: 1234567"
                        required
                    >
                    @error('cne')
                        <p class="text-red-600 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- CIN -->
                <div>
                    <label for="cin" class="block text-sm font-semibold text-gray-700 mb-2">CIN (Unique) *</label>
                    <input 
                        type="text" 
                        id="cin" 
                        name="cin" 
                        value="{{ old('cin') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('cin') border-red-500 @enderror"
                        placeholder="Ex: AB123456"
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
                            <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>{{ $filiere->nom }}</option>
                        @endforeach
                    </select>
                    @error('filiere_id')
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
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email (Unique) *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all @error('email') border-red-500 @enderror"
                    placeholder="Ex: jean.dupont@example.com"
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
            <a href="{{ route('etudiants.index') }}" class="px-6 py-2.5 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-all flex items-center">
                <i class="fas fa-times mr-2"></i>Annuler
            </a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all flex items-center">
                <i class="fas fa-save mr-2"></i>Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection

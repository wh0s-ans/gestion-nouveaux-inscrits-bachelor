@extends('layouts.app')

@section('contenu')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('filieres.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
            <h1 class="text-4xl font-bold text-slate-900">Nouvelle Filière</h1>
            <p class="text-slate-600 mt-2">Créez un nouveau programme d'études</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('filieres.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-semibold text-slate-900 mb-2">Nom <span class="text-red-600">*</span></label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('nom') border-red-500 @enderror" placeholder="Exemple: Informatique de gestion">
                    @error('nom')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catégorie -->
                <div>
                    <label for="categorie" class="block text-sm font-semibold text-slate-900 mb-2">Catégorie</label>
                    <select name="categorie" id="categorie" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="">-- Sélectionner une catégorie --</option>
                        <option value="Sciences" {{ old('categorie') === 'Sciences' ? 'selected' : '' }}>Sciences</option>
                        <option value="Business" {{ old('categorie') === 'Business' ? 'selected' : '' }}>Business/Finance</option>
                        <option value="IT" {{ old('categorie') === 'IT' ? 'selected' : '' }}>IT/Technologie</option>
                    </select>
                    @error('categorie')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-900 mb-2">Description</label>
                    <textarea name="description" id="description" rows="5" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Décrivez cette filière...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200 font-semibold">
                        <i class="fas fa-save mr-2"></i>Créer la filière
                    </button>
                    <a href="{{ route('filieres.index') }}" class="flex-1 px-6 py-3 bg-slate-200 text-slate-800 rounded-lg hover:bg-slate-300 transition-colors font-semibold text-center">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

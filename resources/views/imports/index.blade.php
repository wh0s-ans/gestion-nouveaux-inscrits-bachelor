@extends('layouts.app')

@section('contenu')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">📥 Importation d'Étudiants</h1>
        <p class="text-gray-600">Importez des étudiants en masse via CSV avec détection des doublons</p>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('warning') }}
        </div>
    @endif

    @if (session('error_details'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <p class="font-bold mb-2"><i class="fas fa-times-circle mr-2"></i>Erreurs détectées:</p>
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach (session('error_details') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Formulaire d'Import -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Importer un Fichier CSV</h3>

                <form action="{{ route('imports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fichier CSV *</label>
                        <div class="relative">
                            <input type="file" name="fichier" accept=".csv,.txt" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Format: CSV (séparé par des virgules)</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filière *</label>
                        <select name="filiere_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Sélectionner une filière --</option>
                            @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <h4 class="font-medium text-gray-900 mb-3">Format du fichier CSV</h4>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 text-sm font-mono">
                            <p class="text-gray-700">Nom,Prenom,CNE,CIN,Date_Naissance,Email,Telephone</p>
                            <p class="text-gray-500 mt-2">Ahmed,Mohamed,CNE123456789,1234567890,01/01/2000,ahmed@exemple.ma,0612345678</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all">
                            <i class="fas fa-upload mr-2"></i>Importer
                        </button>
                        <a href="{{ route('imports.telecharger-template') }}" class="flex-1 px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-all text-center">
                            <i class="fas fa-download mr-2"></i>Télécharger Template
                        </a>
                    </div>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="font-medium text-gray-900 mb-3">ℹ️ Instructions</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><strong>✓ Format:</strong> Fichier CSV avec séparateur virgule</li>
                        <li><strong>✓ En-têtes:</strong> Première ligne = noms de colonnes</li>
                        <li><strong>✓ Date:</strong> Format JJ/MM/YYYY (ex: 01/01/2000)</li>
                        <li><strong>✓ Détection:</strong> Les doublons (CNE ou Email) sont ignorés</li>
                        <li><strong>✓ Validation:</strong> Email et données obligatoires vérifiées</li>
                        <li><strong>✓ Statut:</strong> Tous les nouveaux = "En attente"</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Historique -->
        <div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">📋 Historique</h3>

                @forelse($historique as $import)
                <div class="border-l-4 border-blue-500 pl-4 py-3 mb-4 bg-gray-50 p-3 rounded">
                    <p class="text-sm font-medium text-gray-900">{{ $import->nom_fichier }}</p>
                    <div class="text-xs text-gray-600 mt-2 space-y-1">
                        <p><strong>Date:</strong> {{ $import->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Lignes:</strong> {{ $import->total_lignes }}</p>
                        <p class="text-green-600"><strong>✓ Ajoutés:</strong> {{ $import->ajoutes }}</p>
                        <p class="text-yellow-600"><strong>⚠ Doublons:</strong> {{ $import->doublons }}</p>
                        <p class="text-red-600"><strong>✗ Erreurs:</strong> {{ $import->erreurs }}</p>
                    </div>
                    @if($import->erreurs > 0)
                    <button onclick="toggleErrors({{ $import->id }})" class="text-blue-600 text-xs mt-2 hover:underline">Voir les erreurs</button>
                    <div id="errors-{{ $import->id }}" class="hidden mt-2 text-xs bg-red-50 p-2 rounded border border-red-200">
                        @foreach($import->details_erreurs as $error)
                        <p class="text-red-700">{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                </div>
                @empty
                <p class="text-gray-500 text-center py-8">Aucun import effectué</p>
                @endforelse

                @if($historique->hasPages())
                <div class="mt-4">
                    {{ $historique->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function toggleErrors(id) {
    const el = document.getElementById('errors-' + id);
    el.classList.toggle('hidden');
}
</script>
@endsection

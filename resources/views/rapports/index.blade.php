@extends('layouts.app')

@section('contenu')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">📊 Rapports & Analytics</h1>
        <p class="text-gray-600">Générez des rapports PDF détaillés et consultez les statistiques</p>
    </div>

    <!-- Statistiques Globales -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Étudiants</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_etudiants'] }}</p>
                </div>
                <i class="fas fa-users text-4xl text-blue-200"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Validés</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['valides'] }}</p>
                </div>
                <i class="fas fa-check-circle text-4xl text-green-200"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">En Attente</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['en_attente'] }}</p>
                </div>
                <i class="fas fa-clock text-4xl text-yellow-200"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Rejetés</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ $stats['rejetes'] }}</p>
                </div>
                <i class="fas fa-times-circle text-4xl text-red-200"></i>
            </div>
        </div>
    </div>

    <!-- Options de Rapports -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <!-- Rapport Complet -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">📋 Rapport Complet</h3>
            <p class="text-gray-600 text-sm mb-4">Télécharger un rapport PDF avec tous les étudiants et leurs détails</p>
            <a href="{{ route('rapports.export-pdf-etudiants') }}" class="inline-block px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all">
                <i class="fas fa-file-pdf mr-2"></i>Télécharger PDF
            </a>
        </div>

        <!-- Rapport par Filière -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">🎓 Rapport par Filière</h3>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Sélectionner une filière:</label>
                <form id="form-filiere" class="flex gap-2">
                    <select name="filiere_id" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Choisir une filière --</option>
                        @foreach($filieres as $filiere)
                        <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all">
                        <i class="fas fa-file-pdf mr-2"></i>PDF
                    </button>
                </form>
            </div>
        </div>

        <!-- Rapport Mensuel -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">📅 Rapport Mensuel</h3>
            <form id="form-mensuel" class="space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mois:</label>
                        <select name="mois" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $m == now()->month ? 'selected' : '' }}>
                                {{ ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'][$m-1] }}
                            </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Année:</label>
                        <select name="annee" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @for($y = now()->year - 2; $y <= now()->year; $y++)
                            <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-all">
                    <i class="fas fa-file-pdf mr-2"></i>Générer Rapport Mensuel
                </button>
            </form>
        </div>

        <!-- Statistiques par Filière -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">📊 Statistiques par Filière</h3>
            <div class="space-y-3 max-h-80 overflow-y-auto">
                @foreach($statistiques_par_filiere as $stat)
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <p class="font-medium text-gray-900">{{ $stat['nom'] }}</p>
                    <div class="flex gap-4 text-sm mt-1">
                        <span class="text-gray-600"><strong>Total:</strong> {{ $stat['total'] }}</span>
                        <span class="text-green-600"><strong>✓</strong> {{ $stat['valides'] }}</span>
                        <span class="text-yellow-600"><strong>⏱</strong> {{ $stat['en_attente'] }}</span>
                        <span class="text-red-600"><strong>✗</strong> {{ $stat['rejetes'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('form-filiere').addEventListener('submit', function(e) {
        e.preventDefault();
        const filiere_id = this.querySelector('select[name="filiere_id"]').value;
        if (filiere_id) {
            window.location.href = `/rapports/export-pdf-filiere/${filiere_id}`;
        }
    });

    document.getElementById('form-mensuel').addEventListener('submit', function(e) {
        e.preventDefault();
        const mois = this.querySelector('select[name="mois"]').value;
        const annee = this.querySelector('select[name="annee"]').value;
        window.location.href = `/rapports/export-pdf-mensuel/${mois}/${annee}`;
    });
</script>
@endsection

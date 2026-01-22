@extends('layouts.app')

@section('page-title', 'Tableau de Bord')
@section('titre', 'Tableau de Bord')

@section('contenu')
<div class="space-y-8">
    <!-- Top Stats Banner -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Stat 1 -->
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-indigo-100 text-sm font-medium">Total</p>
                    <h3 class="text-4xl font-bold mt-2">{{ $totalEtudiants }}</h3>
                </div>
                <i class="fas fa-users text-indigo-200 text-3xl opacity-50"></i>
            </div>
            <p class="text-indigo-100 text-xs mt-3">Inscrits Bachelor</p>
        </div>

        <!-- Stat 2 -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Acceptés</p>
                    <h3 class="text-4xl font-bold mt-2">{{ $etudinantsValides }}</h3>
                </div>
                <i class="fas fa-check-circle text-green-200 text-3xl opacity-50"></i>
            </div>
            <p class="text-green-100 text-xs mt-3">{{ round(($etudinantsValides / $totalEtudiants) * 100) }}% du total</p>
        </div>

        <!-- Stat 3 -->
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-yellow-100 text-sm font-medium">En Attente</p>
                    <h3 class="text-4xl font-bold mt-2">{{ $etudinantsEnAttente }}</h3>
                </div>
                <i class="fas fa-spinner text-yellow-200 text-3xl opacity-50"></i>
            </div>
            <p class="text-yellow-100 text-xs mt-3">{{ round(($etudinantsEnAttente / $totalEtudiants) * 100) }}% du total</p>
        </div>

        <!-- Stat 4 -->
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium">Rejetés</p>
                    <h3 class="text-4xl font-bold mt-2">{{ $etudinantsRejetes }}</h3>
                </div>
                <i class="fas fa-times-circle text-red-200 text-3xl opacity-50"></i>
            </div>
            <p class="text-red-100 text-xs mt-3">{{ round(($etudinantsRejetes / $totalEtudiants) * 100) }}% du total</p>
        </div>
    </div>

    <!-- Main Charts Grid - 3 columns -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Status Pie Chart (Full Height) -->
        <div class="lg:row-span-2 bg-white rounded-2xl shadow-md border border-gray-200 p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Répartition</h2>
                <p class="text-gray-500 text-sm mt-1">Distribution des statuts</p>
            </div>
            <div class="relative" style="height: 380px;">
                <canvas id="chartStatut"></canvas>
            </div>
        </div>

        <!-- Monthly Trend -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Tendance</h2>
                <p class="text-gray-500 text-sm mt-1">Inscriptions mensuelles</p>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="chartMensuel"></canvas>
            </div>
        </div>

        <!-- Programs Bar -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Filières</h2>
                <p class="text-gray-500 text-sm mt-1">Top 8 programmes</p>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="chartFiliere"></canvas>
            </div>
        </div>

        <!-- Academic Year Chart -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Historique</h2>
                <p class="text-gray-500 text-sm mt-1">Par année universitaire</p>
            </div>
            <div class="relative" style="height: 300px;">
                <canvas id="chartAnnee"></canvas>
            </div>
        </div>

        <!-- Programs List (Full Height) -->
        <div class="lg:row-span-2 bg-white rounded-2xl shadow-md border border-gray-200 p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Top Filières</h2>
                <p class="text-gray-500 text-sm mt-1">Les plus populaires</p>
            </div>
            <div class="space-y-4 overflow-y-auto" style="max-height: 580px;">
                @foreach($topFilieres as $filiere => $count)
                <div class="p-4 bg-gradient-to-r from-blue-50 to-transparent rounded-xl border border-blue-100 hover:border-blue-300 transition-all">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-900 text-sm">{{ $filiere }}</h4>
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">{{ $count }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all" style="width: {{ ($count / $totalEtudiants) * 100 }}%"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">{{ round(($count / $totalEtudiants) * 100, 1) }}% du total</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    Chart.defaults.font.family = "'Inter', system-ui, sans-serif";

    // Chart 1: Doughnut (Status)
    const ctxStatut = document.getElementById('chartStatut').getContext('2d');
    new Chart(ctxStatut, {
        type: 'doughnut',
        data: {
            labels: ['Validés', 'En attente', 'Rejetés'],
            datasets: [{
                data: [{{ $donneesStatut['Validé'] }}, {{ $donneesStatut['En attente'] }}, {{ $donneesStatut['Rejeté'] }}],
                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                borderColor: '#ffffff',
                borderWidth: 3,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { size: 12, weight: '600' }, padding: 20 }
                }
            }
        }
    });

    // Chart 2: Line (Monthly)
    const ctxMensuel = document.getElementById('chartMensuel').getContext('2d');
    new Chart(ctxMensuel, {
        type: 'line',
        data: {
            labels: {!! json_encode($inscriptionsParMois['labels']) !!},
            datasets: [{
                label: 'Inscriptions',
                data: {!! json_encode($inscriptionsParMois['values']) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { drawBorder: false } },
                x: { grid: { display: false } }
            }
        }
    });

    // Chart 3: Bar (Programs)
    const ctxFiliere = document.getElementById('chartFiliere').getContext('2d');
    new Chart(ctxFiliere, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($rePartitionFiliere)) !!},
            datasets: [{
                label: 'Étudiants',
                data: {!! json_encode(array_values($rePartitionFiliere)) !!},
                backgroundColor: ['#3b82f6', '#06b6d4', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981', '#ef4444', '#6366f1'],
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, grid: { drawBorder: false } },
                y: { grid: { display: false } }
            }
        }
    });

    // Chart 4: Bar (Academic Year)
    const ctxAnnee = document.getElementById('chartAnnee').getContext('2d');
    new Chart(ctxAnnee, {
        type: 'bar',
        data: {
            labels: {!! json_encode($inscriptionsParAnnee['labels']) !!},
            datasets: [{
                label: 'Inscrits',
                data: {!! json_encode($inscriptionsParAnnee['values']) !!},
                backgroundColor: '#8b5cf6',
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { drawBorder: false } }
            }
        }
    });
</script>
@endpush

@endsection

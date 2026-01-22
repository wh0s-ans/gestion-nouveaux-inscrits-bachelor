@extends('layouts.app')

@section('contenu')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-4xl font-bold text-slate-900">Gestion des Filières</h1>
                    <p class="text-slate-600 mt-2">Gérez les programmes d'études disponibles</p>
                </div>
                <a href="{{ route('filieres.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-200 font-semibold">
                    <i class="fas fa-plus mr-2"></i>Nouvelle Filière
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <p class="text-red-800 font-semibold mb-2">Erreurs :</p>
                    <ul class="list-disc list-inside text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6 flex items-start">
                    <i class="fas fa-check-circle text-green-600 mr-3 mt-0.5"></i>
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            @endif
        </div>

        <!-- Filières Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            @if($filieres->total() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Nom</th>
                                <th class="px-6 py-4 text-left font-semibold">Catégorie</th>
                                <th class="px-6 py-4 text-left font-semibold">Étudiants</th>
                                <th class="px-6 py-4 text-left font-semibold">Description</th>
                                <th class="px-6 py-4 text-center font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($filieres as $filiere)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-slate-900">{{ $filiere->nom }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($filiere->categorie)
                                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                                                @if($filiere->categorie === 'Sciences')
                                                    bg-green-100 text-green-800
                                                @elseif($filiere->categorie === 'Business')
                                                    bg-blue-100 text-blue-800
                                                @elseif($filiere->categorie === 'IT')
                                                    bg-purple-100 text-purple-800
                                                @else
                                                    bg-gray-100 text-gray-800
                                                @endif
                                            ">
                                                {{ $filiere->categorie }}
                                            </span>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-3 py-1 bg-slate-100 text-slate-800 rounded-lg font-semibold">
                                            {{ $filiere->etudiants->count() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ Str::limit($filiere->description ?? '', 50) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('filieres.edit', $filiere->id) }}" class="px-4 py-2 bg-yellow-50 text-yellow-700 rounded-lg hover:bg-yellow-100 transition-colors font-semibold">
                                                <i class="fas fa-edit mr-1"></i>Modifier
                                            </a>
                                            <form action="{{ route('filieres.destroy', $filiere->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors font-semibold">
                                                    <i class="fas fa-trash mr-1"></i>Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-slate-50 px-6 py-4">
                    {{ $filieres->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <i class="fas fa-inbox text-5xl text-slate-300 mb-4"></i>
                    <p class="text-xl text-slate-600 mb-4">Aucune filière trouvée</p>
                    <a href="{{ route('filieres.create') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                        Créer la première filière
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

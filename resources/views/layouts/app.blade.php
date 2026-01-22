<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre', 'GNI - Gestion des Nouveaux Inscrits')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <style>
        body { @apply bg-gray-50 text-gray-900; font-family: 'Inter', system-ui, sans-serif; }
        .btn-primary { @apply px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200; }
        .btn-secondary { @apply px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all duration-200; }
        .btn-danger { @apply px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200; }
        .btn-sm { @apply px-3 py-1.5 text-sm; }
        .card { @apply bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden; }
        .input-field { @apply w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all; }
        .badge-status { @apply inline-flex items-center px-3 py-1 rounded-full text-sm font-medium; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">GNI</h1>
                        <p class="text-xs text-gray-500">Bachelor</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ Route::currentRouteName() === 'dashboard' ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                    <i class="fas fa-chart-line w-5 text-center"></i>
                    <span>Tableau de Bord</span>
                </a>
                <a href="{{ route('filieres.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ Route::currentRouteName() === 'filieres.index' ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                    <i class="fas fa-graduation-cap w-5 text-center"></i>
                    <span>Filières</span>
                </a>
                <a href="{{ route('etudiants.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ Route::currentRouteName() === 'etudiants.index' ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                    <i class="fas fa-list w-5 text-center"></i>
                    <span>Étudiants</span>
                </a>
                <a href="{{ route('etudiants.create') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ Route::currentRouteName() === 'etudiants.create' ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                    <i class="fas fa-plus w-5 text-center"></i>
                    <span>Ajouter Étudiant</span>
                </a>

                <!-- Separator -->
                <div class="pt-4 border-t border-gray-200 mt-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase px-4 mb-2">Outils</p>
                </div>

                <!-- New Features -->
                <a href="{{ route('rapports.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ Route::currentRouteName() === 'rapports.index' ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                    <i class="fas fa-chart-bar w-5 text-center"></i>
                    <span>Rapports PDF</span>
                </a>
                <a href="{{ route('imports.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ Route::currentRouteName() === 'imports.index' ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                    <i class="fas fa-file-upload w-5 text-center"></i>
                    <span>Importer CSV</span>
                </a>
                <a href="{{ route('emails.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors {{ Route::currentRouteName() === 'emails.index' ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                    <i class="fas fa-envelope w-5 text-center"></i>
                    <span>Emails & Certs</span>
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors font-medium">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 shadow-sm">
                <div class="px-8 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-500 mt-1">Bienvenue dans votre espace de gestion</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Administrateur</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-auto">
                <div class="p-8">
                    <!-- Alerts -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex">
                                <i class="fas fa-exclamation-circle text-red-600 mt-1 mr-3 flex-shrink-0"></i>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-red-900 mb-2">Erreurs de validation</h3>
                                    <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-3 flex-shrink-0"></i>
                            <p class="text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center">
                            <i class="fas fa-times-circle text-red-600 mr-3 flex-shrink-0"></i>
                            <p class="text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    @endif

                    <!-- Content -->
                    @yield('contenu')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

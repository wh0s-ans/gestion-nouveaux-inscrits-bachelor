<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - GNI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { @apply bg-gradient-to-br from-blue-50 via-white to-blue-50; font-family: 'Inter', system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Card -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl mb-4">
                <i class="fas fa-graduation-cap text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900">GNI</h1>
            <p class="text-gray-500 mt-2">Gestion des Nouveaux Inscrits en Bachelor</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Connexion</h2>
            <p class="text-gray-600 text-sm mb-8">Entrez vos identifiants pour accéder au système</p>

            <!-- Credentials Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-xs font-semibold text-blue-900 mb-2">📋 Identifiants de démo :</p>
                <p class="text-sm text-blue-800"><strong>Email :</strong> admin@gestion-inscrits.local</p>
                <p class="text-sm text-blue-800"><strong>Mot de passe :</strong> password</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                        placeholder="admin@gestion-inscrits.local"
                        required
                        autocomplete="email"
                    >
                    @error('email')
                        <p class="text-red-600 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Mot de passe
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <p class="text-red-600 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember" 
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer"
                    >
                    <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer">
                        Se souvenir de moi
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2"
                >
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Se connecter</span>
                </button>
            </form>

            <!-- Info Message -->
            <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                <p class="text-xs text-amber-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Information :</strong> Utilisez les identifiants fournis ci-dessus pour vous connecter à titre de démo.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-500 text-sm mt-8">
            © 2024-2025 GNI - Tous droits réservés
        </p>
    </div>
</body>
</html>

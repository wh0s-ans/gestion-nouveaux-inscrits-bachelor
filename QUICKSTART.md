# Guide de Démarrage Rapide

## 🚀 Installation en 5 minutes

### 1. Configuration initiale
```bash
cd gestion-nouveaux-inscrits-bachelor
composer install
cp .env.example .env
php artisan key:generate
```

### 2. Configuration MySQL
Ouvrez le fichier `.env` et modifiez :
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_inscrits
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Créer la base de données et charger les données
```bash
php artisan db:create
php artisan migrate:fresh --seed
```

### 4. Démarrer le serveur
```bash
php artisan serve
```

Accédez à : **http://localhost:8000**

---

## 🔑 Connexion

- **Email** : `admin@gestion-inscrits.local`
- **Mot de passe** : `password`

---

## 📋 Commandes Utiles

### Base de données
```bash
# Créer la base de données
php artisan db:create

# Exécuter les migrations
php artisan migrate

# Créer + migrer + seeder
php artisan migrate:fresh --seed

# Remplir avec les données de test
php artisan db:seed
```

### Développement
```bash
# Lancer le serveur
php artisan serve

# Accéder à la console interactive
php artisan tinker

# Voir les routes
php artisan route:list

# Vider le cache
php artisan cache:clear
```

---

## 📊 Structure des Données

### Administrateurs (users)
- Email : admin@gestion-inscrits.local
- Mot de passe : password

### Étudiants (100)
- 33 Validés
- 33 En attente
- 34 Rejetés
- Répartis sur 5 filières

---

## 🎨 Interface

### Tableau de Bord
- 4 Cards de statistiques
- 4 Graphiques Chart.js
- Tableau des meilleures filières

### Gestion des Étudiants
- Liste avec pagination (15 par page)
- Recherche avancée
- Filtres par filière et statut
- CRUD complet (Créer, Lire, Modifier, Supprimer)

---

## 🔧 Configuration Supplémentaire

### Changer le port du serveur
```bash
php artisan serve --port=8080
```

### Utiliser une autre base de données
Modifier `DB_DATABASE` dans `.env` et refaire :
```bash
php artisan db:create
php artisan migrate:fresh --seed
```

### Ajouter plus d'étudiants
```bash
php artisan tinker
>>> \App\Models\Etudiant::factory(50)->create()
```

---

## 📝 Notes Importantes

1. ✅ Vérifiez que MySQL est en cours d'exécution
2. ✅ Les données de test sont automatiquement chargées
3. ✅ L'application est 100% en français
4. ✅ Design responsive (Desktop/Tablette/Mobile)
5. ✅ Tous les graphiques sont interactifs

---

## 🎯 Prochaines Étapes

1. Connectez-vous avec les identifiants de démo
2. Explorez le tableau de bord
3. Gérez les étudiants
4. Consultez les statistiques et graphiques
5. Testez les filtres et recherches

Bonne utilisation ! 🚀

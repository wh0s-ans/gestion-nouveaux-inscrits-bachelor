<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Gestion des Nouveaux Inscrits en Bachelor

## 📋 Description du Projet

Application web Laravel complète et professionnelle pour la gestion des nouveaux inscrits en Bachelor. Cette application digitalise et optimise le processus de gestion des étudiants avec un tableau de bord décisionnel riche en statistiques et graphiques.

**Statut** : ✅ Prêt pour soutenance de Projet de Fin d'Études (PFE)

---

## 🎯 Objectifs

- ✅ Digitaliser et optimiser le processus de gestion des nouveaux inscrits
- ✅ Centraliser toutes les données étudiantes
- ✅ Fournir un tableau de bord décisionnel riche et interactif
- ✅ Faciliter la prise de décision administrative grâce aux statistiques

---

## 🛠️ Technologies Utilisées

| Technologie | Version | Rôle |
|------------|---------|------|
| **Laravel** | 10.10+ | Framework Backend |
| **Blade** | - | Moteur de templates Frontend |
| **Bootstrap** | 5.3.0 | Framework UI |
| **Chart.js** | 4.4.0 | Bibliothèque de graphiques |
| **Font Awesome** | 6.4.0 | Icônes |
| **MySQL** | 5.7+ | Base de données |
| **PHP** | 8.1+ | Langage serveur |

---

## 🚀 Installation & Configuration

### Prérequis
- PHP 8.1+
- MySQL 5.7+
- Composer
- Node.js (optionnel)

### Étapes d'installation

1. **Cloner/Télécharger le projet**
   ```bash
   cd gestion-nouveaux-inscrits-bachelor
   ```

2. **Installer les dépendances Composer**
   ```bash
   composer install
   ```

3. **Configurer le fichier .env**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurer la base de données MySQL**
   
   Éditez le fichier `.env` :
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gestion_inscrits
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Créer la base de données**
   ```bash
   php artisan db:create
   ```

6. **Exécuter les migrations et seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Démarrer le serveur de développement**
   ```bash
   php artisan serve
   ```

   L'application sera accessible à `http://localhost:8000`

---

## 🔐 Identifiants de Connexion (Démo)

| Champ | Valeur |
|-------|--------|
| **Email** | `admin@gestion-inscrits.local` |
| **Mot de passe** | `password` |

---

## 📊 Architecture & Structure

### Architecture MVC

```
gestion-nouveaux-inscrits-bachelor/
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── CreateDatabase.php (Créer la BDD MySQL)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php (Tableau de bord + statistiques)
│   │   │   ├── EtudiantController.php (CRUD des étudiants)
│   │   │   └── Auth/
│   │   │       └── AuthenticatedSessionController.php (Authentification)
│   │   ├── Middleware/
│   │   └── Kernel.php
│   ├── Models/
│   │   ├── User.php (Administrateur)
│   │   └── Etudiant.php (Étudiant + méthodes statistiques)
│   └── Providers/
│       └── RouteServiceProvider.php
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   └── 2024_01_14_create_etudiants_table.php
│   ├── factories/
│   │   └── EtudiantFactory.php (Génération de données fictives)
│   └── seeders/
│       └── DatabaseSeeder.php (Insertion des données initiales)
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php (Layout principal avec sidebar)
│       ├── auth/
│       │   └── login.blade.php (Formulaire de connexion)
│       ├── dashboard.blade.php (Tableau de bord + graphiques)
│       └── etudiants/
│           ├── index.blade.php (Liste avec pagination + filtres)
│           ├── create.blade.php (Formulaire création)
│           ├── edit.blade.php (Formulaire modification)
│           └── show.blade.php (Détails d'un étudiant)
├── routes/
│   ├── web.php (Routes principales)
│   └── auth.php (Routes authentification)
├── config/
│   ├── app.php
│   ├── database.php
│   └── ...
└── ...
```

---

## 📋 Fonctionnalités Principales

### 1️⃣ **Authentification & Sécurité**
- ✅ Connexion/Déconnexion administrateur
- ✅ Protection des routes (middleware `auth`)
- ✅ Protection CSRF
- ✅ Validation Laravel

### 2️⃣ **Gestion des Étudiants (CRUD Avancé)**
- ✅ **Index** : Liste avec pagination (15 par page)
- ✅ **Create** : Ajouter un nouvel étudiant
- ✅ **Show** : Voir les détails complets
- ✅ **Edit** : Modifier les informations
- ✅ **Delete** : Supprimer avec confirmation
- ✅ **Recherche** : Par nom, prénom, email, CNE
- ✅ **Filtres** : Par filière, statut, période d'inscription

### 3️⃣ **Tableau de Bord Décisionnel**

#### 📌 **Statistiques Numériques (Cards)**
- Nombre total d'inscrits
- Nombre d'inscrits validés
- Nombre d'inscrits en attente
- Nombre d'inscrits rejetés

#### 📊 **Graphiques Interactifs (Chart.js)**
1. **Diagramme Circulaire** : Répartition par statut (Validé/En attente/Rejeté)
2. **Diagramme en Barres** : Nombre d'inscrits par filière
3. **Courbe Temporelle** : Évolution mensuelle des inscriptions
4. **Histogramme** : Inscriptions par année universitaire

#### 📈 **Tableau Analytique**
- Top des filières avec nombre d'inscrits et pourcentage

---

## 🗄️ Schéma de la Base de Données

### Table `users` (Administrateurs)
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255),
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Table `etudiants` (Étudiants)
```sql
CREATE TABLE etudiants (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    cne VARCHAR(255) UNIQUE,
    cin VARCHAR(255) UNIQUE,
    date_naissance DATE,
    email VARCHAR(255) UNIQUE,
    telephone VARCHAR(20),
    filiere VARCHAR(255),
    statut ENUM('En attente', 'Validé', 'Rejeté') DEFAULT 'En attente',
    date_inscription TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## 🎨 Design & Interface Utilisateur

### Couleurs Académiques
- **Bleu Principal** : `#003d82` (Professionnalisme)
- **Bleu Secondaire** : `#0066cc` (Accent)
- **Succès** : `#28a745` (Validé)
- **Alerte** : `#ffc107` (En attente)
- **Danger** : `#dc3545` (Rejeté)

### Composants UI
- **Sidebar** : Navigation fixe avec menu
- **Header** : Titre + Profil administrateur
- **Cards** : Statistiques avec icônes
- **Tableaux** : Lisibles avec actions
- **Formulaires** : Ergonomiques avec validation
- **Graphiques** : Interactifs et responsifs

### Responsive Design
- ✅ Desktop (1920px+)
- ✅ Tablette (768px - 1024px)
- ✅ Mobile (< 768px)

---

## 📝 Commandes Artisan Utiles

```bash
# Créer la base de données
php artisan db:create

# Exécuter les migrations
php artisan migrate

# Exécuter les migrations + seeders
php artisan migrate:fresh --seed

# Exécuter les seeders uniquement
php artisan db:seed

# Lancer le serveur de développement
php artisan serve

# Accéder à la console interactive
php artisan tinker
```

---

## 📊 Données de Test

L'application est pré-configurée avec **100 étudiants fictifs** générés automatiquement lors du seeding :

- **33 étudiants validés** (statut = "Validé")
- **33 étudiants en attente** (statut = "En attente")
- **34 étudiants rejetés** (statut = "Rejeté")

Filieres incluses :
- Licence Informatique
- Licence Gestion
- Licence Droit
- Licence Langues
- Licence Sciences

---

## 🔧 Configuration Avancée

### Variables d'Environnement (.env)

```dotenv
# Application
APP_NAME="Gestion des Nouveaux Inscrits"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_inscrits
DB_USERNAME=root
DB_PASSWORD=

# Session
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

---

## 📱 Routes Principales

| Route | Méthode | Description |
|-------|---------|-------------|
| `/` | GET | Redirection automatique |
| `/tableau-de-bord` | GET | Tableau de bord (auth) |
| `/login` | GET, POST | Connexion |
| `/logout` | POST | Déconnexion (auth) |
| `/etudiants` | GET | Liste des étudiants (auth) |
| `/etudiants/create` | GET | Formulaire création (auth) |
| `/etudiants` | POST | Enregistrer l'étudiant (auth) |
| `/etudiants/{id}` | GET | Détails d'un étudiant (auth) |
| `/etudiants/{id}/edit` | GET | Formulaire modification (auth) |
| `/etudiants/{id}` | PUT | Mettre à jour (auth) |
| `/etudiants/{id}` | DELETE | Supprimer (auth) |

---

## 🎓 Cas d'Utilisation

### 1. Administrateur se connecte
```
1. Accède à http://localhost:8000
2. Utilise admin@gestion-inscrits.local / password
3. Arrive au tableau de bord
```

### 2. Consulter les statistiques
```
1. Affiche automatiquement au tableau de bord
2. Voit les 4 graphiques interactifs
3. Peut filtrer par filière
```

### 3. Gérer un étudiant
```
1. Va à "Étudiants" → "Liste"
2. Cherche par nom/email ou filtre par statut
3. Peut voir, modifier ou supprimer
```

### 4. Ajouter un nouvel étudiant
```
1. Clique sur "Ajouter un étudiant"
2. Remplit le formulaire
3. Enregistre → Redirection vers la fiche
```

---

## 🐛 Dépannage

### Erreur : "Connection refused"
**Solution** : Vérifier que MySQL est en cours d'exécution

### Erreur : "Unknown database 'gestion_inscrits'"
**Solution** : Exécuter `php artisan db:create`

### Erreur : "CSRF token mismatch"
**Solution** : Vérifier que `@csrf` est inclus dans les formulaires

### Erreur de permission sur `/storage`
**Solution** : Exécuter `chmod -R 775 storage bootstrap/cache`

---

## 📚 Ressources & Références

- [Documentation Laravel 10](https://laravel.com/docs/10.x)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3)
- [Chart.js Documentation](https://www.chartjs.org/docs)
- [Laravel Blade Templates](https://laravel.com/docs/10.x/blade)

---

## 👨‍💻 Développement

### Structure des fichiers importants

- **app/Models/Etudiant.php** : Logique métier (statistiques)
- **app/Http/Controllers/DashboardController.php** : Préparation données graphiques
- **resources/views/layouts/app.blade.php** : Layout principal (Sidebar + Header)
- **resources/views/dashboard.blade.php** : Tous les graphiques Chart.js

### Conventions de code

- ✅ Noms français pour l'interface utilisateur
- ✅ Commentaires en français dans le code
- ✅ PSR-4 Autoloading
- ✅ Camel Case pour les variables PHP
- ✅ Snake Case pour les BD

---

## 📄 Licence

MIT License - Libre d'utilisation

---

## 📞 Support

Pour toute question ou problème, veuillez consulter la documentation Laravel ou contacter le support.

---

**Application prêt pour soutenance de PFE** ✅
*Dernière mise à jour : Janvier 2025*
 Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

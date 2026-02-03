# Guide d'Utilisation - Gestion des Nouveaux Inscrits en Bachelor

## 📋 Table des Matières
1. [Prérequis Système](#prérequis-système)
2. [Installation et Configuration](#installation-et-configuration)
3. [Démarrage de l'Application](#démarrage-de-lapplication)
4. [Première Connexion](#première-connexion)
5. [Interface Utilisateur](#interface-utilisateur)
6. [Gestion des Étudiants](#gestion-des-étudiants)
7. [Gestion des Filières](#gestion-des-filières)
8. [Tableau de Bord](#tableau-de-bord)
9. [Rapports et Statistiques](#rapports-et-statistiques)
10. [Dépannage](#dépannage)

---

## 🔧 Prérequis Système

Avant d'utiliser l'application, assurez-vous que votre environnement dispose des éléments suivants :

### Logiciels Requis
- **PHP 8.1+** avec les extensions suivantes :
  - `mbstring`
  - `PDO`
  - `JSON`
  - `bcmath`
  - `openssl`
- **MySQL 5.7+** ou **MariaDB**
- **Composer** (v2.0+) - Gestionnaire de dépendances PHP
- **Navigateur Web** moderne (Chrome, Firefox, Edge, Safari)

### Configuration Recommandée
- **RAM** : Minimum 2GB, recommandé 4GB+
- **Espace disque** : 500MB minimum
- **Système d'exploitation** : Windows 10+, macOS 10.15+, Linux (Ubuntu 18.04+)

---

## 🚀 Installation et Configuration

### Étape 1 : Téléchargement du Projet
```bash
# Cloner ou télécharger le projet
git clone <url-du-repo> gestion-inscrits
cd gestion-inscrits
```

### Étape 2 : Installation des Dépendances
```bash
# Installer les dépendances PHP via Composer
composer install
```

### Étape 3 : Configuration de l'Environnement
```bash
# Copier le fichier d'exemple de configuration
cp .env.example .env

# Générer la clé d'application Laravel
php artisan key:generate
```

### Étape 4 : Configuration de la Base de Données
1. **Créer une base de données MySQL** :
   ```sql
   CREATE DATABASE gestion_inscrits_bachelor;
   ```

2. **Configurer les paramètres dans `.env`** :
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gestion_inscrits_bachelor
   DB_USERNAME=votre_username
   DB_PASSWORD=votre_password
   ```

### Étape 5 : Migration et Données de Test
```bash
# Créer les tables de la base de données
php artisan migrate

# (Optionnel) Charger les données de test
php artisan db:seed
```

---

## ▶️ Démarrage de l'Application

### Démarrage du Serveur de Développement
```bash
# Démarrer le serveur Laravel
php artisan serve
```

L'application sera accessible à l'adresse : **http://localhost:8000**

### Accès par Défaut
- **URL** : http://localhost:8000
- **Email** : admin@gestion-inscrits.local
- **Mot de passe** : password

---

## 🔐 Première Connexion

1. **Accéder à l'application** via votre navigateur à l'adresse http://localhost:8000
2. **Cliquer sur "Connexion"** ou aller directement sur `/login`
3. **Saisir les identifiants** :
   - Email : admin@gestion-inscrits.local
   - Mot de passe : password
4. **Cliquer sur "Se connecter"**

> 💡 **Astuce** : Si vous avez chargé les données de test, plusieurs comptes utilisateurs sont disponibles.

---

## 🖥️ Interface Utilisateur

### Navigation Principale
L'application dispose d'une interface moderne avec :

- **Barre de navigation supérieure** : Accès aux différentes sections
- **Menu latéral** : Navigation rapide entre les fonctionnalités
- **Zone de contenu principale** : Affichage des données et formulaires
- **Tableau de bord** : Vue d'ensemble avec statistiques

### Sections Disponibles
- **🏠 Tableau de Bord** : Vue d'ensemble et statistiques
- **👨‍🎓 Étudiants** : Gestion des étudiants inscrits
- **🏫 Filières** : Gestion des filières académiques
- **📊 Rapports** : Génération de rapports et analyses
- **👤 Profil** : Gestion du compte utilisateur

---

## 👨‍🎓 Gestion des Étudiants

### Consulter la Liste des Étudiants
1. Aller dans **"Étudiants"** depuis le menu
2. La liste complète s'affiche avec pagination
3. Utiliser les filtres pour rechercher :
   - Par nom/prénom
   - Par filière
   - Par statut (Validé/En attente/Rejeté)

### Ajouter un Nouvel Étudiant
1. Cliquer sur **"Ajouter Étudiant"** ou **"+"**
2. Remplir le formulaire :
   - **Informations personnelles** : Nom, prénom, email, téléphone
   - **Documents** : CNE, CIN, date de naissance
   - **Académique** : Filière sélectionnée
3. **Valider** pour enregistrer

### Modifier un Étudiant
1. Dans la liste, cliquer sur **"Modifier"** (icône crayon)
2. Modifier les informations souhaitées
3. **Sauvegarder** les changements

### Changer le Statut d'un Étudiant
1. Dans la liste ou la fiche détail, utiliser le **sélecteur de statut**
2. Choisir parmi :
   - **Validé** ✅ : Inscription acceptée
   - **En attente** ⏳ : En cours de traitement
   - **Rejeté** ❌ : Inscription refusée
3. Le changement est automatiquement sauvegardé

### Supprimer un Étudiant
1. Cliquer sur **"Supprimer"** (icône poubelle)
2. **Confirmer** la suppression dans la boîte de dialogue
3. ⚠️ **Attention** : Cette action est irréversible

---

## 🏫 Gestion des Filières

### Consulter les Filières
1. Aller dans **"Filières"** depuis le menu
2. Voir la liste complète avec :
   - Nom de la filière
   - Description
   - Catégorie
   - Nombre d'étudiants inscrits

### Ajouter une Filière
1. Cliquer sur **"Ajouter Filière"**
2. Remplir le formulaire :
   - **Nom** : Nom complet de la filière
   - **Description** : Description détaillée
   - **Catégorie** : Domaine académique
3. **Valider** pour créer

### Modifier une Filière
1. Cliquer sur **"Modifier"** pour la filière concernée
2. Modifier les informations
3. **Sauvegarder**

### Supprimer une Filière
⚠️ **Important** : Une filière ne peut être supprimée que si aucun étudiant n'y est inscrit.

---

## 📊 Tableau de Bord

### Vue d'Ensemble
Le tableau de bord affiche automatiquement :
- **4 statistiques principales** :
  - Nombre total d'inscrits
  - Nombre d'inscrits validés
  - Nombre d'inscrits en attente
  - Nombre d'inscrits rejetés

### Graphiques Interactifs
- **Répartition par statut** : Diagramme circulaire
- **Distribution par filière** : Histogramme
- **Évolution mensuelle** : Courbe temporelle
- **Répartition par année** : Diagramme en barres

### Fonctionnalités du Tableau de Bord
- **Actualisation automatique** des données
- **Export possible** des graphiques
- **Navigation rapide** vers les listes détaillées

---

## 📈 Rapports et Statistiques

### Accès aux Rapports
1. Aller dans **"Rapports"** depuis le menu
2. Sélectionner le type de rapport souhaité

### Types de Rapports Disponibles
- **Rapport général** : Vue d'ensemble complète
- **Rapport par filière** : Statistiques détaillées par filière
- **Rapport de validation** : Suivi des statuts d'inscription
- **Rapport mensuel** : Évolution temporelle

### Export des Données
- **Format Excel** : Pour analyse approfondie
- **Format PDF** : Pour archivage et partage
- **Impression directe** : Pour documents physiques

---

## 🔧 Dépannage

### Problèmes Courants

#### Erreur de Connexion à la Base de Données
**Symptôme** : Page d'erreur "Database connection failed"
**Solution** :
1. Vérifier que MySQL est démarré
2. Contrôler les paramètres dans `.env`
3. Tester la connexion : `php artisan migrate:status`

#### Erreur 500 - Internal Server Error
**Symptôme** : Erreur 500 lors de l'accès à certaines pages
**Solution** :
1. Vérifier les logs : `storage/logs/laravel.log`
2. Vider le cache : `php artisan cache:clear`
3. Régénérer la clé : `php artisan key:generate`

#### Problème de Permissions
**Symptôme** : Erreur d'écriture dans `storage/`
**Solution** :
```bash
# Donner les permissions nécessaires
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

#### Migrations Non Appliquées
**Symptôme** : Tables manquantes dans la base
**Solution** :
```bash
# Appliquer les migrations
php artisan migrate

# Si nécessaire, forcer
php artisan migrate:fresh
```

### Commandes Utiles pour le Dépannage
```bash
# Vider tous les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Vérifier l'état des migrations
php artisan migrate:status

# Tester l'application
php artisan tinker
```

### Support et Aide
Si vous rencontrez un problème non résolu :
1. **Consulter les logs** dans `storage/logs/`
2. **Vérifier la configuration** dans `.env`
3. **Tester en mode debug** : `APP_DEBUG=true` dans `.env`

---

## 📞 Support et Contact

Pour toute question ou problème technique :
- **Documentation complète** : `RAPPORT_COMPLET.md`
- **Logs d'application** : `storage/logs/laravel.log`
- **Configuration** : `.env`

---

*Guide généré automatiquement - Version 1.0 - Février 2026*
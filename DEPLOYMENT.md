# Guide de Déploiement en Production

## ⚠️ Avant le Déploiement

### Checklist de Sécurité

- [ ] Changer les identifiants par défaut
- [ ] Définir `APP_DEBUG=false` dans `.env`
- [ ] Définir `APP_ENV=production` dans `.env`
- [ ] Générer une nouvelle `APP_KEY`
- [ ] Vérifier que tous les `.env` sont sécurisés

---

## 🚀 Déploiement sur un Serveur

### Option 1 : Serveur Web Classique (Apache/Nginx)

#### Prérequis
- PHP 8.1+
- MySQL 5.7+
- Composer
- Git (optionnel)

#### Étapes

1. **Cloner le projet**
   ```bash
   cd /var/www/html
   git clone <votre-repo> gestion-inscrits
   cd gestion-inscrits
   ```

2. **Installer les dépendances**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

3. **Configurer l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Modifier le .env pour la production**
   ```dotenv
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://votre-domaine.com
   
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_DATABASE=votre_db
   DB_USERNAME=votre_user
   DB_PASSWORD=votre_pwd_secure
   ```

5. **Créer la base de données**
   ```bash
   mysql -u root -p
   CREATE DATABASE votre_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

6. **Exécuter les migrations**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Configurer les permissions**
   ```bash
   chown -R www-data:www-data /var/www/html/gestion-inscrits
   chmod -R 775 storage bootstrap/cache
   ```

8. **Configurer Apache/Nginx**

   **Apache** (.htaccess)
   ```apache
   <IfModule mod_rewrite.c>
       RewriteEngine On
       RewriteCond %{REQUEST_FILENAME} !-f
       RewriteCond %{REQUEST_FILENAME} !-d
       RewriteRule ^(.*)$ index.php/$1 [L]
   </IfModule>
   ```

   **Nginx** (Vhost)
   ```nginx
   server {
       listen 80;
       server_name votre-domaine.com;
       root /var/www/html/gestion-inscrits/public;

       index index.php;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       location ~ \.php$ {
           fastcgi_pass unix:/run/php/php8.1-fpm.sock;
           fastcgi_index index.php;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
       }
   }
   ```

9. **Activer HTTPS avec Let's Encrypt** (Nginx)
   ```bash
   sudo apt-get install certbot python3-certbot-nginx
   sudo certbot --nginx -d votre-domaine.com
   ```

10. **Mettre en cache l'application**
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

---

### Option 2 : Déploiement via Docker

#### Dockerfile
```dockerfile
FROM php:8.1-fpm

# Installer les extensions
RUN docker-php-ext-install pdo pdo_mysql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers
COPY . .

# Installer les dépendances
RUN composer install --optimize-autoloader --no-dev

# Permissions
RUN chown -R www-data:www-data /app

EXPOSE 9000
CMD ["php-fpm"]
```

#### docker-compose.yml
```yaml
version: '3.8'

services:
  app:
    build: .
    ports:
      - "9000:9000"
    volumes:
      - .:/app
    environment:
      - APP_ENV=production
      - APP_DEBUG=false
    depends_on:
      - db

  nginx:
    image: nginx:alpine
    ports:
      - "80:80"
    volumes:
      - .:/app
      - ./nginx.conf:/etc/nginx/nginx.conf
    depends_on:
      - app

  db:
    image: mysql:5.7
    environment:
      MYSQL_DATABASE: gestion_inscrits
      MYSQL_ROOT_PASSWORD: root_password
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

---

### Option 3 : Hébergement Cloud (AWS, Azure, Heroku)

#### Heroku

1. **Installer Heroku CLI**
   ```bash
   npm install -g heroku
   heroku login
   ```

2. **Initialiser l'app Heroku**
   ```bash
   heroku create votre-app-name
   ```

3. **Ajouter la buildpack PHP**
   ```bash
   heroku buildpacks:add heroku/php
   ```

4. **Configurer les variables d'environnement**
   ```bash
   heroku config:set APP_ENV=production
   heroku config:set APP_KEY=$(php artisan key:generate --show)
   ```

5. **Créer la base de données** (via Heroku PostgreSQL ou MySQL)
   ```bash
   heroku addons:create cleardb:spark
   ```

6. **Déployer**
   ```bash
   git push heroku main
   ```

---

## 📊 Configuration Avancée

### Sécurisation

```dotenv
# .env Production
APP_DEBUG=false
APP_ENV=production
APP_TIMEZONE=Africa/Casablanca

# Base de données
DB_PASSWORD=un_mot_de_passe_tres_long_et_securise

# Session
SESSION_SECURE_COOKIES=true
SESSION_HTTP_ONLY=true
```

### Optimisation des Performances

```bash
# Mettre en cache la configuration
php artisan config:cache

# Mettre en cache les routes
php artisan route:cache

# Mettre en cache les vues
php artisan view:cache

# Optimiser l'autoloading
composer install --optimize-autoloader
```

### Monitoring et Logs

```bash
# Voir les logs
tail -f storage/logs/laravel.log

# Configurer la rotation des logs (.env)
LOG_CHANNEL=single
LOG_LEVEL=error
```

---

## 🔐 Configuration HTTPS Obligatoire

### Forcer HTTPS dans Laravel

Éditez `app/Providers/AppServiceProvider.php` :

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Forcer HTTPS en production
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
```

---

## 💾 Sauvegarde de la Base de Données

### Sauvegarde Automatique

```bash
# Créer un script de sauvegarde
#!/bin/bash
mysqldump -u user -p password gestion_inscrits > backup_$(date +%Y%m%d).sql

# Ajouter au cron (quotidien à 2h du matin)
0 2 * * * /home/user/backup_db.sh
```

### Restauration

```bash
mysql -u user -p database_name < backup_20240114.sql
```

---

## 🚨 Dépannage Production

### Erreur : "The log file does not exist"
```bash
php artisan log:clear
chmod -R 775 storage/logs
```

### Erreur : "Class not found"
```bash
php artisan cache:clear
php artisan config:clear
composer dump-autoload
```

### Erreur de permission
```bash
chown -R www-data:www-data .
chmod -R 755 storage bootstrap
```

---

## ✅ Checklist Final

Avant le lancement en production :

- [ ] APP_DEBUG = false
- [ ] APP_ENV = production
- [ ] HTTPS activé
- [ ] Base de données sécurisée
- [ ] Sauvegardes automatiques configurées
- [ ] Permissions des fichiers correctes
- [ ] Logs configurés
- [ ] Cache activé
- [ ] Authentification testée
- [ ] Toutes les filiières disponibles

---

## 📞 Support Production

Pour les problèmes en production :
1. Vérifiez les logs : `storage/logs/laravel.log`
2. Vérifiez l'état de la base de données
3. Vérifiez les permissions des fichiers
4. Consultez la documentation Laravel

---

**Bonne chance pour le déploiement ! 🚀**

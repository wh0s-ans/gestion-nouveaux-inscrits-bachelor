# Configuration des Filières

## Filières Disponibles

L'application est pré-configurée avec **14 filières de Bachelor** organisées en **3 catégories** :

### 📚 Sciences (4 filières)
1. **Licence Mathématiques** - Formation mathématique avancée
2. **Licence Physique** - Sciences physiques appliquées
3. **Licence Chimie** - Chimie générale et spécialisée
4. **Licence Biologie** - Sciences biologiques et vie

### 💼 Business (5 filières)
1. **Licence Gestion** - Gestion administrative et financière
2. **Licence Comptabilité** - Comptabilité et audit
3. **Licence Marketing** - Techniques marketing et commercial
4. **Licence Ressources Humaines** - Gestion des RH
5. **Licence Finance** - Finance et banque

### 💻 Technologies (5 filières)
1. **Licence Informatique** - Développement logiciel
2. **Licence Réseaux** - Administration systèmes et réseaux
3. **Licence Web** - Développement web et mobile
4. **Licence Data Science** - Data science et IA
5. **Licence Cybersécurité** - Cybersécurité et protection

---

## Gestion des Filières via Interface Web

### Accéder à la Page de Gestion

1. Depuis le tableau de bord, cliquez sur "Filières" dans le menu latéral
2. Ou naviguez vers `/filieres`

### Ajouter une Nouvelle Filière

```
URL: /filieres/create
Champs requis:
- Nom (unique, max 255 caractères)
- Catégorie (optionnel, ex: Sciences, Business, IT)
- Description (optionnel, texte long)
```

### Modifier une Filière

```
URL: /filieres/{id}/edit
Champs modifiables:
- Nom (unique)
- Catégorie
- Description
```

### Supprimer une Filière

```
URL: DELETE /filieres/{id}
Attention: Cela supprimera aussi la référence dans les formulaires de filière
```

### Voir les Détails d'une Filière

```
URL: /filieres/{id}
Affiche:
- Nom de la filière
- Description complète
- Nombre d'étudiants inscrits
- Liste des étudiants
```

---

## Architecture Technique

### Modèle de Données

**Table `filieres`**
```sql
- id (PK)
- nom (VARCHAR, unique)
- description (TEXT, nullable)
- categorie (VARCHAR, nullable)
- timestamps (created_at, updated_at)
```

**Table `etudiants` (modification)**
```sql
- filiere_id (FK → filieres.id, nullable, onDelete='set null')
-- Anciennement: filiere (VARCHAR) - SUPPRIMÉ
```

### Relations Eloquent

```php
// Dans Filiere.php
public function etudiants()
{
    return $this->hasMany(Etudiant::class);
}

// Dans Etudiant.php
public function filiere()
{
    return $this->belongsTo(Filiere::class);
}
```

### Routes API

```php
GET    /filieres           # Liste paginée (10 par page)
POST   /filieres           # Créer nouvelle filière
GET    /filieres/create    # Formulaire création
GET    /filieres/{id}      # Voir détails
PUT    /filieres/{id}      # Mettre à jour
DELETE /filieres/{id}      # Supprimer
GET    /filieres/{id}/edit # Formulaire modification
```

---

## Statistiques et Rapports

### Sur le Dashboard

Le tableau de bord affiche :
- Nombre total d'étudiants par filière (graphique barres)
- Top 5 filières avec le plus d'inscrits
- Répartition par catégorie

### Code pour Obtenir des Statistiques

```php
// Compter les étudiants d'une filière
$count = Filiere::find(1)->etudiants()->count();

// Toutes les filières avec leurs étudiants
$filieres = Filiere::with('etudiants')->get();
foreach ($filieres as $filiere) {
    echo $filiere->nom . ': ' . $filiere->etudiants->count() . ' étudiants';
}

// Filières par catégorie
$filieres = Filiere::where('categorie', 'Sciences')->get();
```

---

## Architecture de la Filière

### Dans la Base de Données

- **Type** : VARCHAR(255)
- **Null** : Non
- **Default** : Aucune
- **Unique** : Non (plusieurs étudiants par filière)

### Dans le Modèle

```php
class Etudiant extends Model
{
    public static function getFilieres()
    {
        return self::distinct()->pluck('filiere')->toArray();
    }

    public static function countByFiliere($filiere)
    {
        return self::where('filiere', $filiere)->count();
    }
}
```

### Dans le Contrôleur

```php
$filieres = Etudiant::getFilieres();
return view('etudiants.create', ['filieres' => $filieres]);
```

---

## Exemple : Ajouter "Licence Biologie"

1. **Via le formulaire web** :
   - Ajouter un étudiant
   - Tapez "Licence Biologie" dans le champ Filière
   - Enregistrez

2. **Via la Factory** (pour tests) :
   ```bash
   php artisan tinker
   >>> Etudiant::factory()->create(['filiere' => 'Licence Biologie'])
   ```

3. **Vérifier** :
   - Le tableau montre la nouvelle filière
   - Le graphique s'actualise automatiquement
   - Le filtre la propose

---

## Conseils

- ✅ Les filières sont **flexibles** (pas de table séparée)
- ✅ Les filieres s'ajoutent **automatiquement** en créant un étudiant
- ✅ Les statistiques s'actualisent **en temps réel**
- ✅ Aucune migration n'est nécessaire pour ajouter une filière

---

## Restriction Actuelle

Il n'y a actuellement **pas de validation** sur les noms de filière.
Vous pouvez entrer n'importe quel texte dans le champ.

Pour ajouter une validation, éditez [app/Http/Controllers/EtudiantController.php](app/Http/Controllers/EtudiantController.php) :

```php
$validated = $request->validate([
    'filiere' => 'required|string|max:255|in:Licence Informatique,Licence Gestion,Licence Droit,Licence Langues,Licence Sciences',
    // ...
]);
```

---

Plus d'informations dans le [README.md](README.md) ! 📚

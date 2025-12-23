# Application de Gestion des Tâches - Laravel

Application complète de gestion des tâches avec Laravel incluant toutes les fonctionnalités demandées.

## Fonctionnalités

✅ **Gestion des rôles (Admin/User)**
- Système d'authentification complet
- Middlewares pour la gestion des accès
- Interface différenciée selon le rôle

✅ **Gestion des tâches avec 3 statuts**
- Statuts: À faire, En cours, Terminé
- Priorités: Faible, Moyenne, Élevée, Urgente
- Catégorisation des tâches
- Historique des modifications
- Commentaires sur les tâches
- Fichiers joints

✅ **Messagerie entre utilisateurs**
- Messages privés entre utilisateurs
- Lien avec les tâches
- Système d'archivage
- Notifications pour nouveaux messages

✅ **Calendrier pour les événements**
- Intégration FullCalendar
- Événements liés aux tâches
- Types d'événements: Tâche, Réunion, Personnel, Projet
- Rappels configurables

✅ **Notifications en temps réel**
- Notifications pour nouvelles tâches
- Notifications pour messages
- Notifications pour changements de statut
- Badge de compteur en temps réel
- Rafraîchissement automatique

✅ **Statistiques pour l'admin**
- Dashboard administrateur complet
- Statistiques globales
- Graphiques de répartition
- Vue d'ensemble des utilisateurs

✅ **Profils utilisateurs complets**
- Gestion du profil utilisateur
- Avatar personnalisable
- Paramètres de notification
- Thème et langue
- Informations professionnelles

## Installation

### Prérequis
- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js et npm

### Étapes d'installation

1. **Cloner le projet**
```bash
cd gestion-des-taches
```

2. **Installer les dépendances**
```bash
composer install
npm install
```

3. **Configuration de l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurer la base de données dans `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_taches
DB_USERNAME=root
DB_PASSWORD=
```

5. **Créer la base de données**
```sql
CREATE DATABASE gestion_taches;
```

6. **Exécuter les migrations**
```bash
php artisan migrate
```

7. **Seeder les données initiales**
```bash
php artisan db:seed
```

8. **Créer le lien symbolique pour le stockage**
```bash
php artisan storage:link
```

9. **Compiler les assets**
```bash
npm run build
```

10. **Lancer le serveur**
```bash
php artisan serve
```

## Comptes par défaut

Après le seeding, vous pouvez vous connecter avec:

- **Email:** admin@taskapp.com
- **Mot de passe:** Admin123!

## Structure de la base de données

L'application utilise 18 tables principales:
- `users` - Utilisateurs avec rôles
- `categories` - Catégories de tâches
- `tasks` - Tâches principales
- `task_comments` - Commentaires sur les tâches
- `task_history` - Historique des modifications
- `messages` - Messages privés
- `conversations` - Conversations de groupe
- `conversation_messages` - Messages de groupe
- `notifications` - Notifications système
- `events` - Événements du calendrier
- `user_profiles` - Profils utilisateurs
- `statistiques` - Données statistiques
- `settings` - Paramètres système
- `fichiers` - Fichiers joints
- `logs` - Journal d'activités
- `reports` - Rapports générés
- `user_preferences` - Préférences utilisateurs

## Utilisation

### Pour les utilisateurs
1. S'inscrire ou se connecter
2. Accéder au dashboard pour voir ses tâches
3. Créer et gérer des tâches
4. Communiquer via la messagerie
5. Consulter le calendrier
6. Gérer son profil

### Pour les administrateurs
1. Se connecter avec le compte admin
2. Accéder au dashboard administrateur
3. Gérer les utilisateurs
4. Créer des catégories
5. Consulter les statistiques
6. Gérer toutes les tâches

## Technologies utilisées

- **Backend:** Laravel 12
- **Frontend:** Bootstrap 5, jQuery
- **Calendrier:** FullCalendar 5
- **Graphiques:** Chart.js
- **Base de données:** MySQL/MariaDB

## Notes importantes

- Les fichiers uploadés sont stockés dans `storage/app/public`
- Les avatars sont stockés dans `storage/app/public/avatars`
- Les notifications sont rafraîchies toutes les 30 secondes
- Le système de notifications en temps réel utilise AJAX (peut être amélioré avec Laravel Echo + Pusher)

## Améliorations possibles

- Intégration Laravel Echo + Pusher pour les notifications en temps réel
- API REST pour mobile
- Export PDF des rapports
- Recherche avancée
- Filtres multiples
- Drag & drop pour les tâches

## Licence

MIT

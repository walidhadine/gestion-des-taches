# Rapport du projet — gestion-des-taches

Date: 2025-12-14

## 1. Résumé du projet

- Nom du projet: `gestion-des-taches`
- Stack: Laravel (PHP), Blade views, migrations, Eloquent models.
- Fonction: gestion collaborative des tâches avec messagerie, calendrier, notifications, profils et administration.

## 2. Structure du projet (sélectif)

- `app/Models/` : modèles Eloquent (User, Task, Message, Category, ...)
- `app/Http/Controllers/` : contrôleurs (AuthController, TaskController, MessageController, AdminController, ...)
- `database/migrations/` : définitions des tables
- `resources/views/` : vues Blade (auth, dashboard, tasks, messages, ...)
- `routes/web.php` : routes HTTP principales

## 3. Modèles principaux

- `User`, `UserProfile`, `UserPreference`
- `Task`, `TaskComment`, `TaskHistory`
- `Category`
- `Message`, `Conversation`, `ConversationMessage`, `ConversationMember`
- `Notification`
- `Event`
- `Fichier`, `Report`, `Log`, `Setting`, `Statistique`

## 4. Base de données — tables et champs clés

Voici les tables principales extraites des migrations et leurs champs importants.

- `users`
  - `id`, `role` (enum `admin|user`), `email` (unique), `password`, `nom`, `prenom`
  - `is_active`, `last_login`, `token_reset`, `token_expiration`, `remember_token`, `timestamps`

- `categories`
  - `id`, `nom`, `description`, `color`, `icon`, `created_by` (FK -> `users`), `is_default`, `timestamps`

- `tasks`
  - `id`, `titre`, `description`, `status` (enum `à faire|en cours|terminé`), `priority` (enum)
  - `date_debut`, `date_fin`, `heure_debut`, `heure_fin`
  - `created_by` (FK -> `users`), `assigned_to` (FK -> `users`), `category_id` (FK -> `categories`)
  - `is_important`, `completion_percentage`, `notes`, `fichier_joint`, `date_creation`, `date_modification`, `timestamps`
  - Indexes: `status`, `assigned_to`, `created_by`, `date_debut/date_fin`, `priority`, `category_id`

- `task_comments`
  - `id`, `task_id` (FK -> `tasks`), `user_id` (FK -> `users`), `comment`, `fichier_joint`, `date_comment`, `timestamps`

- `task_history`
  - `id`, `task_id`, `user_id`, `action`, `ancienne_valeur`, `nouvelle_valeur`, `date_action`, `timestamps`

- `messages`
  - `id`, `expediteur_id` (FK `users`), `destinataire_id` (FK `users`), `task_id` (nullable FK `tasks`)
  - `sujet`, `message`, `lu` (bool), `date_envoi`, `is_archived_exp`, `is_archived_dest`, `timestamps`
  - Indexes: `expediteur_id`, `destinataire_id`, `lu`, `date_envoi`

- `conversations`
  - `id`, `nom` (nullable), `created_by` (FK -> `users`), `is_group` (bool), `timestamps`

- `conversation_members`
  - composite PK [`conversation_id`, `user_id`], `joined_at`

- `conversation_messages`
  - `id`, `conversation_id` (FK), `sender_id` (FK `users`), `message`, `date_envoi`, `timestamps`

- `notifications`
  - `id`, `user_id` (FK), `type` (enum: `nouvelle_tache`, `message`, `rappel`, `statut_change`, `commentaire`, `echeance`)
  - `titre`, `contenu`, `lien`, `vue` (bool), `data` (json), `timestamps`
  - Indexes: `user_id`, `vue`, `created_at`

- `events`
  - `id`, `user_id` (FK), `titre`, `description`, `start_date`, `end_date`, `type` (enum), `couleur`, `task_id` (nullable FK), `lieu`, `rappel_minutes`, `timestamps`

- `user_profiles`
  - `id`, `user_id` (unique FK), `avatar`, `telephone`, `poste`, `departement`, `notifications_email`, `notifications_app`, `theme`, `langue`, `signature`, `bio`, `timestamps`

- `statistiques`
  - `id`, `date_jour`, `total_taches`, `taches_terminees`, `taches_en_cours`, `taches_retard`, `total_utilisateurs`, `taux_completion`, `user_id` (nullable FK), `category_id` (nullable FK), `timestamps`

- `settings`
  - `id`, `cle` (unique), `valeur`, `type` (enum), `description`, `timestamps`

- `fichiers`
  - `id`, `nom_original`, `nom_stockage`, `chemin`, `type_mime`, `taille`, `uploaded_by` (FK), `task_id` (nullable FK), `message_id` (nullable FK), `uploaded_at`, `timestamps`

- `logs`
  - `id`, `user_id` (nullable FK), `action`, `details`, `ip_address`, `user_agent`, `timestamps`

- `reports`
  - `id`, `titre`, `type` (enum), `generated_by` (FK), `fichier_path`, `parametres` (json), `generated_at`, `timestamps`

- `user_preferences`
  - `id`, `user_id` (FK), `pref_key`, `pref_value`, unique(`user_id`, `pref_key`), `timestamps`

- Tables système: `sessions`, `password_reset_tokens`, `jobs`, `failed_jobs`, `cache` (présentes via migrations standards)

## 5. Routes et pages (aperçu)

- Routes publiques: `/login`, `/register`
- Routes protégées (`auth`, `user` middleware):
  - `/dashboard`
  - Resource `tasks` => CRUD `/tasks`
  - `POST /tasks/{task}/status` (changer statut)
  - `POST /tasks/{task}/comment` (ajouter commentaire)
  - Messages: `/messages`, `/messages/create`, `/messages/{message}`, plus read/archive/delete
  - Calendar: `/calendar`, `/calendar/events`
  - Notifications: `/notifications`, `/notifications/unread`, `/notifications/count`, etc.
  - Profile: `/profile`, `/profile/edit`, `/profile/password`
- Admin (`prefix admin`, `admin` middleware): `/admin/users`, `/admin/categories`, `/admin/statistics`, etc.

## 6. Vues / Pages (emplacements clés)

- Auth: `resources/views/auth/*` (login, register)
- Dashboard: `resources/views/dashboard.blade.php` (ou dossier `dashboard`)
- Tasks: `resources/views/tasks/*` (index, show, create, edit)
- Messages: `resources/views/messages/*`
- Calendar: `resources/views/calendar/*`
- Admin: `resources/views/admin/*`

## 7. Observations et recommandations

- ENUMs en base: attention compatibilité multi-SGBD et migrations futures. Considérer tables de référence pour statuts/priorités.
- Champs `date_creation`/`date_modification` + `timestamps()` : vérifier redondance et usage.
- `fichier_joint` en string : si multiple/futures évolutions, migrer vers table `fichiers` (déjà présente).
- Ajouter seeders et tests d'intégration si non présents.
- Documenter l'API (ex: `docs/API.md` ou Swagger) pour faciliter front-end.

## 8. Prochaines étapes que je peux faire

- Générer un diagramme ER (PNG/SVG) à partir des migrations.
- Produire `docs/DB_SCHEMA.md` table par table (CSV/Markdown détaillé).
- Générer un PDF de ce rapport et le sauvegarder dans `docs/PROJECT_REPORT.pdf` si un outil (`pandoc` ou `wkhtmltopdf`) est disponible.

---

Fichier généré automatiquement par l'analyse des migrations et des routes.

Projet API Media - README

Auteur de l'API : RAMANANTSOA Mika

Introduction


Ce projet implémente une API RESTful construite avec Symfony et API Platform. 
Elle permet la gestion des boissons, des commandes et des utilisateurs, ainsi que le téléchargement, la lecture et la suppression de fichiers média. 
L'accès à certaines opérations est restreint par rôles utilisateurs (serveur, barman, patron).

Prérequis

PHP 8.0 ou supérieur
Composer
Symfony CLI (optionnel mais recommandé)
Un serveur web (Apache, Nginx, etc.)
Une base de données compatible avec Doctrine ORM (MySQL, PostgreSQL, SQLite, etc.)

Lecture des médias

Pour récupérer la liste des objets médias, utilisez la route GET /api/medias.

Pour récupérer un objet média spécifique, utilisez la route GET /api/medias/{id}.

Gestion des boissons

Création d'une boisson

Pour créer une boisson, utilisez la route POST /api/boissons (réservée aux utilisateurs avec le rôle ROLE_BARMAN).

Lecture des boissons

Pour récupérer la liste des boissons, utilisez la route GET /api/boissons.

Lecture des détails d'une boisson

Pour récupérer les détails d'une boisson, utilisez la route GET /api/boissons/{id} (réservée aux utilisateurs avec le rôle ROLE_BARMAN).

Modification d'une boisson

Pour modifier une boisson, utilisez la route PATCH /api/boissons/{id} (réservée aux utilisateurs avec le rôle ROLE_BARMAN).

Suppression d'une boisson

Pour supprimer une boisson, utilisez la route DELETE /api/boissons/{id} (réservée aux utilisateurs avec le rôle ROLE_BARMAN).


Gestion des commandes

Création d'une commande

Pour créer une commande, utilisez la route POST /api/commandes (réservée aux utilisateurs avec le rôle ROLE_SERVEUR ou ROLE_BARMAN).

Lecture des commandes

Pour récupérer la liste des commandes, utilisez la route GET /api/commandes (réservée aux utilisateurs avec le rôle ROLE_SERVEUR ou ROLE_BARMAN).

Lecture des détails d'une commande

Pour récupérer les détails d'une commande, utilisez la route GET /api/commandes/{id} (réservée aux utilisateurs avec le rôle ROLE_BARMAN et ROLE_SERVEUR).

Modification d'une commande

Pour modifier une commande, utilisez la route PATCH /api/commandes/{id} (réservée aux utilisateurs avec le rôle ROLE_SERVEUR ou ROLE_BARMAN).

Suppression d'une commande

Pour supprimer une commande, utilisez la route DELETE /api/commandes/{id}.


Gestion des utilisateurs

Création d'un utilisateur

Pour créer un utilisateur, utilisez la route POST /api/users (réservée aux utilisateurs avec le rôle ROLE_PATRON).

Lecture des utilisateurs

Pour récupérer la liste des utilisateurs, utilisez la route GET /api/users (réservée aux utilisateurs avec le rôle ROLE_PATRON).

Lecture des détails d'un utilisateur

Pour récupérer les détails d'un utilisateur, utilisez la route GET /api/users/{id} (réservée aux utilisateurs avec le rôle ROLE_PATRON).

Modification d'un utilisateur

Pour modifier un utilisateur, utilisez la route PATCH /api/users/{id} (réservée aux utilisateurs avec le rôle ROLE_PATRON).

Suppression d'un utilisateur

Pour supprimer un utilisateur, utilisez la route DELETE /api/users/{id} (réservée aux utilisateurs avec le rôle ROLE_PATRON).


Ce document fournit une vue d'ensemble complète sur la façon d'installer, configurer et utiliser l'API Media construite avec Symfony et API Platform.

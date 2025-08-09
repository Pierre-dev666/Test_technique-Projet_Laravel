# Application de gestion de réservations immobilières

## 📌 Description
Cette application Laravel permet de :
- Créer et gérer des propriétés
- Effectuer des réservations (côté utilisateur connecté)
- Gérer toutes les réservations et propriétés via un espace administrateur
- Prévenir les chevauchements de réservations
- Offrir une interface responsive et moderne

## 🛠 Technologies utilisées
- **Laravel 12** (PHP 8.2+)
- **Laravel Breeze** pour l’authentification
- **Livewire 3** pour les composants dynamiques
- **Filament 3** pour l’interface d’administration
- **TailwindCSS** pour le design responsive
- **MySQL** pour la base de données

## 🚀 Installation
1. Cloner le dépôt :
```bash
git clone https://github.com/moncompte/monprojet.git
cd monprojet
```

2. Installer les dépendances PHP :
```bash
composer install
```

3. Installer les dépendances JavaScript :
```bash
npm install
```

4. Configurer le fichier `.env` (base de données, etc.)

5. Lancer les migrations :
```bash
php artisan migrate
```

6. Compiler les assets :
```bash
npm run dev
```

7. Lancer le serveur :
```bash
php artisan serve
```

## 🔑 Accès
- **Espace public** : accessible aux utilisateurs connectés
- **Espace administrateur** : `/admin` réservé aux comptes administrateurs

## 👨‍💻 Compte administrateur par défaut
- Email : `johndoe@test.com`
- Mot de passe : `password01`

## 👨‍🎨 Auteur
Projet développé par **Pierre COUDERC** dans le cadre d’un test technique.

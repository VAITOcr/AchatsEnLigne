AchatsEnLigne
AchatsEnLigne est une plateforme d'achat en ligne moderne, conçue pour offrir une expérience utilisateur fluide et sécurisée. Ce projet vise à simplifier le processus d'achat pour les clients tout en fournissant aux administrateurs des outils puissants pour gérer les produits, les commandes et les utilisateurs.

Fonctionnalités
Catalogue de produits : Parcourir une large gamme de produits avec des filtres par catégorie, prix, etc.

Panier d'achat : Ajouter, modifier ou supprimer des articles du panier.

Processus de commande : Passer des commandes avec des options de paiement sécurisées.

Gestion des utilisateurs : Inscription, connexion et gestion du profil utilisateur.

Interface administrateur : Ajouter, modifier ou supprimer des produits, gérer les commandes et les utilisateurs.​

Technologies utilisées
Frontend : React.js, Redux, Bootstrap

Backend : Node.js, Express.js

Base de données : MongoDB

Authentification : JWT (JSON Web Tokens)

Paiement : Intégration avec Stripe​

Installation
Cloner le dépôt :

bash
Copier
Modifier
git clone https://github.com/VAITOcr/AchatsEnLigne.git
cd AchatsEnLigne
Installer les dépendances :

bash
Copier
Modifier
npm install
Configurer les variables d'environnement :

Créer un fichier .env à la racine du projet et y ajouter les variables nécessaires :

env
Copier
Modifier
PORT=5000
MONGO_URI=your_mongodb_connection_string
JWT_SECRET=your_jwt_secret
STRIPE_SECRET_KEY=your_stripe_secret_key
Démarrer le serveur :

bash
Copier
Modifier
npm start

Tests
Pour exécuter les tests unitaires et d'intégration :​

bash
Copier
Modifier
npm test

Contribuer
Les contributions sont les bienvenues ! Pour contribuer :

Fork le projet

Crée une branche pour ta fonctionnalité (git checkout -b feature/AmazingFeature)

Commit tes modifications (git commit -m 'Add some AmazingFeature')

Push vers la branche (git push origin feature/AmazingFeature)

Ouvre une Pull Request​


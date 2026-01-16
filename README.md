# Job Dating App Modernization - Custom MVC Framework

Ce projet consiste en la migration d'une application de **Job Dating** existante vers une architecture **MVC (Modèle-Vue-Contrôleur)** personnalisée. L'objectif est de transformer une base de code héritée en une structure moderne, évolutive et sécurisée, inspirée des meilleurs frameworks PHP comme Symfony.

## 📌 Contexte du Projet

L'administration souhaite améliorer la maintenabilité et l'évolutivité de l'outil de Job Dating. Pour ce faire, nous avons développé un **framework PHP minimaliste** "from scratch" qui sépare strictement la logique métier, l'accès aux données et l'affichage.

## ✨ Fonctionnalités Clés

- **Architecture MVC :** Séparation claire entre les contrôleurs (logique), les modèles (données) et les vues (interface).
- **Routing Avancé :** Système de gestion d'URL propres via un routeur personnalisé.
- **Sécurité Renforcée :** Protection native contre les failles **XSS, CSRF** et **Injections SQL**.
- **Gestion Duale :** Séparation fonctionnelle entre le **Front Office** (Candidats/Entreprises) et le **Back Office** (Admin).
- **Eloquent ORM (Bonus) :** Intégration de l'ORM de Laravel pour une manipulation fluide de la base de données.
- **Validation & Session :** Classes utilitaires pour la validation des données et la gestion sécurisée des sessions utilisateurs.

/job_dating
├── public/
│   ├── index.php
│   ├── .htaccess
│   └── assets/
├── app/
│   ├── controllers/
│   │   ├── front/
│   │   └── back/
│   ├── models/
│   ├── views/
│   └── core/
│       ├── Router.php
│       ├── Controller.php
│       ├── Model.php
│       ├── View.php
│       ├── Database.php
│       ├── Auth.php
│       ├── Validator.php
│       ├── Security.php
│       └── Session.php
├── config/
│   ├── config.php
│   └── routes.php
├── logs/ # Bonus
├── vendor/
├── .env
├── composer.json
└── .gitignore
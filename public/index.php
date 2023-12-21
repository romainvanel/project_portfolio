<?php

// Chargement des dépendances PHP
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

// Chargement du Router
require_once '../core/Router.php';

// Instancier notre routeur afin de rediriger notre utilisateur
$router = new Router();

// Nos routes
// Accueil
$router->add('/portfolio', 'HomeController', 'index');
// Formulaire de contact
$router->add('/portfolio/contact', 'HomeController', 'contact');
// Insertion de données d'essais
$router->add('/portfolio/fixtures', 'FixtureController', 'index');
// Détail d'un projet
$router->add('/portfolio/projet/details', 'HomeController', 'details');
// Erreur 404
$router->add('/portfolio/404', 'ErrorController', 'error404');
// Formulaire de connexion
$router->add('/portfolio/login', 'AuthController', 'login');
// Administration
$router->add('/portfolio/admin', 'AdminController', 'admin');

// Dispatch
$router->dispatch($_SERVER['REQUEST_URI']);
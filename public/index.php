<?php

// Chargement des dépendances PHP
require_once '../vendor/autoload.php';

// Démarrage de la session
session_start();

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
// Formulaire de connexion
$router->add('/portfolio/login', 'AuthController', 'login');
// Déconnexion
$router->add('/portfolio/logout', 'AuthController', 'logout');
// Administration
$router->add('/portfolio/admin', 'AdminController', 'index');
// Ajout de nouveau projet
$router->add('/portfolio/admin/projet/add', 'AdminController', 'addProjet');
// Erreur 404
$router->add('/portfolio/404', 'ErrorController', 'error404');


// Dispatch
$router->dispatch($_SERVER['REQUEST_URI']);
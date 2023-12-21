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
$router->add('/portfolio', 'HomeController', 'index');
$router->add('/portfolio/contact', 'HomeController', 'contact');
$router->add('/portfolio/fixtures', 'FixtureController', 'index');


// Dispatch
$router->dispatch($_SERVER['REQUEST_URI']);
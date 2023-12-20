<?php

// Chargement des dépendances PHP
require_once '../vendor/autoload.php';

// Chargement du Router
require_once '../core/Router.php';

// Instancier notre routeur afin de rediriger notre utilisateur
$router = new Router();

// Nos routes
$router->add('/portfolio', 'HomeController', 'index');
$router->add('/portfolio/contact', 'HomeController', 'contact');

// Dispatch
$router->dispatch($_SERVER['REQUEST_URI']);
<?php

/**
 * Permet de rediriger l'utilisateur selon une adresse personnalisée
 */

 class Router {

    private array $routes = [];

    public function dispatch(string $uri = '/'): void {
        // On enregistre la position du "?" dans l'URI si il existe
        $position = strpos($uri, '?');

        // Si $position est égal à "true", on nettoie l'URI en retirant tout ce qui se trouve après le "?"
        if ($position) {
            /**
             * Ex : /details?id=5
             * Résultat : /details
             */
            $uri = substr($uri, 0, $position);
        }

        // si l'URI est différent d'un slash, on continue le nettoyage
        if ($uri !== '/') {
            // Récupère le dernier caractère de mon URI
            $lastChar = substr($uri, -1);
            
            //Si le dernier caractère est un slash, on le retire
            if ($lastChar === '/') {
                // Retourne la chaine sans le dernier caractère
                $uri = substr($uri, 0, -1);
            }
        }

        // Si le tableau des routes n'est pas vide, alors on effectue une recherche
        if (!empty($this->routes)) {

            // Si la route existe dans la configuration, on charge le controller
            if (isset($this->routes[$uri])) {
                // list($controller, $method) = $this->routes[$uri];
                [$controller, $method] = $this->routes[$uri];

                // Inclusion du fichier controller s'il existe
                require_once "../src/Controller/$controller.php";

                // Vérifie si la classe $controller existe
                if (class_exists($controller)) {

                    //Instanciation de la classe controller
                    $controllerInstance = new $controller();

                    if (method_exists($controllerInstance, $method)) {
                        $controllerInstance->$method();
                        return;
                    }
                }
            }
        }

        // On affiche une erreur 404 si besoin
        require_once '../src/Controller/ErrorController.php';

        // Force le code de retour à 404
        http_response_code(404);

        $errorInstance = new ErrorController();
        $errorInstance->error404();
    }

    /**
     * Permet d'ajouter une route personnalisée
     */
    public function add(string $route, string $controller, string $method): void {
        $this->routes[$route] = [$controller, $method];
    }
 }
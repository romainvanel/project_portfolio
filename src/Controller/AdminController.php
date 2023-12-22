<?php

namespace App\Controller;

class AdminController extends AbstractController {

    // Si l'utilisateur n'est pas connecté, on le redirige vers le formulaire de connexion
    public function __construct() {
        if (!$this->isUserLoggedIn()) {
            header('Location : /localhost/login');
            exit;
        }
    }

    // Accueil de l'administration
    public function index(): void {
        $this->view('admin/index.php');
    }

}
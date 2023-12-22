<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Controller\AdminController;

class Authcontroller extends AbstractController {

    // Déconnexion de l'utilisateur
    public function logout(): void {
        // Destruction de la session USER
        unset($_SESSION['user']);
        // Redirection vers le formulaire de connexion
        header('Location: /portfolio/login');
    }

    public function login(){

        $error = null; 
        
        // On vérifie si le formulaire est envoyé
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Nettoyage des données
            $username = htmlspecialchars(strip_tags($_POST['username']));
            $password = htmlspecialchars(strip_tags($_POST['password']));

            // Retirer les espaces en début et fin de chaine
            $username = trim($username);
            $password = trim($password);

            if (!empty($username) && !empty($password)) {

                // Sélectionne l'utisateur
                $userRepository = new UserRepository;
                $user = $userRepository->selectUser($_POST['username']);

                //  Vérification de l'utilisateur et du mot de passe
                if ($user && password_verify($password, $user->getPassword())) {

                    // Création de la session de connexion
                    $_SESSION['user'] = $user;

                    // Redirection vers l'administration
                    header('Location: /portfolio/admin');

                } else {
                    $error = 'Utilisateur ou mot de passe non valide';
                }

            } else {
                $error = 'tous les champs sont obligatoires';
            }   
        } 

        $this->view('auth/login.php', [
            'error' => $error
        ]);
    }
}
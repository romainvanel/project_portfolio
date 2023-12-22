<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use App\Entity\Projet;
use App\Services\UploadService;

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

        $projetRepository = new ProjetRepository;
        $projects = $projetRepository->selectAll();
    
        $this->view('admin/index.php', [
            'projects' => $projects
        ]);
    }

    // Ajout de nouveau projet
    public function addProjet(): void {

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Nettoyage des données
            $title = htmlspecialchars(strip_tags($_POST['title']));
            $description = htmlspecialchars(strip_tags($_POST['description']));

            // Retirer les espaces en début et fin de chaine
            $title = trim($title);
            $description = trim($title);

            // Vérifier si le formulaire est complet
            if (!empty($title) && !empty($description) && (isset($_FILES['preview'])) && $_FILES['preview']['error'] === UPLOAD_ERR_OK) {

                // Upload de l'image
                $uploadService = new UploadService();
                $preview = $uploadService->upload($_FILES['preview']);

                if ($preview) {

                        // Création d'un nouveau projet
                        $projetRepository = new ProjetRepository();

                        // Date du jour 
                        $date = new \DateTime();

                        // On crée un objet avec l'entité "Projet"
                        $projet = new Projet();
                        $projet->setTitle($title);
                        $projet->setDescription($description);
                        $projet->setPreview($preview);
                        $projet->setCreatedAt($date->format('Y-m-d H:i:s'));
                        $projet->setUpdatedAt($date->format('Y-m-d H:i:s'));
                
                        // Insérer en base de données
                        $projetRepository->add($projet);

                        $success = 'Votre nouveau projet est enregistré';

                }

            } else {
                $error = 'Tous les champs sont obligatoires';
            }
        }

        $this->view('admin/addProjet.php', [
            'error' => $error,
            'success' => $success
        ]);

        }
    }


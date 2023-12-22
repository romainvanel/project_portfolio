<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use App\Entity\Projet;

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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Nettoyage des données
            $title = htmlspecialchars(strip_tags($_POST['title']));
            $description = htmlspecialchars(strip_tags($_POST['description']));
            $preview = $_FILES['preview'];

            // Retirer les espaces en début et fin de chaine
            $title = trim($title);
            $description = trim($title);

            // Vérifier si le formulaire est complet
            if (!empty($title) && !empty($description) && (isset($preview)) && $preview['error'] === UPLOAD_ERR_OK) {

                // Définir le poids max de l'image
                $maxSize = 1 * 1024 * 1024;

                // Tableau contenant les extensions et les types MIME autorisés
                $typeImage = [
                    'png' => 'image/png',
                    'jpg' => 'image/jpeg',
                    'jpeg' => 'image/jpeg',
                    'webp' => 'image/webp'
                ];

                // Extraction de l'extension de l'image
                $extension = strtolower(pathinfo($preview['name'], PATHINFO_EXTENSION));

                // Vérifier si le fichier est une image autorisée
                if (array_key_exists($extension, $typeImage) && in_array($preview['type'], $typeImage)) {

                    // Vérifier le poids de l'image
                    if ($_FILES['preview']['size']) {

                        // Création d'un nouveau projet
                        $projetRepository = new ProjetRepository();

                        // On crée un objet avec l'entité "Projet"
                        $projet = new Projet();
                        $projet->setTitle($title);
                        $projet->setDescription($_POST['description']);
                        $projet->setPreview($preview['name']);
                        $projet->setCreatedAt((new \DateTime('now'))->format('Y-m-d H:i:s'));
                        $projet->setUpdatedAt((new \DateTime('now'))->format('Y-m-d H:i:s'));
                
                        // Insérer en base de données
                        $projetRepository->add($projet);

                        header('Location: /portfolio/admin');
                        exit;

                    } else {
                        $error = "Le poids de l'image ne doit pas excéder 1Mo";
                    }

                } else {
                    $error = 'Votre fichier n\'est pas une image autorisée';
                }

            } else {
                $error = 'Tous les champs sont obligatoires';
            }
        }

        $this->view('admin/addProjet.php', [
            'error' => $error
        ]);

        }
    }


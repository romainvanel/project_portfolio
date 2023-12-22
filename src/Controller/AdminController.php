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
            $description = trim($description);

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

                } else {
                    $error = 'Le fichier est invalide';
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

    // Edition d'un article
    public function edit(): void {

        // Si l'ID n'exite pas ou est vide, redirection
        if (empty($_GET['id'])) {
            header('Location: /portfolio/admin');
            exit;
        }

        $projetRepository = new ProjetRepository();
        $projet = $projetRepository->select($_GET['id']);

        // Si aucun projet avec cet ID
        if (!$projet) {
            header('Location: /portfolio/admin');
            exit;
        }

        // Si le formulaire est soumis 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Nettoyage des données
            $title = htmlspecialchars(strip_tags($_POST['title']));
            $description = htmlspecialchars(strip_tags($_POST['description']));

            // Retirer les espaces en début et fin de chaine
            $title = trim($title);
            $description = trim($description);

            // Vérifier si le formulaire est complet
            if (!empty($title) && !empty($description)) {

                // Sauvegarde le nom actuel de l'image de preview
                $preview = $projet->getPreview();

                // Si une image est fourni on l'upload
                if ($_FILES['preview']['error'] === UPLOAD_ERR_OK) {
                    // Upload de l'image
                    $uploadService = new UploadService();
                    $preview = $uploadService->upload($_FILES['preview'], $preview);
                }
                
                if ($preview) {

                    // Création d'un nouveau projet
                    $projetRepository = new ProjetRepository();

                    // Date du jour 
                    $date = new \DateTime();

                    // Modofie l'entité projet
                    $projet->setTitle($title);
                    $projet->setDescription($description);
                    $projet->setPreview($preview);
                    $projet->setUpdatedAt($date->format('d.m.Y'));

                    // Insérer en base de données
                    $projetRepository->edit($projet);

                    $success = 'Votre nouveau projet est enregistré';

                } else {
                    $error = 'Fichier invalide';
                }
            } else {
                $error = 'Tous les champs sont obligatoires';
            }
        }
    
        $this->view('admin/edit.php', [
            'projet' => $projet,
            'error' => $error ?? null,
            'success' => $success ?? null // coalescence des nuls, si c'est null renvoie la valeur de droite
        ]);
    }

        // Suppression
        public function delete(): void {

            // Si l'ID n'exite pas ou est vide, redirection vers l'accueil de l'administration
            if (empty($_GET['id'])) {
                header('Location: /portfolio/admin');
                exit;
            }

            $projetRepository = new ProjetRepository();
            $projet = $projetRepository->select($_GET['id']);

            // Si aucun projet avec cet ID
            if (!$projet) {
                header('Location: /portfolio/admin');
                exit;
            }

            // Suppression en base de données
            $projetRepository = new ProjetRepository();
            $projetRepository->delete($projet);

            // Supprime l'image du projet
            unlink($projet->getFolderPreview());

            header('Location: /portfolio/admin?success=Votre projet a bien été supprimé');
        }
    }


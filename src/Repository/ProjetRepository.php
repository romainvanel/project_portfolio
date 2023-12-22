<?php

namespace App\Repository;

use App\Entity\Projet;
use Core\Database;

class ProjetRepository extends Database{
    private $instance;

    public function __construct() {
        $this->instance = self::getInstance();
    }

    /**
     * Insertion en base de données
     */
    public function add(Projet $projet): Projet {
        $query = $this->instance->prepare("INSERT INTO projets (title, description, preview, created_at, updated_at) VALUES (:title, :description, :preview, :created_at, :updated_at)");

        $query->bindValue(':title', $projet->getTitle());
        $query->bindValue(':description', $projet->getDescription());
        $query->bindValue(':preview', $projet->getPreview());
        $query->bindValue(':created_at', $projet->getCreatedAt()->format('Y-m-d H.i.s'));
        $query->bindValue(':updated_at', $projet->getUpdatedAt());
        $query->execute();

        // Récupère l'ID nouvellement crée
        $id = $this->instance->lastInsertId();

        // Ajoute l'ID à mon objet
        $projet->setId($id);

        // Retourne notre objet muni d'un ID
        return $projet;
    }

        // Sélectionne tous les projets
        public function selectAll(): array {
            $objectsProjects = [];
            $query = $this->instance->query("SELECT * FROM projets ORDER BY created_at DESC");
    
            $projets = $query->fetchAll();

            foreach ($projets as $projet) {
                $item = new Projet();
                $item->setId($projet->id);
                $item->setTitle($projet->title);
                $item->setDescription($projet->description);
                $item->setPreview($projet->preview);
                $item->setCreatedAt($projet->created_at);
                $item->setUpdatedAt($projet->updated_at);

                $objectsProjects[] = $item;
            }
            return $objectsProjects;
        }

        // Sélectionne une seul projet
        public function select(int $id): Projet|bool {

            $objectProject = false;

            $query = $this->instance->prepare("SELECT * FROM projets WHERE id = :id");
            $query->bindValue(':id', $id);
            $query->execute();

            $projet = $query->fetch();

            if ($projet) {
                $objectProject = new Projet();
                $objectProject->setId($projet->id);
                $objectProject->setTitle($projet->title);
                $objectProject->setDescription($projet->description);
                $objectProject->setPreview($projet->preview);
                $objectProject->setCreatedAt($projet->created_at);
                $objectProject->setUpdatedAt($projet->updated_at);
            }

            return $objectProject;
        }

}
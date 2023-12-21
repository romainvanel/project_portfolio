<?php

namespace App\Repository;

use App\Entity\User;
use Core\Database;

class UserRepository extends Database {
    private \PDO $instance;

    public function __construct() {
        $this->instance = self::getInstance();
    }

    /**
     * Insertion en base de données
     */
    public function add(User $user): User {
        $query = $this->instance->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $query->bindValue(':username', $user->getUsername());
        $query->bindValue(':password', $user->getPassword());
        $query->execute();

        // Récupère l'ID nouvellement crée
        $id = $this->instance->lastInsertId();

        // Ajoute l'ID à mon objet
        $user->setId($id);

        // Retourne notre objet muni d'un ID
        return $user;
    }

}
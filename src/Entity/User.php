<?php

namespace App\Entity;

class User {
    private int $id;
    private string $username;
    private string $password;

    public function getId(): int {
        return $this->id;
    }

    public function setId($id) {
        $this->id =$id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username) {
        $this->username = $username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }
}
<?php

class HomeController {

    public function index(): void {
        require_once '../templates/home/index.php';
    }

    public function test(): void {
        require_once '../templates/home/test.php';
    }
}
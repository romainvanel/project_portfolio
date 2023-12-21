<?php

namespace App\Controller;

class ErrorController extends AbstractController{

    public function error404(): void {
        http_response_code(404);
        $this->view('errors/404.php');
    }
}
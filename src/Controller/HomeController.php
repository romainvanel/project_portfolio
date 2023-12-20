<?php

namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;

class HomeController {

    public function index(): void {
        require_once '../templates/home/index.php';
    }

    public function test(): void {

        // Si le formulaire est envoyé...
        if (!empty($_POST)) {

            // Vérifie si les champs ne sont pas vides
            if (!empty($_POST['name'] && !empty($_POST ['avis']))) {

            } else {
                // Pas besoin de faire une $_SESSION car on ne traite pas les infos sur une autre page - Tous ce fait sur la même page
                $error = 'Tous les champs sont obligatoires';
            }
        }

        // L'appel du template se situe toujours en dernière ligne de la méthode
        require_once '../templates/home/test.php';
    }

    public function contact() {

        // On vérifie si le formulaire est envoyé
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Nettoyage des données
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $email = htmlspecialchars(strip_tags($_POST['email']));
                $content = htmlspecialchars(strip_tags($_POST['content']));

                // Retirer les espaces en début et fin de chaine
                $name = trim($name);
                $content = trim($content);

            // On vérifie si les champs ne sont pas vides
            if(!empty($name) && !empty($email) && !empty($content)) {

                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

                    // Envoie de l'email avec PHPMailer
                    $phpmailer = new PHPMailer();
                    $phpmailer->isSMTP();
                    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->Port = 2525;
                    $phpmailer->Username = 'ae60964d97a39e';
                    $phpmailer->Password = 'f7e1799fc534ed';

                    // envoie du mail
                    $phpmailer->setFrom($email, $name);
                    $phpmailer->addAddress('romain@test.com', 'Romain');
                    $phpmailer->Subject = 'Message du formulaire de contact';
                    $phpmailer->Body = $content;

                    // Envoie du mail
                    if ($phpmailer->send()) {
                        $success = 'Votre message a bien été envoyé';   
                    } else {
                        // $error = "Votre message n'a pu être envoyé. Veuilez ré-essayer !";
                        $error = $phpmailer->ErrorInfo;
                    }

                } else {
                    $error = 'Veuillez rentrer une adresse email valide';
                }
                
            } else {
                $error = 'Tous les champs sont obligatoires';
            }

        }
        require_once '../templates/home/contact.php';
    }
}
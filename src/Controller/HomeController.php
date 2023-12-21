<?php

namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;

class HomeController extends AbstractController {

    public function index(): void {
        $this->view('home/index.php');
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

        $error = null;
        $success = null;

        // On vérifie si le formulaire est envoyé
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Nettoyage des données
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $email = htmlspecialchars(strip_tags($_POST['email']));
                $content = htmlspecialchars(strip_tags($_POST['content']));

                // Retirer les espaces en début et fin de chaine
                $name = trim($name);
                $email = trim($email);
                $content = trim($content);

            // On vérifie si les champs ne sont pas vides
            if(!empty($name) && !empty($email) && !empty($content)) {

                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

                    // Envoie de l'email avec PHPMailer
                    $phpmailer = new PHPMailer();
                    $phpmailer->isSMTP();
                    $phpmailer->Host = $_ENV['MAIL_SMTP'];
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->Port = $_ENV['MAIL_PORT'];
                    $phpmailer->Username = $_ENV['MAIL_USER'];
                    $phpmailer->Password = $_ENV['MAIL_PASS'];

                    // envoie du mail
                    $phpmailer->setFrom($email, $name);
                    $phpmailer->addAddress($_ENV['USER_NAME'], $_ENV['USER_EMAIL']);
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
        $this->view('home/contact.php', [
            'error' => $error,
            'success' => $success
        ]);
    }
}
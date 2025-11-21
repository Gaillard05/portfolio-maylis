<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer();

        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['HOST'] ?? null;;
        $this->mailer->SMTPAuth = $_ENV['SMTPAUTH'] ?? null;
        $this->mailer->Username = $_ENV['USERNAME'] ?? null;
        $this->mailer->Password = $_ENV['PASSWORD'] ?? null;
        $this->mailer->Port = $_ENV['PORT'] ?? null;
    }

    public function sendContactEmail($nom, $mail, $message, $object) {
        try {
            
            $this->mailer->isHTML(true);
            $this->mailer->setFrom('maylisgaillard@hotmail.fr', 'maylis gaillard');
            $this->mailer->addAddress($mail);
            $this->mailer->Subject = $object;
            $this->mailer->Body =
                "$message";

            return $this->mailer->send();

        } catch (Exception $e) {
            throw new \Exception("Erreur mail : " . $this->mailer->ErrorInfo);
        }
    }
}
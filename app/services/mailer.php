<?php
// Mailer.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);

        // --- Configuration SMTP MailTrap ---
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['HOST'] ?? '';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['USERNAME'] ?? ''; 
        $this->mailer->Password = $_ENV['PASSWORD'] ?? '';  
        $this->mailer->SMTPSecure = $_ENV['SMTPSECURE'] ?? '';     
        $this->mailer->Port = $_ENV['PORT'] ?? null;
        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->Encoding = 'base64';

    }

    /**
     * Envoie un email depuis le formulaire de contact
     * @param string $nom - nom du visiteur
     * @param string $emailVisiteur - email du visiteur
     * @param string $message - message du visiteur
     * @param string $objet - objet du mail
     * @return bool
     */
    public function sendContactEmail($nom, $mail, $message, $objet) {
        try {
            
            $this->mailer->isHTML(true);

            // --- Expéditeur obligatoire : ton domaine validé ---
            $this->mailer->setFrom('contact@maylis-gaillard.fr', 'maylis-gaillard');

            // --- Reply-To : permet de répondre directement au visiteur ---
            $this->mailer->addReplyTo($mail, $nom);

            // --- Destinataire réel  ---
            $this->mailer->addAddress('mg.contact.digital@gmail.com');

            $this->mailer->Subject = $objet;
            $this->mailer->Body = "$message";

            return $this->mailer->send();

        } catch (Exception $e) {
            throw new \Exception("Erreur mail : " . $this->mailer->ErrorInfo);
        }
    }
}
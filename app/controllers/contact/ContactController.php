<?php

class ContactController {
    
    public function send() {

        $nom = $_POST['nom'] ?? '';
        $mail = $_POST['mail'] ?? '';
        $object = $_POST['object'] ?? '';
        $message = $_POST['message'] ?? '';

        if(empty($nom) || empty($mail) || empty($object) || empty($message)) {
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
            header('location: /#contact');
            exit;
        }
        
        try {
           $mailer = new Mailer();
           $mailer->sendContactEmail($nom, $mail, $message, $object);
           
           $_SESSION['sucess'] = "Message envoyé avec succès ! <br/> Je vous répondrai dans les meilleurs délais.";
           header('location: /#contact');
           exit; 
        } catch(\Exception $e) {
           $_SESSION['error'] = $e->getMessage();
        }

        header('location: /#contact');
        exit; 
        
    }
}
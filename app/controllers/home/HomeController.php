<?php

require "../app/models/ProjetModel.php";

class HomeController {
    public function index() {

        #section projet de la page d'accueil

        $projetModel = new ProjetModel();
        $projets = $projetModel->getProjets();

        require '../app/views/home/home.phtml';
    }

    public function handleAboutMe() {
        header('location: /#a-propos');
        exit;
    }

    public function handleProjets() {
        header('location: /#projets');
        exit;
    }

    public function handleContact() {
        header('location: /#contact');
        exit;
    }
}

?>
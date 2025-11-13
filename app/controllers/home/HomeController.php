<?php

require "../app/models/ProjetModel.php";

class HomeController {
    public function index(string $section='home'): void {

        #section projet de la page d'accueil

        $projetModel = new ProjetModel();
        $projets = $projetModel->getProjets();

        require '../app/views/home/home.phtml';
    }

    public function handleAboutMe(): void {
        header('location: /#a-propos');
        exit;
    }

    public function handleProjets(): void {
        header('location: /#projets');
        exit;
    }

    public function handleContact(): void {
        header('location: /#contact');
        exit;
    }
}

?>
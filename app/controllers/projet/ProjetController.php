<?php

class ProjetController {
    public function show($slug) {

        $projetModel = new ProjetModel();
        $projet = $projetModel->getProjetBySlug($slug);

        if(!$projet) {
            die("Projet introuvable");
        }

        require '../app/views/projet/projet.phtml';
    }
}

?>
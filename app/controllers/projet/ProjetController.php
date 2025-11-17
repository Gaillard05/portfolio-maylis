<?php

class ProjetController {
    public function show($slug) {

        $projetModel = new ProjetModel();
        $projet = $projetModel->getProjetBySlug($slug);
        $technologies = $projetModel->getTechnologies($projet['id']);

        if(!$projet) {
            die("Projet introuvable");
        }

        require '../app/views/projet/projet.phtml';
    }
}

?>
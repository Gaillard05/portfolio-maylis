<?php

class ProjetController {
    public function show($slug) {
    
        if(!$slug) {
            http_response_code(404);
            require '../app/views/erreurs/404.phtml';
            return;
        }

        $projetModel = new ProjetModel();
        $projet = $projetModel->getProjetBySlug($slug);

        if(!$projet) {
            http_response_code(404);
            require '../app/views/erreurs/404.phtml';
            return;
        }

        $technologies = $projetModel->getTechnologies($projet['id']); 
        require '../app/views/projet/projet.phtml';
      
    }
}

?>
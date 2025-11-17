<?php

require_once "../app/config/database.php";

class ProjetModel {

    private PDO $db;

    public function __construct() 
    {
        $this->db = Database::getInstance()->getConnection();
        if($this->db === null) {
            die("Connexion PDO non initialisée !");
        }
    }

    public function getProjets(): array {
        $result = $this->db->query("SELECT id, image, titre, description_courte, slug FROM projets");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjetBySlug(string $slug): ?array {
        $result = $this->db->prepare("SELECT id, titre, image, description_longue, lien, slug FROM projets WHERE slug = :slug");
        $result->execute([':slug' => $slug]);
        $projet = $result->fetch(PDO::FETCH_ASSOC);
        return $projet ?: null;
    }

    public function getTechnologies($projetId) {
        $result = $this->db->prepare("SELECT * FROM technologies t JOIN projets_technologies pt ON t.id = pt.technologie_id WHERE pt.projet_id = :projet_id");
        $result->execute([':projet_id' => $projetId]);
        $technologies = $result->fetchAll(PDO::FETCH_ASSOC);
        return $technologies ?: null;
    }
}




?>
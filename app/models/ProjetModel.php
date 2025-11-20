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
        $result = $this->db->query("SELECT id, 
                                           image, 
                                           titre, 
                                           description_courte, 
                                           slug 
                                    FROM projets");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjetBySlug(string $slug): ?array {
        $result = $this->db->prepare("SELECT id, 
                                             titre, 
                                             image, 
                                             description_longue, 
                                             lien, 
                                             slug 
                                      FROM projets 
                                      WHERE slug = :slug");
        $result->execute([':slug' => $slug]);
        $projet = $result->fetch(PDO::FETCH_ASSOC);
        return $projet ?: null;
    }

    public function getTechnologies($projetId) {
        $result = $this->db->prepare("SELECT * FROM technologies t 
                                    LEFT JOIN projets_technologies pt 
                                    ON t.id = pt.technologie_id 
                                    WHERE pt.projet_id = :projet_id 
                                    ORDER BY t.titre_tech DESC");
        $result->execute([':projet_id' => $projetId]);
        $technologies = $result->fetchAll(PDO::FETCH_ASSOC);
        return $technologies ?: null;
    }

     public function getCatAndTechno(): array {
        $result = $this->db->query("SELECT c.id AS categorie_id, 
                                           c.titre_categorie,
                                           t.id as techno_id,
                                           t.titre_tech,
                                           t.image,
                                           t.icone
                                    FROM categories c
                                    LEFT JOIN technologies t
                                    ON t.id_categorie = c.id
                                    ORDER BY c.id ASC, t.id ASC;
        ");
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        $listCatTech = [];

        foreach($rows as $row) {
            $id = $row['categorie_id'];

            if(!isset($listCatTech[$id])) {
                $listCatTech[$id] = [
                    'id' => $row['categorie_id'],
                    'titre_cat' => $row['titre_categorie'],
                    'technos' => []
                ];
            }

            if($row['techno_id'] !== null) {
                $listCatTech[$id]['technos'][] = [
                    'id' => $row['techno_id'],
                    'titre_tech' => $row['titre_tech'],
                    'image' => $row['image'],
                    'icone' => $row['icone'],
                ];
            }

        }


        return $listCatTech ?: null;
    }
}

?>
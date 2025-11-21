<?php

require_once "../app/config/database.php";

class ContactModel {

    private PDO $db;

    public function __construct() 
    {
        $this->db = Database::getInstance()->getConnection();
        if($this->db === null) {
            die("Connexion PDO non initialisée !");
        }
    }
}

?>

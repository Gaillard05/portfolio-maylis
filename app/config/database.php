<?php

class Database 
{
   private static ?Database $instance = null;
   private ?PDO $connection = null;
  
   private function __construct() 
   {
        $host = $_ENV['DB_HOST'] ?? null;
        $dbname = $_ENV['DB_NAME'] ?? null;
        $user = $_ENV['DB_USER'] ?? null;
        $pass = $_ENV['DB_PASS'] ?? null;

        if(!$host || !$dbname || !$user) {
            die("Erreur : Variables d'environnement manquantes !");
        }

        try {
            $this->connection = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $user,
                $pass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die('Erreur de connexion PDO : '.$e->getMessage());
        }

   }

   public static function getInstance(): Database
   {
        if(self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
   }

   public function getConnection(): PDO
   {
    if($this->connection === null){
        die("Connexion PDO non initialisée !");
    }
    return $this->connection;
   }
}


?>
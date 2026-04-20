<?php
namespace AJE\Model;
/**
 * A class that can be instanciate to create a connexion on the database.
 * Once it is create, functions allows different types of behaviors.
 */
class DBConnexion
{
    private static ?DBConnexion $instance = null;
    private \PDO $connexion;

    private function __construct()
    {
        try {

            $this->connexion = new \PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("Identifiant ou mot de passe incorrect" . $e->getMessage());
        }
    }

    public static function getInstance(): DBConnexion
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function getConnexion() : \PDO
    {
        return $this->connexion;
    }


}

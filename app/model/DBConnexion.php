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

    /**
     * @return DBConnexion An instance of the connexion to the database
     */
    public static function getInstance(): DBConnexion
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \PDO An object that allows to interact with the database
     */
    public function getConnexion() : \PDO
    {
        return $this->connexion;
    }


}

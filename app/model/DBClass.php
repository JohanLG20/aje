<?php

namespace AJE\Model;

interface DBClass
{
    public static function getAllElements(): array;
    // throw new \Exception("Not implemented yet");
    /*
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM ");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    */

    public static function addNewElement(array $params): bool;
    // throw new \Exception("Not implemented yet");
    /*
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("INSERT INTO
            VALUES ()");
            
            return $query->execute([

            ]);

        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    */
    public static function modifyElementById(array $params): bool;
    // throw new \Exception("Not implemented yet");

    /*
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("UPDDATE
            SET
            WHERE");
            
            return $query->execute([

            ]);

        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    */


    public static function deleteElementById(int $id): bool;

    // throw new \Exception("Not implemented yet");
    /*
    
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("DELETE FROM
            WHERE");
            
            return $query->execute(
                [
                    ":id" = $id
            ]);

        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    */

    public static function getElementById(string $id): array|bool;
    // throw new \Exception("Not implemented yet");
    /*
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM WHERE id = :id");
            $query->execute(
                [
                    ":id" = $id
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    */
}

<?php

interface DBClass
{
    public static function getAllElements(): array;
    /*
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    */

    public static function addNewElement(array $params): bool;
    /*
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("INSERT INTO
            VALUES ()");
            
            return $query->execute([

            ]);

        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    */
    public static function modifyElementById(array $params): bool;

    /*
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("UPDDATE
            SET
            WHERE");
            
            return $query->execute([

            ]);

        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    */


    public static function deleteElementById(int $int): bool;

    /*
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("DELETE FROM
            WHERE");
            
            return $query->execute([

            ]);

        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    */
}

<?php

namespace AJE\Model;

class DBFilteredBy implements DBClass, AssociativeTable
{
    public static function getAllElements(): array
    {

        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM FILTERED_BY");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
    public static function addNewElement(array $params): bool
    {
        throw new \Exception("Not implemented yet");    /*
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
    }

    public static function modifyElementById(array $params): bool
    {
        throw new \Exception("Not implemented yet");    /*

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
    }




    public static function deleteElementById(int $int): bool
    {
        throw new \Exception("Not implemented yet");    /*
    /*
            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("DELETE FROM
            WHERE");
            
            return $query->execute([

            ]);

        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    */
    }

    public static function getElementById(string $id): array|bool
    {
        throw new \Exception("Not implemented yet");
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
    }

    public static function getElementsForId(string $id, string $elementToGet): array|bool
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();

            //Preparing the query in function of the element to get
            if ($elementToGet === "idCat") {
                $query = $db->prepare("SELECT * FROM FILTERED_BY WHERE id_cat = :id");
            } else if($elementToGet === "idFilterType") {
                $query = $db->prepare("SELECT * FROM FILTERED_BY WHERE id_filter_type = :id");
            }
            else{ //Prevent sending datas if the name of the elementToGet is not good
                return false;
            }

            $query->execute([':id' => $id]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
}

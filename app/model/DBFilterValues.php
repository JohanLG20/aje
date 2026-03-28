<?php

namespace AJE\Model;

class DBFilterValues implements DBClass, AssociativeTable
{
    public static function getAllElements(): array
    {

        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM FILTER_VALUES");
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
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM FILTER_VALUES WHERE id_filter_value = :idFilterValue");
            $query->execute(['idFilterValue' => $id]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public static function getElementsForId(string $id, string $elementToGet): array|bool
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();

            //Preparing the query in function of the element to get
            if ($elementToGet === "idFilterType") {
                $query = $db->prepare("SELECT filter_value FROM FILTER_VALUES WHERE id_filter_type = :id");
            } else { //Prevent sending datas if the name of the elementToGet is not good
                return false;
            }

            $query->execute([':id' => $id]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
}

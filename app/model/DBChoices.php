<?php

namespace AJE\Model;

class DBChoices implements DBClass, AssociativeTable
{
    public static function getAllElements(): array
    {

        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM CHOICES");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public static function addNewElement(array $params): bool
    {


        throw new \Exception("Not implemented yet");
        /*
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("INSERT INTO CHOICES
            VALUES ()");

            return $query->execute([]);
        } catch (\PDOException $e) {
            throw new \PDOException($e);*/
    }

    public static function modifyElementById(array $params): bool
    {


        throw new \Exception("Not implemented yet");

        /* try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("UPDDATE CHOICES
            SET
            WHERE");

            return $query->execute([]);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }*/
    }



    public static function deleteElementById(int $id): bool
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("DELETE FROM CHOICES
            WHERE id_choix = :id ");

            return $query->execute(
                [
                    ":id" => $id
                ]
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public static function getElementById(string $id): array|bool
    {

        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM CHOICES WHERE id_choix = :id");
            $query->execute(
                [
                    ":id" => $id
                ]
            );
            return $query->fetchAll(\PDO::FETCH_ASSOC);
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
                $query = $db->prepare("SELECT * FROM FILTER_TYPES_ASSOCIATIONS WHERE id_filter_type = :id");
            }
            else{ //Prevent sending datas if the name of the elementToGet is not good
                throw new \PDOException("Element introuvable");
            }

            $query->execute([':id' => $id]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    
    }
}
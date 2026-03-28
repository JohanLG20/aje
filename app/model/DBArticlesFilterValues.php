<?php

namespace AJE\Model;

class DBArticlesFilterValues implements DBClass, AssociativeTable
{
    public static function getAllElements(): array
    {

        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM ARTICLES_FILTER_VALUES");
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
            $query = $db->prepare("SELECT * FROM ARTICLES_FILTER_VALUES WHERE id_article = :idArticle AND id_filter_values = :idFilterValues");
            $query->execute(['idArticle' => $id, 'idFilterValues' => ":idFilterValues"]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public static function getElementsForId(string $id, string $elementToGet): array|bool
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM ARTICLES_FILTER_VALUES WHERE :elementToGet = :id");
            $query->execute([':id' => $id, ':elementToGet' => $elementToGet]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
}

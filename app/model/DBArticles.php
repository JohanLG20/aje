<?php

namespace AJE\Model;

class DBArticles implements DBClass
{
    public static function getAllElements(): array
    {

        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM ARTICLES");
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


    public static function getElementById(string $id): array
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM ARTICLES WHERE id_article = :idArticle");
            $query->execute(['idArticle' => $id]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
}

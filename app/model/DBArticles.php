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

            try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("INSERT INTO `ARTICLES`(`article_name`, `description`, `brand`, `id_cat`, `id_specificites`, `link_to_product_page`)
            VALUES (:articleName, :description, :brand, :idCat, '1', 'coucou')");
            
            return $query->execute([
                "articleName" => $params['articleName'],
                "description" => $params['description'],
                "brand" => $params['brand'],
                "idCat" => $params['idCat']
            ]);

        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }

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
            $query = $db->prepare("SELECT * FROM ARTICLES WHERE id_article = :idArticle");
            $query->execute(['idArticle' => $id]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
}

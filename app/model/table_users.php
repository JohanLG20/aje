<?php

abstract class DBUser implements DBClass
{

    public static function getAllElements() : array
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM USERS");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
    public static function addNewElement(array $params) : bool
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $addProdQuery = $db->prepare("INSERT INTO USERS
            VALUES ()");
            
            return $addProdQuery->execute([

            ]);

        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
    public static function modifyElementById(array $params) : bool
    {
        throw new Exception("Not implemented yet");
    }
    public static function deleteElementById(int $id) : bool
    {
        throw new Exception("Not implemented yet");
    }
}

<?php

namespace AJE\Model;

class DBChoiceNumber implements DBClass
{
    public static function getAllElements(): array
    {

        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM CHOICE_NUMBER");
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
            $query = $db->prepare("INSERT INTO CHOICE_NUMBER
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
            $query = $db->prepare("UPDDATE CHOICE_NUMBER
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
            $query = $db->prepare("DELETE FROM CHOICE_NUMBER
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
            $query = $db->prepare("SELECT * FROM CHOICE_NUMBER WHERE id_choix = :id");
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
}
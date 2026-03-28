<?php

namespace AJE\Model;

use AJE\Model\DBClass;

abstract class DBUsers implements DBClass
{

    public static function getAllElements(): array
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM USERS");
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
            $addProdQuery = $db->prepare("INSERT INTO `USERS`(`mail`, `city`, `first_name`, `address`, `phone_number`, `postal_code`, `last_name`, `passwd`, `id_user_level`) 
            VALUES (:email, :city, :firstname, :address, :phoneNumber, :postCode, :lastname, :passwd, 1)");

            return $addProdQuery->execute([
                ':email' => $params['email'],
                ':city' => $params['city'],
                ':firstname' => $params['firstname'],
                ':address' => $params['address'],
                ':phoneNumber' => $params['phoneNumber'] ?? '',
                ':postCode' => $params['postCode'],
                ':lastname' => $params['lastname'],
                ':passwd' => $params['passwd'],

            ]);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
    public static function modifyElementById(array $params): bool
    {
        throw new \Exception("Not implemented yet");
    }
    public static function deleteElementById(int $id): bool
    {
        throw new \Exception("Not implemented yet");
    }

    public static function getElementById(string $id): array|bool
    {

    try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM USERS WHERE mail=:mail");
            $query->execute([
                ':mail' => $id
            ]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
}

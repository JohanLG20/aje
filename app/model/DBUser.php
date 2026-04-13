<?php

namespace AJE\Model;

use PDOException;

class DBUser extends CoreModel
{

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "USER_";
        $this->idName = strtolower($this->tableName);
    }

    protected function prepareModifyQuery(array $params): \PDOStatement|false
    {
        throw new \Exception("Not implemented yet");
    }

    //The function is rewrited to handdle the fact that the phone number isn't requiered
    public function prepareAddQuery(array $params): \PDOStatement|false
    {
        $addProdQuery = $this->db->prepare("INSERT INTO `{$this->tableName}`(`mail`, `city`, `first_name`, `address`, `phone_number`, `postal_code`, `last_name`, `passwd`, `id_user_level`) 
            VALUES (:email, :city, :firstname, :address, :phoneNumber, :postCode, :lastname, :passwd, 1)");

        $phoneNumber = $params['phoneNumber'] ?? NULL; //We have to test if the phone number is entered before sending it to bindParams

        $addProdQuery->bindParam(":email", $params['email']);
        $addProdQuery->bindParam(":city", $params['city']);
        $addProdQuery->bindParam(":firstname", $params['firstname']);
        $addProdQuery->bindParam(":address", $params['address']);
        $addProdQuery->bindParam(":phoneNumber", $phoneNumber);
        $addProdQuery->bindParam(":postCode", $params['postCode']);
        $addProdQuery->bindParam(":lastname", $params['lastname']);
        $addProdQuery->bindParam(":passwd", $params['passwd']);


        return $addProdQuery;
    }

    public function getUserByMail(string $mail) : array|bool{
        try{
            $query = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE mail = :mail");
            $query->bindParam(":mail", $mail);
            $query->execute();

            return $query->fetch(\PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            throw $e;
        }

    }

    /**
     * Return the full name of the user in the form "UserFirstName UserLastName". The array form is [] => ['fullname'] => The full name of the user
     * 
     * @param string $id The id of the user
     * 
     * @return array|bool An associative array if the user is found, false if not
     */
    public function getUserFullName(string $id) : array|bool{
        try{
            $query = $this->db->prepare("SELECT CONCAT(first_name, ' ', last_name) as 'fullname' FROM
                                        {$this->tableName} WHERE {$this->idName} = :idUser");
            $query->bindValue(":idUser", $id);
            $query->execute();

            return $query->fetch(\PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e){
            throw $e;
        }
    }
}

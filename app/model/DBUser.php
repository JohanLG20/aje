<?php

namespace AJE\Model;


class DBUser extends CoreModel
{

    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
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

}

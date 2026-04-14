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
            $query = $this->db->prepare("SELECT CONCAT(first_name, ' ', last_name) as fullname FROM
                                        {$this->tableName} WHERE {$this->idName} = :idUser");
            $query->bindValue(":idUser", $id);
            $query->execute();

            return $query->fetch(\PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e){
            throw $e;
        }
    }

    /**
     * @param string $idUser The id of the user we want to check
     * @param string $idArticle The id of the article we want to check
     * 
     * @return array Returns an associative array that contains the comment of the user on the article at ['comment'] => theComment or an empty array if not comments is found. Can also return false if the query failed.
     */
    public function getUserCommentForArticle(string $idUser, string $idArticle) : array|bool {
        try{
            $query = $this->db->prepare("SELECT comment_label FROM {$this->tableName}
            INNER JOIN COMMENT ON COMMENT.id_user_ = {$this->tableName}.id_{$this->idName}
             WHERE id_article = :idArticle AND {$this->tableName}.id_{$this->idName} = :idUser");

             $query->bindValue(":idArticle", $idArticle);
             $query->bindValue(":idUser", $idUser);
             $query->execute();

             return $query->fetch(\PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e){
            throw $e;
        }
        
    }

    /**
     * Return the list of the user purchases. It can also be filtered with a list of articles. If no parameters are given, return the whole list of articles purchased by the given user.
     * @param string $idUser The id of the user we want the purchases
     * 
     * @return array An array that contains the list of the articles id that the user purchased
     */
    public function getUserPurchases(string $idUser) : array{
        try{
            $query = $this->db->prepare("SELECT ARTICLE.id_article FROM {$this->tableName}
            INNER JOIN ORDER_ ON ORDER_.{$this->idName} = {$this->tableName}.{$this->idName}
            INNER JOIN ARTICLE_ORDER ON ORDER_.id_order_ = ARTICLE_ORDER.id_order_
            WHERE {$this->idName} = :idUser");

            $query->bindValue(":idUser", $idUser);
            $query->execute();

            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e){
            throw $e;
        }
    }


}

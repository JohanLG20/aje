<?php

namespace AJE\Model;

use Exception;
use PDOStatement;

class DBArticle extends CoreModel
{

    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "ARTICLE";
        $this->idName = strtolower($this->tableName);
        $this->formNameToDbName = [
            'articleName' => 'article_name',
            'description' => 'description',
            'idBrand' => 'id_brand',
            'idCat' => 'id_category'
            

        ];
    }
/*
    protected function prepareAddQuery(array $params): PDOStatement|false
    {
        $query = $this->db->prepare("INSERT INTO ARTICLE(article_name,description,id_category,id_brand) VALUES (:articleName,:description,:idCat,:idBrand)");
        $query->bindParam(":articleName", $params['articleName']);
        $query->bindParam(":description", $params['description']);
        $query->bindParam(":idCat", $params['idCat']);
        $query->bindParam(":idBrand", $params['idBrand']);

        return $query;
    }*/

}

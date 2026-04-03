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

}

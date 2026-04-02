<?php

namespace AJE\Model;

use Exception;

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
            'idCat' => 'id_category',
            'idBrand' => 'id_brand'

        ];
    }

}

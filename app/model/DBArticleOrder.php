<?php

namespace AJE\Model;

class DBArticleOrder extends CoreModel
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "ARTICLE_ORDER";
    }


}

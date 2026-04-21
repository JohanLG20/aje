<?php

namespace AJE\Model;

class DBArticleOrder extends CoreAssociativeTable
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "ARTICLE_ORDER";
    }
}

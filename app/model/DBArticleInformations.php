<?php

namespace AJE\Model;

class DBArticleInformations extends CoreModel{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "ARTICLE_INFORMATIONS";
        $this->idName = strtolower($this->tableName);
    }
}
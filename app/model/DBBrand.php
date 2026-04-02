<?php

namespace AJE\Model;

class DBBrand extends CoreModel
{
       public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "BRAND";
        $this->idName = strtolower($this->tableName);
    }
}

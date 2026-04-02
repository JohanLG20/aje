<?php

namespace AJE\Model;

class DBChoiceTxt extends CoreModel
{
       public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "CHOICE_TXT";
        $this->idName = "choice_";
    }

}
<?php

namespace AJE\Model;

class DBChoiceRange extends CoreModel
{
       public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "CHOICE_RANGE";
        $this->idName = "choice_";
    }

}
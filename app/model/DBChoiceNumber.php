<?php

namespace AJE\Model;

class DBChoiceNumber extends CoreModel
{
       public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "CHOICE_NUMBER";
        $this->idName = "choice_";
    }
}
<?php

namespace AJE\Model;

class DBChoiceColor extends CoreModel
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "CHOICE_COLOR";
        $this->idName = "choice_";
    }

}
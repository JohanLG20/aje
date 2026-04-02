<?php

namespace AJE\Model;

class DBChoice_ extends CoreModel
{
        public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "CHOICE_";
        $this->idName = "choice_";
    }


}
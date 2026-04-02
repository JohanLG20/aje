<?php

namespace AJE\Model;

class DBOrder_ extends CoreModel
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "ORDER_";
        $this->idName = strtolower($this->tableName);
    }

}

<?php

namespace AJE\Model;

class DBValues_ extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "VALUES_";
        $this->idName = strtolower($this->tableName);
    }

}

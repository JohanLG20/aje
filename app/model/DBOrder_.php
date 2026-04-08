<?php

namespace AJE\Model;

class DBOrder_ extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "ORDER_";
        $this->idName = strtolower($this->tableName);
    }
}

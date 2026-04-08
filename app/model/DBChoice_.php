<?php

namespace AJE\Model;

class DBChoice_ extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "CHOICE_";
        $this->idName = "choice_";
    }
}

<?php

namespace AJE\Model;

class DBFilterType extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "FILTER_TYPE";
        $this->idName = strtolower($this->tableName);
    }
}

<?php

namespace AJE\Model;

class DBBrand extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "BRAND";
        $this->idName = strtolower($this->tableName);
    }
}

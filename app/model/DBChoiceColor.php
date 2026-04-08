<?php

namespace AJE\Model;

class DBChoiceColor extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "CHOICE_COLOR";
        $this->idName = "choice_";
    }
}

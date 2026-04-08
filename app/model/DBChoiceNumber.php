<?php

namespace AJE\Model;

class DBChoiceNumber extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "CHOICE_NUMBER";
        $this->idName = "choice_";
    }
}

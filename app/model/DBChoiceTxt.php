<?php

namespace AJE\Model;

class DBChoiceTxt extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "CHOICE_TXT";
        $this->idName = "choice_";
    }
}

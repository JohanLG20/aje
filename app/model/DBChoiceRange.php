<?php

namespace AJE\Model;

class DBChoiceRange extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "CHOICE_RANGE";
        $this->idName = "choice_";
    }
}

<?php

namespace AJE\Model;

class DBChoiceRange extends CoreModel
{
       public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "CHOICE_RANGE";
        $this->idName = "choice_";
    }

    protected function prepareAddQuery(array $params): \PDOStatement|false{
        throw new \Exception("Not implemented");
    }
    protected function prepareModifyQuery(array $params): \PDOStatement|false{
        throw new \Exception("Not implemented yet");
    }
}
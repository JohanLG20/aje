<?php

namespace AJE\Model;

class DBUserLevel extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "USER_LEVEL";
        $this->idName = strtolower($this->tableName);
    }

    protected function prepareAddQuery(array $params): \PDOStatement|false
    {
        throw new \Exception("Not implemented");
    }

}

<?php

namespace AJE\Model;

class DBValues_ extends CoreModel
{
    public function __construct()
    {
        $this->tableName = "VALUES_";
        $this->tableNameLower = strtolower($this->tableName);
    }

    protected function prepareAddQuery(array $params): \PDOStatement|false
    {
        throw new \Exception("Not implemented");
    }
    protected function prepareModifyQuery(array $params): \PDOStatement|false
    {
        throw new \Exception("Not implemented yet");
    }
}

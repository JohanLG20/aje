<?php

namespace AJE\Model;

use Exception;

class DBArticle extends CoreModel
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "ARTICLE";
        $this->idName = strtolower($this->tableName);
    }

    protected function prepareAddQuery(array $params): \PDOStatement|false{
        throw new \Exception("Not implemented");
    }
    protected function prepareModifyQuery(array $params): \PDOStatement|false{
        throw new \Exception("Not implemented yet");
    }
}

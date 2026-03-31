<?php

namespace AJE\Model;

use PDOStatement;

abstract class CoreModel
{
    abstract protected function prepareAddQuery(array $params): PDOStatement|false;
    abstract protected function prepareModifyQuery(array $params): PDOStatement|false;


    protected string $tableName;
    protected string $tableNameLower;
    protected \PDO  $db;

    public function getAllElements(): array
    {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tableName}");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }



    public function addNewElement(array $params): bool
    {
        try {
            $query = $this->prepareAddQuery($params);
            return $query->execute();
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public function modifyElementById(array $params): bool
    {
        try {
            $query = $this->prepareModifyQuery($params);
            return $query->execute();
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public function deleteElementById(int $id): bool
    {
        try {
            $query = $this->db->prepare("DELETE FROM {$this->tableName}
            WHERE id_{$this->tableNameLower} = :id");

            return $query->execute(
                [
                    ":id" => $id
                ]
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public function getElementById(string $id): array|bool
    {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tableName}
            WHERE id_{$this->tableNameLower} = :id");
            $query->execute([
                ":id" => $id
            ]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }


}

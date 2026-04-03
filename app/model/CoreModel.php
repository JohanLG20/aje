<?php

namespace AJE\Model;

use Exception;

abstract class CoreModel
{


    protected string $tableName;
    protected string $idName;
    protected array $formNameToDbName;
    protected \PDO  $db;

    public function getAllElements(): array
    {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tableName}");
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }



    public function addNewElement(array $params): bool
    {
        try {
            $query = $this->prepareAddQuery($params);
            return $query->execute();
        } catch (\PDOException $e) {
            throw $e;
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
            WHERE id_{$this->idName} = :id");

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
            WHERE id_{$this->idName} = :id");
            $query->execute([
                ":id" => $id
            ]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public function getLastAddedElement(): array
    {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tableName}
            ORDER BY id_{$this->idName} DESC LIMIT 1");
            $query->execute();
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    protected function prepareAddQuery(array $params): \PDOStatement|false
    {
        if (empty(array_diff_key($this->formNameToDbName, $params))) {
            try {
                $sqlQuery = "INSERT INTO {$this->tableName}(";

                //adding each column name into the query
                foreach ($params as $key => $val) {
                    $sqlQuery .= $this->formNameToDbName[$key] . ",";
                }

                $sqlQuery = substr($sqlQuery, 0, -1); //Removing the last coma of the query
                $sqlQuery .= ") VALUES ("; //Preparing the second part of the query

                //Creating the ids 
                foreach ($params as $key => $val) {
                    $sqlQuery .= ":{$key},";
                }

                $sqlQuery = substr($sqlQuery, 0, -1); //Removing the last coma of the query
                $sqlQuery .= ")"; //Ending the query

                //sqlQuery now look like INSERT INTO tableName(col1,col2...) VALUES (:postName,:otherPostName...)
                $query = $this->db->prepare($sqlQuery);

                //We now bind the parameters
                foreach ($params as $key => $val) {
                    //Have to use bindValue because the variables used will not be referenced anymore by the time execute is called
                    $query->bindValue(":{$key}", $val); 
                }

                return $query;
            } catch (\PDOException $e) {
                throw $e;
            }
        } else {
            throw new Exception("Erreur de correspondance entre les paramètres fournis et les valeurs entrées pour la base de donnée");
        }
    }

    protected function prepareModifyQuery(array $params): \PDOStatement|false {}
}

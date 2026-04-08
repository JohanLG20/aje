<?php

namespace AJE\Model;

use Exception;
use PDOException;

abstract class CoreModel
{


    protected string $tableName;
    protected string $idName;
    protected array $formNameToDbName;
    protected \PDO  $db;

    public function getAllElements(array $attrsToGet = []): array
    {
        try {
            if (!empty($attrsToGet)) {
                $sqlQuery = "SELECT ";
                //adding each parameter to the query
                foreach ($attrsToGet as $attr) {
                    $sqlQuery .= "{$this->formNameToDbName[$attr]},";
                    $sqlQuery = substr($sqlQuery, 0, -1); //Removing the last coma of the query

                }
            } else {
                $sqlQuery = "SELECT *";
            }
            //Finalising the query
            $sqlQuery .= " FROM {$this->tableName}";
            $query = $this->db->prepare($sqlQuery);
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

    public function getElementById(string $id, array $attrsToGet = []): array|bool
    {
        try {
            if (!empty($attrsToGet)) {
                $sqlQuery = "SELECT ";
                //adding each parameter to the query
                foreach ($attrsToGet as $attr) {
                    $sqlQuery .= "{$this->formNameToDbName[$attr]},";
                    $sqlQuery = substr($sqlQuery, 0, -1); //Removing the last coma of the query

                }
            } else {
                $sqlQuery = "SELECT *";
            }
            //Finalising the query
            $sqlQuery .= " FROM {$this->tableName} WHERE id_{$this->idName} = :id";

            $query = $this->db->prepare($sqlQuery);
            $query->execute([
                ":id" => $id
            ]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    public function getAllElementsForValue(string $elementName, string $elementVal, array $attrsToGet = []): array
    {
        try {
            //Prepering the select section of the querry
            if (!empty($attrsToGet)) {
                $sqlQuery = "SELECT ";
                //adding each parameter to the query
                foreach ($attrsToGet as $attr) {
                    $sqlQuery .= "{$this->formNameToDbName[$attr]},";
                    $sqlQuery = substr($sqlQuery, 0, -1); //Removing the last coma of the query

                }
            } else {
                $sqlQuery = "SELECT *";
            }
            //Finalising the query
            $sqlQuery .= " FROM {$this->tableName} WHERE
                    {$this->formNameToDbName[$elementName]} = :elemToGet";

            $query = $this->db->prepare($sqlQuery);
            $query->bindParam(":elemToGet", $elementVal);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
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

    public function getAllElementsForValues(string $elementName, array $values, array $attrsToGet = [])
    {
        //Prepering the select section of the querry
        if (!empty($attrsToGet)) {
            $sqlQuery = "SELECT ";
            //adding each parameter to the query
            foreach ($attrsToGet as $attr) {
                $sqlQuery .= "{$this->formNameToDbName[$attr]},";
                $sqlQuery = substr($sqlQuery, 0, -1); //Removing the last coma of the query

            }
        } else {
            $sqlQuery = "SELECT *";
        }
        $sqlQuery .= " FROM {$this->tableName} WHERE
                    {$this->formNameToDbName[$elementName]} IN (";

        //Preparing the query with the keys of the array
        foreach ($values as $key => $val) {
            $sqlQuery .= ":{$key},";
        }
        $sqlQuery = substr($sqlQuery, 0, -1); //Removing the last coma of the query
        $sqlQuery .= ")"; //Finalising the query

        $query = $this->db->prepare($sqlQuery);

        foreach ($val as $key => $val) {
            //Have to use bindValue because the variables used will not be referenced anymore by the time execute is called
            $query->bindValue(":{$key}", $val);
        }

        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
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

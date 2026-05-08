<?php

namespace AJE\Model;

use PDOException;

abstract class CoreModel
{


    protected string $tableName;
    protected string $idName;
    protected \PDO  $db;

    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
    }

    /**
     * @param array $attrsToGet Optionnal : List of the attributes to get. If no values is provided, it select the whole row.
     * 
     * @return array An array that contains all the values of the asked table
     */
    public function getAllElements(array $attrsToGet = []): array
    {
        try {
            $sqlQuery = $this->prepareSelectQuery($attrsToGet);
            //Finalising the query
            $sqlQuery .= " FROM {$this->tableName}";
            $query = $this->db->prepare($sqlQuery);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }



    /**
     * @param array $params The values of the element to add. The keys of the array must be tied to the attributes name in the database
     * 
     * @return bool True if the request was successfull, false otherwise
     */
    public function addNewElement(array $params): bool
    {
        try {
            $query = $this->prepareAddQuery($params); // Preparing the query in function of the parameters given
            return $query->execute();
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * @param array $params The values of the element to modified. The keys of the array must be tied to the attributes name in the database
     * 
     * @return bool True if the request was successfull, false otherwise
     */
    public function modifyElementById(array $params): bool
    {
        try {
            $query = $this->prepareModifyQuery($params);
            return $query->execute();
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }

    /**
     * @param int $id The id of the element to delete
     * 
     * @return bool True if the operation was successfull, false otherwise
     */
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

    /**
     * @param string $id The id of the element to get
     * @param array $attrsToGet An array that contains the attributes to get. If no value is provided, returns all the attributes
     * 
     * @return array An array that contains the required attributes of the element.
     */
    public function getElementById(string $id, array $attrsToGet = []): array|bool
    {
        try {
            $sqlQuery = $this->prepareSelectQuery($attrsToGet);
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

    /**
     * @return array An array that contains the value of the last element added to the table
     */
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


    /**
     * @param array $params The parameters to add. The keys must match the attributes name in the database
     * 
     * @return \PDOStatement The query ready to be executed
     */
    protected function prepareAddQuery(array $params): \PDOStatement|false
    {
        try {
            $keys = array_keys($params);
            $keyString = implode(",", $keys);

            $sqlQuery = "INSERT INTO {$this->tableName}({$keyString})";
            $sqlQuery .= " VALUES ("; //Preparing the second part of the query

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
    }

    protected function prepareModifyQuery(array $params): \PDOStatement|false {}

    private function prepareSelectQuery(array $attrsToGet): string
    {
        //Prepering the select section of the querry
        if (!empty($attrsToGet)) {
            $selectQuery = "SELECT " . implode(', ', $attrsToGet); //adding each parameter to the query

        } else {
            $selectQuery = "SELECT *";
        }

        return $selectQuery;
    }
}

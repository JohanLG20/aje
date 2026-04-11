<?php

namespace AJE\Model;

use PDOException;
use PDOStatement;

abstract class CoreAssociativeTable
{

    protected string $tableName;
    protected \PDO  $db;
    protected array $associativeArray;

    /**
     * @param array $params An array that contains the values to add. Its keys must be the same as the attributes of the table
     * 
     * @return bool
     */
    public function addNewElement(array $params) : bool {
        try{
            $query = $this->prepareAddQuery($params);
            return $query->execute();
        }
        catch(PDOException $e){
            throw $e;
        }
    }

    public function getAssociatedElementsFromArray(string $elementToGet, array $ids): array|bool
    {
        try {
            $sqlQuery = "SELECT  {$elementToGet} FROM {$this->tableName} WHERE ";

            //Dynamicly adding the ids to get
            for ($i = 0; $i < count($ids); $i++) {
                $sqlQuery .= "{$this->associativeArray[$elementToGet]} = :id{$i} OR ";
            }

            $sqlQuery = substr($sqlQuery, 0, -3); // Removing the last "OR " at the end of the query
            $query = $this->db->prepare($sqlQuery);
            //Preparing the query with bindParam
            for ($i = 0; $i < count($ids); $i++) {
                $query->bindParam(":id{$i}", $ids[$i]);
            }

            $query->execute();

            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function getAssociatedElementsFromString(string $elementToGet, string $id): array|bool
    {
        try {
            $sqlQuery = "SELECT {$elementToGet} FROM {$this->tableName} 
                            WHERE {$this->associativeArray[$elementToGet]} = :id";
            $query = $this->db->prepare($sqlQuery);

            //Preparing the query with bindParam
            $query->bindParam(":id", $id);

            $query->execute();

            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * Prepare the query for adding an element to the table. It is dynamicaly created with the parameters keys, which need to be the same as the name of the attributes in the table.
     * @param array $params The values that we want to add. Each key of the array must be the same as the attributes of the table.
     * 
     * @return PDOStatement The query, ready to be executed
     */
    public function prepareAddQuery(array $params): PDOStatement{
        $keys = array_keys($params); // The string containing all keys
        $keysString = implode(", ", $keys);

        $valuesString = "";
        //Preparing the values string
        foreach($keys as $key){
            $valuesString .= ":{$key},";
        }
        $valuesString = substr($valuesString, 0, -1); //Removing the last comma

        $sqlQuery = "INSERT INTO {$this->tableName}({$keysString}) VALUES({$valuesString})";
        $query = $this->db->prepare($sqlQuery);

        foreach($keys as $key){
            $query->bindValue(":{$key}", $params[$key]); //Binding each key to its value
        }

        return $query;
        
    }
}

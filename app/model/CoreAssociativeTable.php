<?php

namespace AJE\Model;

abstract class CoreAssociativeTable
{

    protected string $tableName;
    protected \PDO  $db;
    protected array $associativeArray;

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
        throw new \Exception("Not implemented yet");
    }
}

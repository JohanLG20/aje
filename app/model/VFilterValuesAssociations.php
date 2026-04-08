<?php

namespace AJE\Model;

class VFilterValuesAssociations
{
    private \PDO $db;
    private string $tableName;

    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "FILTER_VALUES_ASSOCIATIONS";
    }

    public function getChoicesForFilterId(string $id): array|bool
    {
        try {
            $query = $this->db->prepare("SELECT * FROM FILTER_VALUES_ASSOCIATIONS WHERE id_filter_type = :id");
            $query->bindParam(":id", $id);

            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException("Une erreur est survenue lors de la connexion à la base de données" . $e->getMessage());
        }
    }

    public function getAllPossibleChoicesForIds(array $ids): array
    {
        try {
            $sqlQuery = "SELECT id_choice_ FROM {$this->tableName} WHERE ";

            //Dynamicly adding the ids to get
            for ($i = 0; $i < count($ids); $i++) {
                $sqlQuery .= "id_filter_type = :id{$i} OR ";
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
            throw new \PDOException("Une erreur est survenue lors de la connexion à la base de données" . $e->getMessage());
        }
    }

    public function getAllInfosForId(string $id, array $attrsToGet = []) : array
    {
        try {
            //Prepering the select section of the querry
            if (!empty($attrsToGet)) {
                $sqlQuery = "SELECT ";
                //adding each parameter to the query
                foreach ($attrsToGet as $attr) {
                    $sqlQuery .= "{$attr},";
                    $sqlQuery = substr($sqlQuery, 0, -1); //Removing the last coma of the query

                }
            } else {
                $sqlQuery = "SELECT *";
            }
            //Finalising the query
            $sqlQuery .= " FROM {$this->tableName} WHERE
                    id_choice_ = :id";

            $query = $this->db->prepare($sqlQuery);
            $query->bindParam(":id", $id);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}

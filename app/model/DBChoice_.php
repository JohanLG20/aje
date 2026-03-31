<?php

namespace AJE\Model;

class DBChoice_ extends CoreModel
{
        public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "CHOICE_";
        $this->tableNameLower = strtolower($this->tableName);
    }

    protected function prepareAddQuery(array $params): \PDOStatement|false{
        throw new \Exception("Not implemented");
    }
    protected function prepareModifyQuery(array $params): \PDOStatement|false{
        throw new \Exception("Not implemented yet");
    }

    public function getChoicesForFilterId(string $id) : array|bool {
        try{
            $query = $this->db->prepare("SELECT id_choice_, filter_value FROM FILTER_VALUES_ASSOCIATIONS WHERE id_filter_type = :id");
            $query->bindParam(":id", $id);

            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e){
            throw new \Exception("Une erreur est survenue lors de la connexion à la base de données".$e->getMessage());
        }
    }
}
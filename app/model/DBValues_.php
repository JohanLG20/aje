<?php

namespace AJE\Model;

class DBValues_ extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "VALUES_";
        $this->idName = strtolower($this->tableName);
        $this->formNameToDbName = [
            'idArticle' => 'id_article',
            'idFilterType' => 'id_filter_type',
            'idChoice' => 'id_choice_'
        ];
    }

    public function getAllChoicesForArticle(string $id): array
    {
        try {
            $query = $this->db->prepare("SELECT id_choice_ FROM {$this->tableName}
                                        WHERE id_article = :id");
            $query->bindParam(":id", $id);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}

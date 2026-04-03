<?php

namespace AJE\Model;

class DBValues_ extends CoreModel
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "VALUES_";
        $this->idName = strtolower($this->tableName);
        $this->formNameToDbName = [
            'idArticle' => 'id_article',
            'idFilterType' => 'id_filter_type',
            'idChoice' => 'id_choice_'
        ];
    }

}

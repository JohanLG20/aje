<?php

namespace AJE\Model;

class DBFilteredBy extends CoreAssociativeTable
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "FILTERED_BY";
        $this->associativeArray = [
            "id_filter_type" => "id_category",
            "id_category" => "id_filter_type"
        ];
        }
}

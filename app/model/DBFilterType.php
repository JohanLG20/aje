<?php

namespace AJE\Model;

class DBFilterType extends CoreModel
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "FILTER_TYPE";
        $this->idName = strtolower($this->tableName);
        $this->formNameToDbName = [
            'filterTypeLabel' => 'filter_type_label',
            'filterTypeUnit' => 'filter_type_unit'
        ];
    }
}

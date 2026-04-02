<?php

namespace AJE\Model;

class DBPriceHistory extends CoreModel
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "PRICE_HISTORY";
        $this->idName = strtolower($this->tableName);
    }

}

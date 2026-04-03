<?php

namespace AJE\Model;

use PDOStatement;

class DBPriceHistory extends CoreModel
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "PRICE_HISTORY";
        $this->idName = strtolower($this->tableName);
    }

    protected function prepareAddQuery(array $params): PDOStatement|false
    {
        //By default, if no values are specified for the startDate it take the day of the day
        if (isset($params['startDate'])) {
            $query = $this->db->prepare("INSERT INTO {$this->tableName}(id_article, price, start_date, end_date)
                            VALUES (:idArticle, :price, :startDate, :endDate)");
            $query->bindValue(":startDate", $params['startDate'] ?? NULL);
        } else {
            $query = $this->db->prepare("INSERT INTO {$this->tableName}(id_article, price, end_date)
                            VALUES (:idArticle, :price, :endDate)");
        }

        $query->bindValue(":idArticle", $params['idArticle']);
        $query->bindValue(":price", $params['price']);
        $query->bindValue(":endDate", $params['endDate'] ?? null);

        return $query;
    }
}

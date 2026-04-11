<?php

namespace AJE\Model;

class DBArticleOrder extends CoreAssociativeTable
{
    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "ARTICLE_ORDER";
    }

    public function getElementsForId(string $id, string $elementToGet): array|bool
    {
        try {
            $db = DBConnexion::getInstance()->getConnexion();
            $query = $db->prepare("SELECT * FROM ARTICLES_ORDER WHERE :elementToGet = :id");
            $query->execute([':id' => $id, ':elementToGet' => $elementToGet]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \PDOException($e);
        }
    }
}

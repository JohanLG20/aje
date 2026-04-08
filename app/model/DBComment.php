<?php

namespace AJE\Model;

use PDOException;

class DBComment extends CoreAssociativeTable
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "COMMENT";
        $this->associativeArray = [
            "id_user_" => "id_article",
            "id_article" => "id_user_"
        ];
    }

    public function getCommentsForArticle(string $articleId): array
    {
        try {
            $query = $this->db->prepare("SELECT id_user_,comment FROM {$this->tableName}
                                        WHERE id_article = :idArticle");
            $query->bindParam(':id', $articleId);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}

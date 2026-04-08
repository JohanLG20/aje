<?php

namespace AJE\Model;

class DBArticle extends CoreModel
{

    public function __construct()
    {
        $this->db = DBConnexion::getInstance()->getConnexion();
        $this->tableName = "ARTICLE";
        $this->idName = strtolower($this->tableName);
        $this->formNameToDbName = [
            'articleName' => 'article_name',
            'description' => 'description',
            'idBrand' => 'id_brand',
            'idCat' => 'id_category'
        ];
    }

    public function getCommentsForArticle(string $articleId): array
    {
        try {
            $query = $this->db->prepare("SELECT CONCAT(first_name, ' ', last_name) as fullname,comment_label as comment FROM {$this->tableName}
                INNER JOIN COMMENT ON {$this->tableName}.id_{$this->idName} = COMMENT.id_{$this->idName}
                INNER JOIN USER_ ON COMMENT.id_user_ = USER_.id_user_
                WHERE {$this->tableName}.id_{$this->idName} = :idArticle");
            $query->bindParam(':idArticle', $articleId);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}

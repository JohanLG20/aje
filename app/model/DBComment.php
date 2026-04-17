<?php

namespace AJE\Model;

use PDOException;

class DBComment extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "COMMENT";
        $this->idName = strtolower($this->tableName);
    }

    public function getCommentsAndUserInfosForArticle(string $idArticle): array
    {
        try {
            $query = $this->db->prepare("
            SELECT 
                id_{$this->idName}, 
                CONCAT(first_name, ' ', last_name) AS fullname, 
                comment_label AS comment, 
                USER_.id_user_ 
            FROM (
                SELECT * FROM {$this->tableName} 
                WHERE id_article_informations = (
                    SELECT id_article_informations 
                    FROM ARTICLE 
                    WHERE id_article = :idArticle
                )
            ) comments
            INNER JOIN USER_ ON comments.id_user_ = USER_.id_user_
        ");
            $query->bindParam(':idArticle', $idArticle);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

public function getCommentByIdByAuthorByArticle(string $idComment, string $idUser, string $idArticle)
{
    try {
        $query = $this->db->prepare("
            SELECT * FROM {$this->tableName} 
            WHERE id_user_ = :idUser 
            AND id_article_informations = (
                SELECT id_article_informations 
                FROM ARTICLE 
                WHERE id_article = :idArticle
            )
            AND id_{$this->idName} = :idComment
        ");
        $query->bindParam(":idUser", $idUser);
        $query->bindParam(":idArticle", $idArticle);
        $query->bindParam(":idComment", $idComment);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        throw $e;
    }
}
}

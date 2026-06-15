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

    /**
     * Returns an array that contains the user informations (name and id) and the comment for a given article
     * @param string $idArticle The id of the article
     * 
     * @return array An array of comments where each row contains the username (null if the user is deleted), the user id, the comment id and the comment
     */
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
            LEFT JOIN USER_ ON comments.id_user_ = USER_.id_user_
        ");
            $query->bindParam(':idArticle', $idArticle);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * Return the comment for a given user on a given article
     * @param string $idComment The id of the comment
     * @param string $idUser The id of the user
     * @param string $idArticle The id of the article
     * 
     * @return array The informations of the comment
     */
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


    /**
     * @param string $idUser The id of the user we want to check
     * @param string $idArticle The id of the article we want to check
     * 
     * @return array Returns an associative array that contains the comment of the user on the article at ['comment'] => theComment or an empty array if not comments is found. Can also return false if the query failed.
     */
    public function getUserCommentForArticle(string $idUser, string $idArticle): array|bool
    {
        try {
            $query = $this->db->prepare("SELECT comment_label FROM {$this->tableName}
             WHERE COMMENT.id_article_informations = (SELECT id_article_informations
                                                    FROM ARTICLE 
                                                    WHERE id_article = :idArticle)
              AND id_user_ = :idUser");

            $query->bindValue(":idArticle", $idArticle);
            $query->bindValue(":idUser", $idUser);
            $query->execute();

            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}

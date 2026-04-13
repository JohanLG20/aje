<?php

namespace AJE\Model;

class DBArticle extends CoreModel
{

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "ARTICLE";
        $this->idName = strtolower($this->tableName);
    }

    /**
     * Returns all the comments for the given article. The associative array of the return is like
     * [oneComment] => [
     *              ['comment'] => the comment left by the user,
     *              ['idUser'] => the id of the user that left the comment
     * ]
     * @param string $articleId The id of the comment to retrieve
     * 
     * @return array An associative array that contains the comment, the name of the user and it's id
     */
    public function getCommentsAndUserInfosForArticle(string $articleId): array
    {
        try {
            $query = $this->db->prepare("SELECT CONCAT(first_name, ' ', last_name) as fullname, comment_label as comment, USER_.id_user_ 
             FROM {$this->tableName}
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

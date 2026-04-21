<?php

namespace AJE\Model;

use PDOException;

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
                WHERE {$this->tableName}.id_{$this->idName} = :idArticle
                AND {$this->tableName}.deleted_at IS NULL");
            $query->bindParam(':idArticle', $articleId);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * Return all the id of choices available for the linked article
     * [0] =>[
     *         ['id_choice_] => The id of the choice
     *        ],
     * [1] => ...
     * @param string $id The id of the given article
     * 
     * @return array An array list that contains all the distinct values of other choices available for the article 
     */
    public function getAllChoicesForLinkedArticle(string $id): array
    {
        try {
            $query = $this->db->prepare("SELECT DISTINCT id_choice_ 
                    FROM (SELECT id_article 
                          FROM {$this->tableName} 
                          WHERE id_article_informations IN (SELECT id_article_informations 
                                                            FROM {$this->tableName} 
                                                            WHERE id_article = :id)
                           AND  deleted_at IS NULL) a
                          INNER JOIN VALUES_ ON VALUES_.id_article = a.id_article
                         ");

            $query->bindParam(":id", $id);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * Return all the id of choices available for this article only
     * [0] =>[
     *         ['id_choice_] => The id of the choice
     *        ],
     * [1] => ...
     * @param string $id The id of the given article
     * 
     * @return array An array list that contains all the distinct values of other choices available for the article 
     */
    public function getChoicesForArticle(string $id): array
    {
        try {
            $query = $this->db->prepare("SELECT DISTINCT id_choice_ 
                    FROM (SELECT id_article 
                          FROM ARTICLE 
                          WHERE id_article = :id AND deleted_at IS NULL) a
                    INNER JOIN VALUES_ ON VALUES_.id_article = a.id_article
                    WHERE a.deleted_at IS NULL");


            $query->bindParam(":id", $id);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * Returns an associative array that contains the price and the promotion price. If there are no promotions, the promotion price is null
     * @param string $id The id of the article
     * 
     * @return array an associative that looks like
     * [
     *      ['normal_price'] => price, 
     *      ['promo_price'] => promoPrice|null
     * ]
     */
    public function getArticlePrice(string $id): array
    {
        try {
            $query = $this->db->prepare("SELECT
    normal.price as normal_price,
    promo.price as promo_price
FROM (SELECT * FROM {$this->tableName} WHERE id_article = :id AND {$this->tableName}.deleted_at IS NULL) a

JOIN PRICE_HISTORY normal
    ON normal.id_article = a.id_article
    AND normal.end_date IS NULL

LEFT JOIN PRICE_HISTORY promo
    ON promo.id_article = a.id_article
    AND promo.end_date IS NOT NULL
    AND promo.end_date >= CURDATE()
    AND promo.start_date <= CURDATE();
    WHERE a.deleted_at IS NULL

    
    
    ");
            $query->bindValue(":id", $id);
            $query->execute();

            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function getArticleInformationsId(int $idArticle): ?int
    {
        $query = $this->db->prepare("
        SELECT id_article_informations 
        FROM {$this->tableName} 
        WHERE id_{$this->idName} = :id
        AND deleted_at IS NULL
    ");
        $query->execute([':id' => $idArticle]);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return $result ? (int) $result['id_article_informations'] : null;
    }

    public function searchForArticles(string $research): array
    {
        try {
            $sqlQuery = "
        WITH RECURSIVE category_tree AS (
            -- On part des catégories qui correspondent à la recherche
            SELECT id_category
            FROM CATEGORY
            WHERE cat_label LIKE :research_cat

            UNION ALL

            -- On récupère toutes les sous-catégories récursivement
            SELECT c.id_category
            FROM CATEGORY c
            JOIN category_tree ct
                ON c.id_category_parent_of = ct.id_category
        )
        SELECT DISTINCT
            a.id_article as id,
            a.id_article_informations,
            ai.article_name as article_name,
            ai.image_repertory as image_repertory,
            b.brand_label AS brand,
            normal.price AS normal_price,
            promo.price AS promo_price,
            c.cat_label AS category,
            v.id_filter_type,
            v.id_choice_,
            ft.filter_type_label,
            COALESCE(ct2.choice, CAST(cn.choice AS CHAR), cc.color_choice_label) AS choice_value,
            cc.color_choice_hexa
        FROM ARTICLE a
        JOIN ARTICLE_INFORMATIONS ai
            ON ai.id_article_informations = a.id_article_informations
        JOIN CATEGORY c
            ON c.id_category = ai.id_category
        JOIN BRAND b
            ON b.id_brand = ai.id_brand
        JOIN PRICE_HISTORY normal
            ON normal.id_article = a.id_article
            AND normal.end_date IS NULL
        LEFT JOIN PRICE_HISTORY promo
            ON promo.id_article = a.id_article
            AND promo.end_date IS NOT NULL
            AND promo.end_date >= CURDATE()
            AND promo.start_date <= CURDATE()
        LEFT JOIN VALUES_ v
            ON v.id_article = a.id_article
        LEFT JOIN CHOICE_TXT ct2
            ON ct2.id_choice_ = v.id_choice_
        LEFT JOIN CHOICE_COLOR cc
            ON cc.id_choice_ = v.id_choice_
        LEFT JOIN CHOICE_NUMBER cn
            ON cn.id_choice_ = v.id_choice_
        LEFT JOIN CHOICE_RANGE cr
            ON cr.id_choice_ = v.id_choice_
        LEFT JOIN FILTER_TYPE ft
            ON ft.id_filter_type = v.id_filter_type
        WHERE (
            ai.article_name LIKE :research
            OR ai.description LIKE :research
            OR b.brand_label LIKE :research
            OR ct2.choice LIKE :research
            OR cc.color_choice_label LIKE :research
            OR CAST(cn.choice AS CHAR) LIKE :research
            OR (
                :research REGEXP '^[0-9]+(\\.[0-9]+)?$'
                AND CAST(:research AS DECIMAL(8,3)) >= cr.min_
                AND CAST(:research AS DECIMAL(8,3)) <= cr.max_
            )
            -- On vérifie si la catégorie de l'article ou une de ses parentes correspond
            OR c.cat_label LIKE :research
            OR ai.id_category IN (SELECT id_category FROM category_tree)
        )
        AND a.deleted_at IS NULL
        GROUP BY a.id_article_informations";

            $query = $this->db->prepare($sqlQuery);
            $query->execute([
                ':research'     => '%' . $research . '%',
                ':research_cat' => '%' . $research . '%'
            ]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * @param string $limit The number of article we want, 10 is set by default
     * 
     * @return array
     */
    public function getArticlesInPromotions(string $limit = "10"): array
    {
        try {
            $query = $this->db->prepare("SELECT
    a.id_article as id,
    ai.article_name as article_name,
    ai.image_repertory,
    b.brand_label AS brand,
    normal.price AS normal_price,
    promo.price AS promo_price
FROM {$this->tableName} a
JOIN ARTICLE_INFORMATIONS ai
    ON ai.id_article_informations = a.id_article_informations
JOIN BRAND b
    ON b.id_brand = ai.id_brand
JOIN PRICE_HISTORY normal
    ON normal.id_article = a.id_article
    AND normal.end_date IS NULL
JOIN PRICE_HISTORY promo
    ON promo.id_article = a.id_article
    AND promo.end_date IS NOT NULL
    AND promo.end_date >= CURDATE()
    AND promo.start_date <= CURDATE()
    AND a.deleted_at IS NULL
LIMIT :limit");
            $query->bindValue(":limit", $limit, \PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function getAllArticlesWithModalities(): array
    {
        $query = $this->db->prepare("
        SELECT
            a.id_article,
            a.id_article_informations,
            ai.article_name,
            ft.filter_type_label,
            COALESCE(ct.choice, CAST(cn.choice AS CHAR), cc.color_choice_label) AS choice_value
        FROM {$this->tableName} a
        JOIN ARTICLE_INFORMATIONS ai
            ON ai.id_article_informations = a.id_article_informations
        LEFT JOIN VALUES_ v
            ON v.id_article = a.id_article
        LEFT JOIN FILTER_TYPE ft
            ON ft.id_filter_type = v.id_filter_type
        LEFT JOIN CHOICE_TXT ct ON ct.id_choice_ = v.id_choice_
        LEFT JOIN CHOICE_NUMBER cn ON cn.id_choice_ = v.id_choice_
        LEFT JOIN CHOICE_COLOR cc ON cc.id_choice_ = v.id_choice_
        WHERE a.deleted_at IS NULL
        ORDER BY a.id_article_informations, a.id_article
        
    ");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function deleteElementById(int $idArticle): bool
    {
        $query = $this->db->prepare("
        UPDATE {$this->tableName} 
        SET deleted_at = NOW()
        WHERE id_{$this->idName} = :idArticle
    ");
        $query->bindParam(':idArticle', $idArticle);
        return $query->execute();
    }
}

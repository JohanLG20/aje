<?php

namespace AJE\Model;

class DBArticleInformations extends CoreModel{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "ARTICLE_INFORMATIONS";
        $this->idName = strtolower($this->tableName);
    }

    public function getProductInformations(int $id): array|bool
    {
        // General information on the product
        $query = $this->db->prepare("
            SELECT
                ai.article_name,
                ai.description,
                ai.image_repertory as image_repertory,
                c.cat_label AS category,
                b.brand_label AS brand
            FROM {$this->tableName} ai
            JOIN CATEGORY c ON c.id_category = ai.id_category
            JOIN BRAND b ON b.id_brand = ai.id_brand
            WHERE ai.id_article_informations = :id
        ");
        $query->execute([':id' => $id]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }


    public function getProductVariants(int $id): array|bool
    {
        // Toutes les variantes (ARTICLE) liées à cet ARTICLE_INFORMATIONS
        $query = $this->db->prepare("
            SELECT
                a.id_article,
                normal.price AS normal_price,
                promo.price AS promo_price,
                ft.filter_type_label,
                COALESCE(ct.choice, CAST(cn.choice AS CHAR), cc.color_choice_label) AS choice_value,
                cc.color_choice_hexa
            FROM ARTICLE a
            JOIN PRICE_HISTORY normal
                ON normal.id_article = a.id_article
                AND normal.end_date IS NULL
            LEFT JOIN PRICE_HISTORY promo
                ON promo.id_article = a.id_article
                AND promo.end_date IS NOT NULL
                AND promo.end_date >= CURDATE()
                AND promo.start_date <= CURDATE()
            LEFT JOIN VALUES_ v ON v.id_article = a.id_article
            LEFT JOIN FILTER_TYPE ft ON ft.id_filter_type = v.id_filter_type
            LEFT JOIN CHOICE_TXT ct ON ct.id_choice_ = v.id_choice_
            LEFT JOIN CHOICE_NUMBER cn ON cn.id_choice_ = v.id_choice_
            LEFT JOIN CHOICE_COLOR cc ON cc.id_choice_ = v.id_choice_
            WHERE a.id_article_informations = :id
        ");
        $query->execute([':id' => $id]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
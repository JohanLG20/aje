<?php

namespace AJE\Model;

use PDOStatement;

class DBPriceHistory extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "PRICE_HISTORY";
        $this->idName = strtolower($this->tableName);
    }

    protected function prepareAddQuery(array $params): PDOStatement|false
    {
        //By default, if no values are specified for the startDate it take the day of the day
        if (isset($params['start_date'])) {
            $query = $this->db->prepare("INSERT INTO {$this->tableName}(id_article, price, start_date, end_date)
                            VALUES (:idArticle, :price, :startDate, :endDate)");
            $query->bindValue(":startDate", $params['start_date']);
        } else {
            $query = $this->db->prepare("INSERT INTO {$this->tableName}(id_article, price, end_date)
                            VALUES (:idArticle, :price, :endDate)");
        }

        $query->bindValue(":idArticle", $params['id_article']);
        $query->bindValue(":price", $params['price']);
        $query->bindValue(":endDate", $params['end_date'] ?? null);

        return $query;
    }

    /**
     * Change the price of all the articles that shares the same id_article_informations
     * @param int $idArticleInformations The group of article we want to modify
     * @param float $newPrice The new price to give
     * 
     * @return bool
     */
    public function updatePriceForAllVariants(int $idArticleInformations, float $newPrice): bool
    {
        try {
            $today = date('Y-m-d');

            // Retrieve all articles (variants) linked to this id_article_informations
            $query = $this->db->prepare("
            SELECT id_article 
            FROM ARTICLE 
            WHERE id_article_informations = :idArticleInformations
        ");
            $query->execute([':idArticleInformations' => $idArticleInformations]);
            $articles = $query->fetchAll(\PDO::FETCH_COLUMN);

            if (empty($articles)) {
                return false;
            }

            $this->db->beginTransaction();

            foreach ($articles as $idArticle) {
                // Close the current price (end_date IS NULL) by setting today's date
                $updateOld = $this->db->prepare("
                UPDATE PRICE_HISTORY 
                SET end_date = :today
                WHERE id_article = :idArticle 
                AND end_date IS NULL
            ");
                $updateOld->execute([
                    ':today'     => $today,
                    ':idArticle' => $idArticle
                ]);

                // Insert the new price 
                $insertNew = $this->db->prepare("
                INSERT INTO PRICE_HISTORY (end_date, price, id_article)
                VALUES (NULL, :price, :idArticle)
            ");
                $insertNew->execute([
                    ':price'     => $newPrice,
                    ':idArticle' => $idArticle
                ]);
            }

            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

}

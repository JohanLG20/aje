<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Utils\SaveImageHanddler;

class SearchPageController
{
    private function search(string $query): array
    {
        $query = trim($query);

        try {
            $dbArticle = new DBArticle();
            $eachQueryWord = explode(" ", $query);
            $articles = [];
            foreach ($eachQueryWord as $word) {
                $result = $dbArticle->searchForArticle($word);

                //Create a score that increase each time the article_informations appears
                foreach ($result as $row) {
                    $id = $row['id'];
                    if (!isset($articles[$id])) {
                        $articles[$id] = $row;
                        $articles[$id]['score'] = 0;
                    }
                    $articles[$id]['score']++;
                }
            }
            //We handdle the sort in php rather than sql to avoid doing it multiple times

            $sort['price'] = $_GET['price'] ?? null;
            $sort['alpha'] = $_GET['alpha'] ?? null;
             
            usort($articles, function ($a, $b) use ($sort) {
                // Tri par score en priorité
                if ($b['score'] !== $a['score']) {
                    return $b['score'] - $a['score'];
                }

                // Tri secondaire selon les options choisies
                foreach ($sort as $key => $order) {
                    $multiplier = $order === 'ASC' ? 1 : -1;

                    if ($key === 'price') {
                        $priceA = $a['promo_price'] ?? $a['normal_price'];
                        $priceB = $b['promo_price'] ?? $b['normal_price'];
                        $result = ($priceA <=> $priceB) * $multiplier;
                    } elseif ($key === 'alpha') {
                        $result = strcmp($a['article_name'], $b['article_name']) * $multiplier;
                    }

                    // Si les deux éléments sont différents sur ce critère on s'arrête
                    if ($result !== 0) return $result;
                }

                return 0;
            });

            $articles = SaveImageHanddler::addFirstImageToArray($articles);

            return $articles;
        } catch (\PDOException $e) {
            return ['error' => "Une erreur est survenue dans la recherche"];
            //TODO: handdle error
        }
    }

    public function displayView(string $query)
    {
        $articles = $this->search($query);
        require(VIEW . "/searchProduct_view.php");
    }
}

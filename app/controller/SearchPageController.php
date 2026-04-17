<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;

class SearchPageController
{
    private function search(string $query) : array
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
                    $id = $row['id_article'];
                    if (!isset($articles[$id])) {
                        $articles[$id] = $row;
                        $articles[$id]['score'] = 0;
                    }
                    $articles[$id]['score']++;
                }
            }
            // Tri par score décroissant
            usort($articles, fn($a, $b) => $b['score'] - $a['score']);

            return $articles;
        } catch (\PDOException $e) {
            return ['error' => "Une erreur est survenue dans la recherche"];
            //TODO: handdle error
        }
    }

    public function displayView(string $query)
    {
        $articles = $this->search($query);
        require(LAYOUT . "/header.php");
        require(VIEW . "/searchProduct_view.php");
        require(LAYOUT . "/footer.php");
    }
}

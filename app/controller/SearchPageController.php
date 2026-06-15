<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Utils\ImageHanddler;

class SearchPageController
{
    /**
     * Function that research the corresponding articles in the database, based on the given query
     * @param string $query The informations we have to search in the database
     * 
     * @return array An array that contains the informations needed by the view to be displayed
     */
    private function search(string $query): array
    {
        $query = trim($query);

        $metaDesc = "AJE - Vente d'équipements et de vêtement sportifs. " .$query;

        try {
            $dbArticle = new DBArticle();

            // Split the query by spaces
            $eachQueryWord = preg_split('/[\s+]+/', $query, -1, PREG_SPLIT_NO_EMPTY);

            $rawArticles = [];

            if (count($eachQueryWord) > 1) {
                // We get the results for the first word
                $firstResult = $dbArticle->searchForArticles($eachQueryWord[0]);
                $rawArticles = array_column($firstResult, null, 'id');

                // We search for the word that is present in the first resultat and the others
                for ($i = 1; $i < count($eachQueryWord); $i++) {
                    $result = $dbArticle->searchForArticles($eachQueryWord[$i]);
                    $resultIds = array_column($result, 'id');

                    $rawArticles = array_filter(
                        $rawArticles,
                        fn($article) => in_array($article['id'], $resultIds)
                    );
                }
            } else {
                // Search on a single word
                $result = $dbArticle->searchForArticles($query);
                $rawArticles = array_column($result, null, 'id');
            }


            $datas = $this->applyFiltersAndSort($rawArticles);
            $datas['filters'] = $this->getAvailableFilters($rawArticles);

            return $datas;
        } catch (\PDOException $e) {
            return ['error' => "Une erreur est survenue dans la recherche"];
        }
    }

    /**
     * Return the availables filter for a given set of articles
     * @param array $articles The list of articles we want the fiter of
     * 
     * @return array An array that contains all the filters available, which can be the category, the brand or the modalities
     */
    private function getAvailableFilters(array $articles): array
    {
        $filters = [
            'brands'     => [],
            'categories' => [],
            'modalities' => [] // Dynamics filters
        ];

        foreach ($articles as $art) {
            // Brands
            if (!empty($art['brand']) && !in_array($art['brand'], $filters['brands'])) {
                $filters['brands'][] = $art['brand'];
            }

            // Categories
            if (!empty($art['category']) && !in_array($art['category'], $filters['categories'])) {
                $filters['categories'][] = $art['category'];
            }

            // Dynamic modalities like size, shoe size ...
            if (!empty($art['filter_type_label']) && !empty($art['choice_value'])) {
                $label = $art['filter_type_label'];

                if (!isset($filters['modalities'][$label])) {
                    $filters['modalities'][$label] = [];
                }

                $alreadyPresent = array_column($filters['modalities'][$label], 'value');
                if (!in_array($art['choice_value'], $alreadyPresent)) {
                    $filters['modalities'][$label][] = [
                        'id_choice'      => $art['id_choice_'],
                        'id_filter_type' => $art['id_filter_type'],
                        'value'          => $art['choice_value'],
                        'hexa'           => $art['color_choice_hexa'] ?? null
                    ];
                }
            }
        }

        return $filters;
    }

    /**
     * Function that is in charge to display the view. A query can be entered to 
     * @param string $query
     *
     */
    public function displayView(string $query)
    {

        //Checking if 
        $isNewSearch = !isset($_SESSION['search_query'])
            || $_SESSION['search_query'] !== $query;

        if ($isNewSearch) {
            unset($_SESSION['search_query']);
        }

        // We save the query
        $_SESSION['search_query'] = $query;

        $datas = $this->search($query);

        $articles = $datas['articles'];
        $filters  = $datas['filters'];
        require(VIEW . "/searchProduct_view.php");
    }

    /**
     * Return the array ordered by the selected presets of alphabetic number and price, and filtered 
     * @param array $rawArticles The article to sort
     * 
     * @return array The same array, but sorted and filtered by the parameters chosen by the user
     */
    private function applyFiltersAndSort(array $rawArticles): array
    {
        $articles = $rawArticles;
        $filters = $_GET['filters'] ?? [];

        if (!empty($filters['brand'])) {
            $articles = array_filter(
                $articles,
                fn($art) => in_array($art['brand'], $filters['brand'])
            );
        }

        if (!empty($filters['category'])) {
            $articles = array_filter(
                $articles,
                fn($art) => in_array($art['category'], $filters['category'])
            );
        }

        $modalityFilters = array_filter(
            $filters,
            fn($key) => is_numeric($key),
            ARRAY_FILTER_USE_KEY
        );

        if (!empty($modalityFilters)) {
            $articles = array_filter($articles, function ($art) use ($modalityFilters) {
                foreach ($modalityFilters as $idFilterType => $choiceIds) {
                    if (
                        $art['id_filter_type'] != $idFilterType ||
                        !in_array($art['id_choice_'], $choiceIds)
                    ) {
                        return false;
                    }
                }
                return true;
            });
        }

        //Sorting the array
        $sort['price'] = $_GET['price'] ?? null;
        $sort['alpha'] = $_GET['alpha'] ?? null;

        usort($articles, function ($a, $b) use ($sort) {
            foreach ($sort as $key => $order) {
                $multiplier = $order === 'ASC' ? 1 : -1;

                if ($key === 'price') { //Checking if the price is selected, it also takes account of the promotion price
                    $priceA = $a['promo_price'] ?? $a['normal_price'];
                    $priceB = $b['promo_price'] ?? $b['normal_price'];
                    $result = ($priceA <=> $priceB) * $multiplier;
                } elseif ($key === 'alpha') {
                    $result = strcmp($a['article_name'], $b['article_name']) * $multiplier;
                }

                if (isset($result) && $result !== 0) return $result;
            }
            return 0;
        });

        //Creating the images
        $ih = new ImageHanddler();
        foreach($articles as &$art){
            $art['image'] = $ih->getFirstImage($art['image_repertory']);
        }

        return [
            'articles' => array_values($articles),
            // Les filtres disponibles sont calculés depuis les résultats bruts
            // pour ne pas perdre les options non sélectionnées
            'filters'  => $this->getAvailableFilters($rawArticles)
        ];
    }
}

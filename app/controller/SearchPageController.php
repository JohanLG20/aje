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
            $rawArticles = []; // Résultats bruts sans filtrage

            foreach ($eachQueryWord as $word) {
                $result = $dbArticle->searchForArticles($word);

                foreach ($result as $row) {
                    $id = $row['id'];
                    if (!isset($rawArticles[$id])) {
                        $rawArticles[$id] = $row;
                        $rawArticles[$id]['score'] = 0;
                    }
                    $rawArticles[$id]['score']++;
                }
            }

            
            // On applique les filtres et le tri sur les résultats bruts
            $datas = $this->applyFiltersAndSort($rawArticles);

            return $datas;
        } catch (\PDOException $e) {
            return ['error' => "Une erreur est survenue dans la recherche"];
        }
    }

    private function getAvailableFilters(array $articles): array
    {
        $filters = [
            'brands'     => [],
            'categories' => [],
            'modalities' => [] // Filtres dynamiques liés aux articles
        ];

        foreach ($articles as $art) {
            // Marques
            if (!empty($art['brand']) && !in_array($art['brand'], $filters['brands'])) {
                $filters['brands'][] = $art['brand'];
            }

            // Catégories
            if (!empty($art['category']) && !in_array($art['category'], $filters['categories'])) {
                $filters['categories'][] = $art['category'];
            }

            // Modalités dynamiques (tailles, couleurs, matières...)
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

        // Tri alphabétique des valeurs pour chaque type
        sort($filters['brands']);
        sort($filters['categories']);
        foreach ($filters['modalities'] as &$modality) {
            usort($modality, fn($a, $b) => strcmp($a['value'], $b['value']));
        }

        return $filters;
    }

    public function displayView(string $query)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $isNewSearch = !isset($_SESSION['search_query'])
            || $_SESSION['search_query'] !== $query;

        if ($isNewSearch) {
            unset($_SESSION['search_query']);
        }

        // On sauvegarde uniquement la query
        $_SESSION['search_query'] = $query;

        $datas = $this->search($query);

        $articles = $datas['articles'];
        $filters  = $datas['filters'];
        require(VIEW . "/searchProduct_view.php");
    }

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

        $sort['price'] = $_GET['price'] ?? null;
        $sort['alpha'] = $_GET['alpha'] ?? null;

        usort($articles, function ($a, $b) use ($sort) {
            if ($b['score'] !== $a['score']) {
                return $b['score'] - $a['score'];
            }
            foreach ($sort as $key => $order) {
                $multiplier = $order === 'ASC' ? 1 : -1;
                if ($key === 'price') {
                    $priceA = $a['promo_price'] ?? $a['normal_price'];
                    $priceB = $b['promo_price'] ?? $b['normal_price'];
                    $result = ($priceA <=> $priceB) * $multiplier;
                } elseif ($key === 'alpha') {
                    $result = strcmp($a['article_name'], $b['article_name']) * $multiplier;
                }
                if ($result !== 0) return $result;
            }
            return 0;
        });

        $articles = SaveImageHanddler::addFirstImageToArray($articles);

        return [
            'articles' => array_values($articles),
            // Les filtres disponibles sont calculés depuis les résultats bruts
            // pour ne pas perdre les options non sélectionnées
            'filters'  => $this->getAvailableFilters($rawArticles)
        ];
    }
}

<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBCategory;
use AJE\Utils\AJAXRequestHandler;
use AJE\Utils\UserErrorHelper;

class Debug
{
  public function launchDebug()
  {
    $query = "jogging";
    $query = trim($query);

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



      $datas['filters'] = $this->getAvailableFilters($rawArticles);
      //$datas = $this->applyFiltersAndSort($rawArticles);


      $json = json_encode($rawArticles);
      require(VIEW . "/debug.php");

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
            'value'          => $art['choice_value']
          ];
        }
      }
    }

    return $filters;
  }
}

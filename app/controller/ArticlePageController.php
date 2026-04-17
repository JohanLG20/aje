<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBBrand;
use AJE\Model\DBFilterType;
use AJE\Model\DBPriceHistory;
use AJE\Model\VFilterValuesAssociations;
use AJE\Controller\CommentController;
use AJE\Model\DBArticleInformations;
use Exception;
use PDOException;

class ArticlePageController
{
    public function __construct() {}
/*
    public function loadArticleInformation(string $id): array
    {
        try {
            $dbArticle = new DBArticle();
            $idArtInfo = $dbArticle->getElementById($id);

            if ($idArtInfo) {

                $dbArtInfo = new DBArticleInformations();
                $artInfo = $dbArtInfo->getElementById($idArtInfo['id_article_informations']);

                $infos['name'] = $artInfo['article_name'];
                $infos['description'] = $artInfo['description'];

                //Creating an that looks like ['normal_price'] => price, ['promo_price'] => promoPrice|null
                $infos['price'] = $dbArticle->getArticlePrice($id);


                $infos['images'] = $this->retrieveImages($artInfo['image_repertory'], $infos['name']);

                $dbBrand = new DBBrand();
                $infos['brand'] = $dbBrand->getElementById($artInfo['id_brand'])["brand_label"];

                //All the filters infos
                $infos['filerInfos'] = $this->retriveAllChoices($id);

                //We check if an error has occured
                if (isset($infos['comments']['error'])) {
                    $infos['commentError'] = $infos['comments']['error'];
                    unset($infos['comments']['error']); //We unset the variable to not disturb the display of the comments
                }

                $infos['id'] = $id;

                return $infos;
            } else {
                return [];
            }
        } catch (\Exception $e) {
            return [];
        }
    }*/

    public function show(int $idArticleInformations): void
    {
        try {
            $dbArticle = new DBArticle();

            // Récupération des infos générales
            $productInfo = $dbArticle->getProductInformations($idArticleInformations);

            if (!$productInfo) {
                // Produit introuvable, on redirige vers une page 404
                $this->notFound();
                return;
            }

            // Récupération des variantes et reformatage pour la vue
            $rawVariants = $dbArticle->getProductVariants($idArticleInformations);
            $variants = $this->formatVariants($rawVariants);

            // On passe les données à la vue
            require(VIEW . '/article/show.php');
        } catch (\PDOException $e) {
            // TODO: gérer l'erreur
        }
    }


    private function notFound(): void
    {
        http_response_code(404);
        require(VIEW . '/404.php');
    }

    /**
     * Return an associative array that contains all the choices available for this article. 
     * @param string $id The id of the article we want to retrieve the filter
     * 
     * @return array An associative array like
     * 
     * [idFilterType] => [
     *                      'label' => the label of the filter,
     *                      'values' => [
     *                                      [0] => choice,
     *                                  ]
     * ]...
     * 
     */
    private function retriveAllChoices(string $id): array
    {
        try {
            $dbArticle = new DBArticle();
            $allChoices = $dbArticle->getChoicesForArticle($id);

            $choiceInfos = array();
            $vAssoc = new VFilterValuesAssociations();

            foreach ($allChoices as $choice) {

                $ch = $vAssoc->getAllInfosForId($choice['id_choice_']);
                if (!array_key_exists($ch[0]['id_filter_type'], $choiceInfos)) {
                    $choiceInfos[$ch[0]['id_filter_type']]['values'] = array($ch[0]['filter_value']);
                } else {
                    array_push($choiceInfos[$ch[0]['id_filter_type']]['values'],  $ch[0]['filter_value']);
                }
            }

            //Preparing the label
            $dbFiltType = new DBFilterType();
            foreach ($choiceInfos as $key => $infos) {
                $choiceInfos[$key]['label'] = $dbFiltType->getElementById($key, ["filter_type_label"])["filter_type_label"];
            }

            return $choiceInfos;
        } catch (PDOException $e) {
            return []; //TODO: Handdle the error properly
        }
    }



}

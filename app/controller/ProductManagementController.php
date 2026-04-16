<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBArticleInformations;
use AJE\Model\DBBrand;
use AJE\Model\DBCategory;
use AJE\Model\DBPriceHistory;
use AJE\Model\DBValues_;
use AJE\Utils\ProductErrorHelper;
use AJE\Utils\SaveImageHanddler;
use AJE\Utils\DataTransformer;
use Exception;

class ProductManagementController extends CRUDController
{

    protected function getPostValuesErrors($action, $values): array|bool
    {
        return ProductErrorHelper::checkForErrors($values);
    }

    protected function create(array $params): string
    {
        try {

            $imageRepertory = uniqid();

            // ----------------- Creating the article informations ------------
            $artInfoDb = new DBArticleInformations();

            $artInfoParams = [
                'article_name' => $params['articleName'],
                'description' => $params['description'],
                'id_category' => $params['idCat'],
                'id_brand' => $params['idBrand'],
                'image_repertory' => $imageRepertory
            ];

            $artInfoDb->addNewElement($artInfoParams);
            $artInfoId = $artInfoDb->getLastAddedElement()['id_article_informations'];


            // -------------- Creating the price history parameter ------------
            $phDb = new DBPriceHistory();
            $phParams = [
                'price' => $params['price']
            ];

            /* ------------- Creating the filters value array ---------------
            * Post format of the fileters values
            *
            * [id_filter_type] => [
            *                    [0] => id_choice_,
            *                    [1] => id_choice_ ...
            *                    ]
            */
            
            $filterValues = [];
            //Retrieving all the filters and their values
            foreach ($params as $key => $val) {
                //The filter have numeric keys while the other values doesn't
                if (is_numeric($key)) {
                    if (is_array($val)) {
                        $filterValues[$key] = $val;
                    }
                }
            }


            $allFiltersValuesAssociations = DataTransformer::cartesianProduct($filterValues);

            $artDb = new DBArticle();
            $valDb = new DBValues_();
            $allCreatedArticles = []; //Used to create the pages of the new articles

            foreach ($allFiltersValuesAssociations as $val) {
                //Adding the price and the article
                $artDb->addNewElement(["id_article_informations" => $artInfoId]);
                $idLastArticle = $artDb->getLastAddedElement()['id_article'];
                $phParams['id_article'] = $idLastArticle;
                $phDb->addNewElement($phParams);
                
                //Creating the all the articles
                array_push($allCreatedArticles, $idLastArticle);

                //Adding all the values for each article
                foreach ($val as $filterKey => $choice) {

                    $valDb->addNewElement([
                        'id_article' => $idLastArticle,
                        'id_filter_type' => $filterKey,
                        'id_choice_' => $choice
                    ]);
                }
            }

            //--------------------- Saving the image -------------

            $sih = new SaveImageHanddler($imageRepertory);
            if (!$sih->saveImages($_FILES['images'])) {
                throw new Exception("Impossible de créer la page de l'article");
            }

            //--------------------- Creating the page ---------------
            /*  $cap = new CreateArticlePage();
            $fileContent = $cap->loadArticleInformation($idLastArticle);
            if ($cap->saveFile($fileContent)) {
            } else {
                throw new Exception("Impossible de créer la page de l'article");
            }*/

            return "Article ajouté avec succès";
        } catch (\PDOException $e) {
            return $this->handdleSqlErrors($e, 'create', $params);
        }
    }
    protected function update(array $params): string
    {
        throw new \Exception("Not implemented yet");
    }
    protected function delete(int $id): string
    {
        throw new \Exception("Not implemented yet");
    }
    protected function getSuccessMessage(string $action): string
    {
        throw new \Exception("Not implemented yet");
    }
    protected function handdleSqlErrors(\Exception $e, string $action, array $values): string
    {
        return $e->getMessage();
    }
    protected function setOperationLabel(string $action): string
    {
        $operationLabel = "";
        switch ($action) {
            case 'create':
                $operationLabel = "Ajouter un nouveau produit";
                break;
            case 'modify':
                $operationLabel = "Modifier un produit déjà existant";
                break;
        }
        return $operationLabel;
    }
    protected function completeViewInformations(): array
    {
        $catDb = new DBCategory();
        $brandDb = new DBBrand();
        $extraInformations['categoriesList'] = $catDb->getAllElements();
        $extraInformations['brandList'] = $brandDb->getAllElements();


        return $extraInformations;
    }
    protected function callView(array $view, array $values): void
    {
        require(VIEW . '/productManagement_view.php');
    }
}

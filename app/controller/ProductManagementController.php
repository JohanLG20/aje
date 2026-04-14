<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBBrand;
use AJE\Model\DBCategory;
use AJE\Model\DBChoiceColor;
use AJE\Model\DBPriceHistory;
use AJE\Model\DBValues_;
use AJE\Utils\ProductErrorHelper;
use AJE\Utils\SaveImageHanddler;
use AJE\Utils\CreateArticlePage;
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

            /* Post format of the fileters values
            *
            * [id_filter_type] => [
            *                    [0] => id_choice_
            *                    [1] => id_choice_ ...
            *                    ]
            */
            $valDb = new DBValues_();
            $filterValues = [];
            //Retrieving all the filters and their values
            foreach ($params as $key => $val) {
                if (is_numeric($key)) {
                    if (is_array($val)) {
                        $filterValues[$key] = $val;
                    }
                }
            }


            // ----------------- Creating the article in the ARTICLE db ------------
            $artDb = new DBArticle();
            $artParams = [
                'articleName' => $params['article_name'],
                'description' => $params['description'],
                'idCat' => $params['id_cat'],
                'idBrand' => $params['id_brand']
            ];
            $artDb->addNewElement($artParams);
            $idLastArticle = $artDb->getLastAddedElement()['id_article'];

            // -------------- Adding the line in the price history ------------
            $phDb = new DBPriceHistory();
            $phParams = [
                'idArticle' => $idLastArticle,
                'price' => $params['price']
            ];
            $phDb->addNewElement($phParams);

            // ------------ Adding the values ------------


            //Adding all the values in the table
            foreach ($filterValues as $filterKey => $filterVal) {
                foreach ($filterVal as $val) {
                    $valDb->addNewElement([
                        'id_article_' => $idLastArticle,
                        'id_filter_type' => $filterKey,
                        'id_choice' => $val
                    ]);
                }
            }

            //--------------------- Saving the image -------------

            $sih = new SaveImageHanddler($artParams['articleName'], $idLastArticle);
            if ($sih->saveImage($_FILES['images'])) {
            } else {
                throw new Exception("Impossible de créer la page de l'article");
            }

            //--------------------- Creating the page ---------------
            $cap = new CreateArticlePage();
            $fileContent = $cap->loadArticleInformation($idLastArticle);
            if ($cap->saveFile($fileContent)) {
            } else {
                throw new Exception("Impossible de créer la page de l'article");
            }

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
        $colorDb = new DBChoiceColor();
        $brandDb = new DBBrand();
        $extraInformations['categoriesList'] = $catDb->getAllElements();
        $extraInformations['colorsList'] = $colorDb->getAllElements();
        $extraInformations['brandList'] = $brandDb->getAllElements();


        return $extraInformations;
    }
    protected function callView(array $view, array $values): void
    {
        require(VIEW . '/productManagement_view.php');
    }
}

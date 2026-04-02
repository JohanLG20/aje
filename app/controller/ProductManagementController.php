<?php

namespace AJE\Controller;

use AJE\Model\DBArticle;
use AJE\Model\DBArticles;
use AJE\Model\DBBrand;
use AJE\Model\DBCategory;
use AJE\Model\DBChoice;
use AJE\Model\DBChoiceColor;
use AJE\Model\DBColors;
use AJE\Model\DBFilterValues;
use AJE\Utils\ProductErrorHelper;

class ProductManagementController extends CRUDController
{

    protected function getPostValuesErrors($action, $values): array|bool
    {
        return ProductErrorHelper::checkForErrors($values);
    }


    protected function create(array $params): string
    {
        try {
            $artDb = new DBArticle();
            $artParams = [
                'articleName' => $params['articleName'],
                'description' => $params['description'],
                'idCat' => $params['idCat']
            ];
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

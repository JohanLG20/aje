<?php

namespace AJE\Controller;

use AJE\Model\DBArticles;
use AJE\Model\DBCategory;
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
        try{
            if(DBArticles::addNewElement($params)){
                return "Article ajouté à la base de données";
            }
            else{
                return "Une erreur s'est produite lors de l'ajout, veuillez réessayer";
            }
        }
        catch (\PDOException $e){
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
        switch($action){
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
        $extraInformations['categoryList'] = DBCategory::getAllElements();
        $extraInformations['filterValueList'] = DBFilterValues::getAllElements();
        return $extraInformations;

    }
    protected function callView(array $view, array $values): void
    {
        require(VIEW . '/productManagement_view.php');
    }
}

<?php

namespace AJE\Controller;

class ProductManagementController extends CRUDController
{
    protected function getPostValuesErrors($action, $values): array|bool
    {
        throw new \Exception("Not implemented yet");
    }


    protected function create(array $params): string
    {
        throw new \Exception("Not implemented yet");
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
        throw new \Exception("Not implemented yet");
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
        return [];
    }
    protected function callView(array $view, array $values): void
    {
        require(VIEW . '/productManagement_view.php');
    }
}

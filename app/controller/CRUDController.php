<?php

namespace AJE\Controller;

use AJE\Utils\DataTransformer;

abstract class CRUDController
{
    abstract protected function getPostValuesErrors($action, $values): array|bool;
    abstract protected function handdleSqlErrors(\Exception $e, string $action, array $values): string;
    abstract protected function create(array $params): string;
    abstract protected function update(array $params): string;
    abstract protected function delete(int $id): string;
    abstract protected function getSuccessMessage(string $action): string;
    abstract protected function setOperationLabel(string $action): string;
    abstract protected function callView(array $view, array $values): void;
    abstract protected function completeViewInformations(): array;


    public function prepareAndDisplayView(string $action)
    {
        $view['action'] = $action;
        $values = [];

        $view['operationLabel'] = $this->setOperationLabel($action);

        if (isset($_POST['form_submitted'])) {
            $values = DataTransformer::escapeValues($_POST);

            if (!empty($values)) {

                $hasErrors = $this->getPostValuesErrors($action, $values);

                if (!$hasErrors) {
                    $view['operationResult'] = $this->executeOperation($action, $values);
                    $view['form-accepted'] = true;
                } else {
                    $view['errors'] = $hasErrors;
                }
            } else {
                $view['operationResult'] = "Les valeurs entrées ne permettent pas de soumettre ce formulaire";
            }
        }

        $extraInfos = $this->completeViewInformations();

        if (!empty($extraInfos)) {
            $view = self::addInfosToView($view, $extraInfos);
        }

        $this->callView($view, $values);
    }

    protected function executeOperation(string $action, array $values): string
    {
        $operationResult = "";
        switch ($action) {
            case 'create':
                $operationResult = $this->create($values);
                break;

            case 'update':
                $operationResult = $this->update($values);
                break;

            case 'delete':
                $operationResult = $this->delete(0); //TODO: Mettre à jour le int
                break;
        }

        return $operationResult;
    }


    private static function addInfosToView(array $array, array $infosToAdd): array
    {
        foreach ($infosToAdd as $key => $values) {
            $array[$key] = $infosToAdd[$key];
        }
        return $array;
    }
}

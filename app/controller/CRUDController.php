<?php
namespace AJE\Controller;
use AJE\Services\DataChecker;

abstract class CRUDController
{

    public static function test(){
        echo 'test';
    }
    abstract protected function getPostValuesErrors($action, $values): array|bool;
    abstract protected function loadSqlParams(string $action, array $values): array;
    abstract protected function handdleSqlErrors(string $errorMessage, string $action, array $values): string;
    abstract protected function callView(array $view, array $values): void;
    abstract protected function completeViewInformations(): array;
    abstract protected function create(array $valuesToAdd): bool;
    abstract protected function update(array $valuesToModify): bool;
    abstract protected function delete(int $id): bool;
    abstract protected function getSuccessMessage(string $action) : string;
    abstract protected function setOperationLabel(string $action): string;


    public function prepareAndDisplayView(string $action)
    {
        $view['action'] = $action;
        $values = [];

        $view['operationLabel'] = $this->setOperationLabel($action);

        if (isset($_POST['form_submitted'])) {
            $values = DataChecker::escapeValues($_POST);

            if ($values) {

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

        try {
            $params = $this->loadSqlParams($action, $values);

            switch ($action) {
                case 'create':
                    $operationSucceded = $this->create($params);
                    break;

                case 'update':
                    $operationSucceded = $this->update($params);
                    break;

                case 'delete':
                    $operationSucceded = $this->delete(0); //TODO: Mettre à jour le int
                    break;
            }
            if ($operationSucceded) {
                return $this->getSuccessMessage($action);
            } else {
                return "Une erreur est survenue lors de l'opération";
            }
        } catch (\PDOException $e) {
            $operationResult = $this->handdleSqlErrors($e->getMessage(), $action, $values);
            return $operationResult;
        }
    }


    private static function addInfosToView(array $array, array $infosToAdd): array
    {
        foreach ($infosToAdd as $key => $values) {
            $array[$key] = $infosToAdd[$key];
        }
        return $array;
    }
}

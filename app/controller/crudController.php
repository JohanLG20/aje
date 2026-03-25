<?php

abstract class CRUDController
{
    abstract protected function getPostValueErrors($action, $values): array|bool;
    abstract protected function loadSqlParams(string $action, array $values): array;
    abstract protected function handdleSqlErrors(string $errorMessage, string $action, array $values): string;
    abstract protected function callView(array $view, array $postValues): void;
    abstract protected function completeViewInformations(): array;
    abstract protected function create(array $valuesToAdd): bool;
    abstract protected function update(array $valuesToModify): bool;
    abstract protected function delete(): bool;
    abstract protected function getSuccessMessage(string $action) : string;


    public function prepareAndDisplayView(string $action)
    {
        $view['action'] = $action;

        if (isset($_POST['form_submitted'])) {
            $values = DataChecker::escapeValues($_POST);

            if ($values) {

                $hasErrors = $this->getPostValueErrors($action, $values);

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
                    $operationSucceded = $this->delete($params);
                    break;
            }
            if ($operationSucceded) {
                return $this->getSuccessMessage($action);
            } else {
                return "Une erreur est survenue lors de l'opération";
            }
        } catch (PDOException $e) {
            $operationResult = $this->handdleSqlErrors($e->getMessage(), $action, $values);
            return $operationResult;
        }
    }

    protected function setOperationLabel(string $action): string
    {
        $label = "";

        switch ($action) {
            case 'create':
                $label = "Ajouter";
                break;

            case 'update':
                $label = "Modifier";
                break;

            case 'delete':
                $label = "Supprimer";
                break;
        }

        return $label;
    }

    private static function addInfosToView(array $array, array $infosToAdd): array
    {
        foreach ($infosToAdd as $key => $values) {
            $array[$key] = $infosToAdd[$key];
        }
        return $array;
    }
}

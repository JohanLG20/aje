<?php

namespace AJE\Controller;

use AJE\Services\UserErrorHelper;

class UserManagementController extends CRUDController
{

    protected function getPostValuesErrors($action, $values): array|bool
    {

        return UserErrorHelper::checkForErrors($values);
    }
    protected function loadSqlParams(string $action, array $values): array
    {
        throw new \Exception("Not implemented yet");
    }
    protected function handdleSqlErrors(string $errorMessage, string $action, array $values): string
    {
        throw new \Exception("Not implemented yet");
    }
    protected function completeViewInformations(): array
    {
        return [];
    }
    protected function create(array $valuesToAdd): bool
    {
        throw new \Exception("Not implemented yet");
    }
    protected function update(array $valuesToModify): bool
    {
        throw new \Exception("Not implemented yet");
    }
    protected function delete(int $id): bool
    {
        throw new \Exception("Not implemented yet");
    }
    protected function getSuccessMessage(string $action): string
    {
        throw new \Exception("Not implemented yet");
    }
    protected function callView(array $view, array $values): void
    {
        if ($view['action'] === "create") {
            include(VIEW . '/userManagement_view.php');
        }
    }


    protected function setOperationLabel(string $action): string
    {
        $label = "";

        switch ($action) {
            case 'create':
                $label = "S'inscire sur AJE";
                break;

            case 'update':
                $label = "Modifier son profil";
                break;
        }

        return $label;
    }
}

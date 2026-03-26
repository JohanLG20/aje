<?php

namespace AJE\Controller;

use AJE\Utils\UserErrorHelper;
use AJE\Model\DBUsers;


class UserManagementController extends CRUDController
{

    protected function getPostValuesErrors($action, $values): array|bool
    {
        return UserErrorHelper::checkForErrors($values);
    }
    
    protected function handdleSqlErrors(\Exception $e, string $action, array $values): string
    {
        $errorMessage = "Une erreur inconnue s'est produite, veuillez réessayer ou contacter le support si le problème persiste.";
        if($e->getCode() == 0){
            $errorMessage = "Cette adresse email est déjà utilisée.";
        }
        return $errorMessage;
    }
    protected function completeViewInformations(): array
    {
        return [];
    }
    protected function create(array $params): string
    {
        $params['passwd']  = password_hash($params['passwd'], PASSWORD_DEFAULT);
        try{
            if(DBUsers::addNewElement($params)){
                return 'Votre compte à été créer avec succès. Vous pouvez maintenant vous identifier.';
            }
            else{
                return 'Une erreur est survenue lors de la création de votre compte, veuillez réessayer.';
            }
        }
        catch(\PDOException $e){
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
        $result = "";
        switch($action){
            case 'create':
                $result = "Votre compte a été crée avec succès !";
                break;
        }
        return $result;
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

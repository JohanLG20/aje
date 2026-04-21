<?php

namespace AJE\Controller;

use AJE\Model\DBUser;
use AJE\Utils\UserErrorHelper;


class UserManagementController extends CRUDController
{

    protected function getPostValuesErrors($action, $values): array|bool
    {
        return UserErrorHelper::checkForErrors($values, $action);
    }

    protected function handdleSqlErrors(\Exception $e, string $action, array $values): string
    {
        $errorMessage = "Une erreur inconnue s'est produite, veuillez réessayer ou contacter le support si le problème persiste.";
        if ($e->getCode() == 0) {
            $errorMessage = "Cette adresse email est déjà utilisée.";
        }
        return $errorMessage;
    }
    protected function completeViewInformations(string $action): array
    {
        return [];
    }
    protected function create(array $params): string
    {
        $params['passwd']  = password_hash($params['passwd'], PASSWORD_DEFAULT);
        try {
            $user = new DBUser();
            if ($user->addNewElement($params)) {
                return $this->getSuccessMessage("create");
            } else {
                return 'Une erreur est survenue lors de la création de votre compte, veuillez réessayer.';
            }
        } catch (\PDOException $e) {
            return $this->handdleSqlErrors($e, 'create', $params);
        }
    }
    protected function update(array $params): string
    {
        throw new \Exception("Not implemented yet");
    }
    protected function delete(array $params): string
    {
        try {
            $userDb = new DBUser();
            //We retrieve the id of the connected user.
            $authController = new AuthentificationController();
            $userId = $authController->getId();
            if ($userDb->deleteElementById($userId)) {
                //We send back the user to the home page
                header("Location: index.php");
                $authController->logout();
                return "";

            } else {
                return "Impossible de supprimer l'utilisateur";
            }
        } catch (\PDOException $e) {
            return "Une erreur est survenue lors de l'opération";
        }
    }
    protected function getSuccessMessage(string $action): string
    {
        $result = "";
        switch ($action) {
            case 'create':
                $result = "Votre compte a été crée avec succès !";
                break;
            case 'update':
                $result = "Votre compte à bien été modifé";
                break;
        }
        return $result;
    }
    protected function callView(array $view, array $values): void
    {

        include(VIEW . '/userManagement_view.php');
    }


    protected function setOperationLabel(string $action): string
    {
        $label = "";

        switch ($action) {
            case 'create':
                $label = "S'inscrire sur AJE";
                break;

            case 'update':
                $label = "Modifier son profil";
                break;
        }

        return $label;
    }
}

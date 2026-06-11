<?php

namespace AJE\Controller;

use AJE\Model\DBUser;
use AJE\Utils\UserErrorHelper;
use Exception;
use Override;

class UserManagementController extends CRUDController
{
    #[Override]
    public function prepareAndDisplayView(string $action)
    {
        //Checking a non connected user tries to access routes 
        if (($action !== 'create' && isset($_SESSION['userId'])) ||
                $action == 'create' && !isset($_SESSION['userId']) ) {
            return parent::prepareAndDisplayView($action);
        }

        header("Location: index.php"); //Redirecting the user to home page
    }

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
        return $e->getMessage();
    }
    protected function completeViewInformations(string $action): array
    {
        if ($action === "update") {

            try {
                $userDb = new DBUser();
                $userInfos = $userDb->getElementById($_SESSION['userId']);
                $val = [ //Tranlating the db names to the names of the forms
                    'firstname' => $userInfos['first_name'],
                    'lastname' => $userInfos['last_name'],
                    'email' => $userInfos['mail'],
                    'phoneNumber' => $userInfos['phone_number'] ?? '',
                    'postCode' => $userInfos['postal_code'],
                    'city' => $userInfos['city'],
                    'address' => $userInfos['address'],

                ];

                return $val;
            } catch (\PDOException $e) {
                throw $e;
            }
        }

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

        $idUser = $_SESSION['userId'];

        try {
            $dbUser = new DBUser();
            $values = [
                'first_name' => $params['firstname'],
                'last_name' => $params['lastname'],
                'mail' => $params['email'],
                'phone_number' => $params['phoneNumber'],
                'postal_code' => $params['postCode'],
                'city' => $params['city'],
                'address' => $params['address']
            ];
            $dbUser->modifyElementById($idUser, $values);
        } catch (\PDOException $e) {
            throw $e;
        }

        return $this->getSuccessMessage("update");
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
                throw new Exception("Erreur lors de la suppression de l'utilisateur");
            }
        } catch (\PDOException $e) {
            throw new Exception("Erreur lors de la suppression de l'utilisateur");
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

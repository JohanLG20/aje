<?php

namespace AJE\Controller;

use AJE\Utils\DataTransformer;
use AJE\Model\DBUser;
use AJE\Model\DBUserLevel;

class AuthentificationController
{
    private ?string $name;
    private ?string $id;
    private ?string $permissionLevel;
    private bool $connected;

    public function __construct()
    {
        $this->name = $_SESSION['name'] ?? null;
        $this->permissionLevel = $_SESSION['permissionLevel'] ?? null;
        $this->connected = $_SESSION['connected'] ?? false;
        $this->id = $_SESSION['userId'] ?? null;
    }

    /**
     * Allow the user to login, it takes the values directly from the $_POST array
     * It charges the $_SESSION array with ['name'] => The full name of the user
     *                                     ['connected'] => true
     *                                     ['permissionLevel'] => The permission label
     */
    public function login()
    {
        if (!empty($_POST)) {

            //Each values of the post is trimmed and filtered by htmlspecialchars
            $postVal = DataTransformer::escapeValues($_POST);
            try {
                $user = new DBUser();
                $requieredUser = $user->getUserByMail($postVal['mail']);

                //Checking if a user with this mail exists
                if ($requieredUser) {
                    //Checking if the password is correct
                    if (password_verify($postVal['passwd'], $requieredUser['passwd']) == $requieredUser['passwd']) {
                        $_SESSION['connected'] = true;
                        $_SESSION['name'] = $requieredUser['first_name'] . " " . $requieredUser['last_name'];

                        //Retrieving the user level label
                        $dbUserLevel = new DBUserLevel();
                        $_SESSION['permissionLevel'] = $dbUserLevel->getElementById($requieredUser['id_user_level'], ['users_level_label'])['users_level_label'];
                        $_SESSION['userId'] = $requieredUser['id_user_'];
                    } else {
                        $errors['login'] = "Identifiant ou mot de passe incorrect";
                    }
                } else {
                    $errors['login'] = "Identifiant ou mot de passe incorrect";
                }
            } catch (\PDOException $e) {
                $errors['login'] = "Une erreur à eu lieu lors de la connexion à la base de donnée, si  le problème persiste, contacter le webmaster";
            }
        } else {
            $errors['login'] = "Veuillez remplir tous les champs du formulaire";
        }

        if(isset($errors['login'])){
            $_SESSION['showLogin'] = true;
        }
        else{
            unset($_SESSION['showLogin']);
        }

    }

    /*
    * Allow the user to logout, unset the $_SESSION values linked the user
    */
    public function logout()
    {
        unset($_SESSION['connected']);
        unset($_SESSION['name']);
        unset($_SESSION['permissionLevel']);
        unset($_SESSION['userId']);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    /**
     * Check if a user is allowed to access the functionnality in regard of the given permission level requiered
     * @param string $requierement The level of the user requiered to access the functionnality
     * 
     * @return bool True if has equals or higher permission level, false otherwise
     */
    public function hasPermission(string $requierement) : bool{
        if($this->connected){
            switch($requierement){
                case 'client':
                    return !is_null($this->permissionLevel);
                    break;
                default:
                    return false;
            }
            
        }
        else{
            return false;
        }
        
    }

    /**
     * @return string|null Return the id of the authentificated user
     */
    public function getId() : ?string {
        return $this->id;
    }
}

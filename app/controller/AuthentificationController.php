<?php

namespace AJE\Controller;

use AJE\Model\DBComment;
use AJE\Utils\DataTransformer;
use AJE\Model\DBUser;
use AJE\Model\DBUserLevel;

/*
Class that allows the login, the logout and is in charge of checking the permissions. It contains 4 attributes that are stored in the $_SESSION superglobal : 
    - name : The full name of the user in the form "UserFirstName UserLastName"
    - permissionLevel : The label of the permission level. For now can be "client", "moderator", "administrator"
    - userId : The user id
    - connected : Boolean that say if the user is connected
*/

class AuthentificationController
{
    private ?string $name;
    private ?string $id;
    private ?string $permissionLevel;
    private bool $connected;
    private DBUser $db;

    public function __construct()
    {
        $this->db = new DBUser();
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

                $requieredUser = $this->db->getUserByMail($postVal['mail']);

                //Checking if a user with this mail exists
                if ($requieredUser) {
                    //Checking if the password is correct
                    if (password_verify($postVal['passwd'], $requieredUser['passwd']) == $requieredUser['passwd']) {
                        $_SESSION['connected'] = true;
                        $_SESSION['name'] = $requieredUser['first_name'] . " " . $requieredUser['last_name'];

                        //Retrieving the user level label
                        $dbUserLevel = new DBUserLevel();
                        $_SESSION['permissionLevel'] = $dbUserLevel->getElementById($requieredUser['id_user_level'], ['users_level_label'])['users_level_label']; // Setting the permissions level
                        $_SESSION['userId'] = $requieredUser['id_user_'];

                        header("Location: index.php");
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

        if (isset($errors['login'])) {
            $_SESSION['showLogin'] = true;
        } else {
            unset($_SESSION['showLogin']);
        }
    }

    /*
    * Allow the user to logout, unset the $_SESSION values linked the user
    * 
    */
    public function logout()
    {
        unset($_SESSION['connected']);
        unset($_SESSION['name']);
        unset($_SESSION['permissionLevel']);
        unset($_SESSION['userId']);

        //We check if the user has suppressed his account
        if (isset($_POST['account_deleted'])) {
            header("Location: index.php"); //We redirect him at the index
        } else {
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }

    /**
     * Check if a user is allowed to access the functionnality in regard of the given permission level requiered
     * @param string $requierement The level of the user requiered to access the functionnality
     * 
     * @return bool True if has equals or higher permission level, false otherwise
     */
    public function hasPermission(string $requierement): bool
    {
        if ($this->connected) {
            switch ($requierement) {
                case 'client':
                    return !is_null($this->permissionLevel);
                    break;
                case 'admin':
                    return $this->permissionLevel === 'admin';
                default:
                    return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @return string|null Return the id of the authentificated user
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Check if the connected user can edit the comment by comparing his id to the id of the user that posted the comment. Return true if he can edit the comment, false if he can't.
     * @param string $id The id of the user that posted the comment
     * 
     * @return bool Returns true if the connected user can edit the comment, false if not
     */
    public function canEditComment(string $id): bool
    {
        return $this->id === $id;
    }

    /**
     * Check if the connected user has the enough permission to delete a comment
     * 
     * @return bool Returns true if he can delete the comment, false if not.
     */
    public function canDeleteComment(): bool
    {
        if (
            $this->permissionLevel === "moderator" ||
            $this->permissionLevel === "admin"
        ) {
            return true;
        }
        return false;
    }

    /**
     * @param string $idArticle The article id we want to check
     * 
     * @return bool True if the connected user can comment, false otherwise
     */
    public function canCommentArticle(string $idArticle): bool
    {
        try {
            $dbUser = new DBUser();

            if (!is_null($this->id)) {
                $commentableArticles = $dbUser->getUserCommentablesArticles($this->id, $idArticle);
                if ($commentableArticles && !empty($commentableArticles)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la recherche des commentaires" . $e->getMessage());
        }
    }
}

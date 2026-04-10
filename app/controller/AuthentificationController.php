<?php

namespace AJE\Controller;

use AJE\Utils\DataTransformer;
use AJE\Model\DBUser;
use Exception;

class AuthentificationController
{

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
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    public function logout()
    {
        unset($_SESSION['connected']);
        unset($_SESSION['name']);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}

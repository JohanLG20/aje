<?php

use AJE\Utils\DataTransformer;
use AJE\Model\DBUser;

if (!empty($_POST)) {

    //Each values of the post is trimmed and filtered by htmlspecialchars
    $postVal = DataTransformer::escapeValues($_POST);
    $user = new DBUser();
    $requieredUser = $user->getElementById($postVal['mail']);

    //Checking if a user with this mail exists
    if ($requieredUser) {
        //Checking if the password is correct
        if (password_verify($postVal['passwd'], $requieredUser['passwd']) == $requieredUser['passwd']) {
            $_SESSION['connected'] = true;
            $_SESSION['name'] = $requieredUser['first_name'] . " " . $requieredUser['last_name'];
            header("Location: index.php");
        } else {
            $errors['login'] = "Identifiant ou mot de passe incorrect";
        }
    }
    else{
        $errors['login'] = "Identifiant ou mot de passe incorrect";
    }
} else {
    $errors['login'] = "Veuillez remplir tous les champs du formulaire";
}


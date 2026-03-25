<?php



if (!empty($_POST)) {

    require(SERVICES . '/dataChecker.php');
    //Each values of the post is trimmed and filtered by htmlspecialchars
    $postVal = DataChecker::escapeValues($_POST);

    if ($_ENV['DB_USER'] == $postVal['username'] && $_ENV['DB_PASSWORD'] == $postVal['password']) {
        $_SESSION['connected'] = true;
        header("Location: index.php");
    } else {
        $errors['login'] = "Identifiant ou mot de passe incorrect";
    }
} else {
    $errors['login'] = "Veuillez remplir tous les champs du formulaire";
}

require(VIEW . "/firstview_view.php");

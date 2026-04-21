<div id="connexionMenu"
    class="dropDownMenu topMenuIcon hidden">
    <?php if (isset($_SESSION['connected']) && $_SESSION['connected']): ?>
        <div id="welcomeMenu">
            <p class="menuLoginForm">Bonjour <?= $_SESSION['name'] ?></p>
            <?php if (isset($_SESSION['permissionLevel']) && $_SESSION['permissionLevel'] === "admin"): ?>
                <a href="index.php?path=/productmanagement/create" class="menuLoginForm">Ajouter un produit</a>
                <a href="index.php?path=/productmanagement/delete" class="menuLoginForm">Supprimer un produit</a>
                <a href="index.php?path=/promotion/create" class="menuLoginForm">Ajouter une promotion</a>

            <?php endif; ?>
            <a href="index.php?path=/usermanagement/update" class="menuLoginForm">Modifier mon profil</a>
            <a href="index.php?path=/logout/" class="menuLoginForm">Se déconnecter</a>
        </div>
    <?php else: ?>
        <form action="index.php?path=/login/" method="post" id="loginForm">
            <div id="loginInputs">
                <input type="text" name="mail" id="mail" placeholder="Entrez votre email">
                <input type="password" name="passwd" id="passwd" placeholder="Entrez votre mot de passe">

            </div>
            <?php if (isset($errors['login'])): ?>
                <p class="error"><small><?= $errors['login'] ?></small></p>
            <?php endif; ?>

            <button type="submit" class="btn1">Connexion</button>
        </form>
        <a href="index.php?path=/usermanagement/create" id="accountCreationLink">Vous n'avez pas encore de compte ? Inscrivez vous !</a>

    <?php endif; ?>
</div>
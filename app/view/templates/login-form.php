<div id="connexionMenu"
    class="dropDownMenu topMenuIcon hidden">
    <?php if (isset($_SESSION['connected']) && $_SESSION['connected']): ?>
        <div id="welcomeMenu">
            <p>Bonjour <?= $_SESSION['name'] ?></p>
            <a href="index.php?path=/usermanagement/update">Modifier mon profil</a>
            <a href="index.php?path=/logout/">Se déconnecter</a>
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
<div id="connexionMenu"
    class="dropDownMenu topMenuIcon <?= isset($_GET['action']) && $_GET['action'] === 'login' ? 'visible' : 'hidden' ?>">
    <form action="?action=login" method="post">
        <input type="text" name="username" id="username">
        <input type="password" name="passwd" id="passwd">

        <?php if (isset($errors['login'])): ?>
            <p class="error"><small><?= $errors['login'] ?></small></p>
        <?php endif; ?>

        <button type="submit" class="btn1">Connexion</button>
        <a href="index.php?action=signup">Vous n'avez pas encore de compte ? Inscrivez vous !</a>

    </form>
</div>
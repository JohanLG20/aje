<div id="connexionMenu"
    class="dropDownMenu topMenuIcon <?= isset($_GET['action']) && $_GET['action'] === 'login' ? 'visible' : 'hidden' ?>">
    <?php if (isset($_SESSION['connected']) && $_SESSION['connected']): ?>
        <div>
            <p>Bonjour <?= $_SESSION['name'] ?></p>
            <a href="index.php?action=myprofil">Voir mon profil</a>
            <a href="index.php?path=/logout/">Se déconnecter</a>
        </div>
    <?php else: ?>
        <form action="index.php?path=/login/" method="post">
            <input type="text" name="mail" id="mail" placeholder="Entrez votre email">
            <input type="password" name="passwd" id="passwd" placeholder="Entrez votre mot de passe">

            <?php if (isset($errors['login'])): ?>
                <p class="error"><small><?= $errors['login'] ?></small></p>
            <?php endif; ?>

            <button type="submit" class="btn1">Connexion</button>
            <a href="index.php?path=/usermanagement/create">Vous n'avez pas encore de compte ? Inscrivez vous !</a>
        </form>
    <?php endif; ?>
</div>
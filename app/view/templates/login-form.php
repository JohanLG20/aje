<section id="connexionMenu"
    class="dropDownMenu topMenuIcon <?= $_SESSION['showLogin'] ?? 'hidden' ?>">
    <?php if (isset($_SESSION['connected']) && $_SESSION['connected']): ?>
        <section id="welcomeMenu">
            <p class="menuLoginForm">Bonjour <?= $_SESSION['name'] ?></p>
            <hr>
            <?php if (isset($_SESSION['permissionLevel']) && $_SESSION['permissionLevel'] === "admin"): ?>
                <a href="?path=/productmanagement/create" class="menuLoginForm">Ajouter un produit</a>
                <a href="?path=/productmanagement/delete" class="menuLoginForm">Supprimer un produit</a>
                <a href="?path=/promotion/create" class="menuLoginForm">Ajouter une promotion</a>
                <a href="?path=/revenues" class="menuLoginForm">Récapitulatif des ventes</a>


            <?php endif; ?>
            <a href="?path=/usermanagement/update" class="menuLoginForm">Modifier mon profil</a>
            <a href="?path=/logout/" class="menuLoginForm">Se déconnecter</a>
        </section>
    <?php else: ?>
        <form action="?path=/login/" method="post" id="loginForm">
            <div id="loginInputs">
                <input type="text" name="mail" id="mail" placeholder="Entrez votre email">
                <input type="password" name="passwd" id="passwd" placeholder="Entrez votre mot de passe">

            </div>
            <?php if (isset($_SESSION['loginError'])): ?>
                <p class="error"><small><?= $_SESSION['loginError'] ?></small></p>
            <?php endif; ?>
            <input type="hidden" name="connexionAttempt">
            <button type="submit" class="btn1">Connexion</button>
        </form>
        <a href="?path=/usermanagement/create" id="accountCreationLink">Vous n'avez pas encore de compte ? Inscrivez vous !</a>

    <?php endif; ?>
</section>
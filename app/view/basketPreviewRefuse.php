<?php require(LAYOUT . "/header.php"); ?>

<main class="container">
    <div id="notFoundPage">

        <div id="notFoundContent">
            <p>Vous devez être connecté pour accéder à votre panier</p>
            <button id="connexionButton" class="btn1">Je me connecte</button>
            <a href="?path=/usermanagement/create" class="btn2">Je me créer un compte</a>

        </div>

    </div>
</main>

<script src="static/js/basketRefuse.js"></script>

<?php require(LAYOUT . "/footer.php"); ?>
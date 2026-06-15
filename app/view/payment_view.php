<?php require(LAYOUT . '/header.php'); ?>

<main class="container">
    <h2>Un dernier coup d'oeil sur vos articles ?</h2>

    <?php require(TEMPLATES . "/basketPreview.php"); ?>

    <a id="validatePaymentButton" href="?path=/pay/" class="btn1">Valider le paiement</a>

</main>


<?php require(LAYOUT . '/footer.php'); ?>
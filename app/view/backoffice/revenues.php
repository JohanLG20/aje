<?php require(LAYOUT . '/header.php') ?>
<main class="container">

    <section id="revenuesSection">
        <h2>Récapitulatif des ventes</h2>
        <p><b>Total des ventes :</b> <span><?= $total ?>€</span></p>
        <p><b>Nombre d'articles vendus :</b> <span><?= $totalQuantity ?></span></p>
        <p><b>Prix moyen d'une vente :</b> <span><?= $averagePrice ?>€</span></p>
    </section>


</main>
<?php require(LAYOUT . '/footer.php') ?>
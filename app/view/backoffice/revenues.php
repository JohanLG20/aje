<?php require(LAYOUT . '/header.php') ?>
<main class="container">

    <h2>Récapitulatif des ventes</h2>
    <p>Total des ventes : <span><?= $total ?>€</span></p>
    <p>Nombre d'articles vendus : <span><?= $totalQuantity ?></span></p>
    <p>Prix moyen d'une vente : <span><?= $averagePrice ?>€</span></p>
    
</main>
<?php require(LAYOUT . '/footer.php') ?>
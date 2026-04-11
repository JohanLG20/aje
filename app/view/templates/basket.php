<?php if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])):  ?>
    <div id="basket">
        <?php foreach ($_SESSION['basket'] as $bask): ?>
            <div class="basketItemCard">
                <img src=<?= $bask['image'] ?> alt=<?= $bask['name'] ?>>
                <div class="basketDescriptionSection">
                    <p class="basketArticleName"><?= $bask['name'] ?></p>
                    <p class="basketArticlePrice">Prix unitaire : <?= $bask['price'] ?>€</p>
                    <div class="basketQuantity">
                        <p>Quantité</p>
                        <p><?= $bask['quantity'] ?></p>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
        <?php if (isset($validatePayment)): ?>
            <a href="index.php?path=/pay/" class="btn1">Valider le paiement</a>
        <?php else: ?>
            <a id="basketPaymentButton" href="index.php?path=/payment/" class="btn1">Payer</a>
        <?php endif; ?>
    </div>


<?php else: ?>
    <p id="noArticleInBasket">Aucun article dans le panier</p>
<?php endif; ?>
<?php if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])):  ?>
    <div id="basket">
        <?php foreach ($_SESSION['basket'] as $idArticle => $bask): ?>
            <div class="basketItemCard">
                <img src="<?= $bask['image'] ?>" alt="<?= $bask['name'] ?>">
                <div class="basketDescriptionSection">
                    <a href="?path=/article/<?= $idArticle ?>" class="basketArticleLink"><?= $bask['name'] ?></a>
                    <div class=price>
                        <p class="<?= !is_null($bask['price']["promo_price"]) ? 'promotion' : 'normalPrice' ?>"><?= $bask['price']["normal_price"] ?>€</p>
                        <?php if (isset($bask['price']['promo_price'])): ?>
                            <p class="promotionNewPrice"><?= $bask['price']['promo_price'] ?>€</p>
                        <?php endif; ?>
                    </div>
                    <div class="basketQuantity">
                        <p>Quantité</p>
                        <p><?= $bask['quantity'] ?></p>
                        <a href="?path=/basket/remove/<?= $idArticle ?>" class="error">Supprimer</a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
        <?php if (isset($validatePayment)): ?>
            <a href="?path=/pay/" class="btn1">Valider le paiement</a>
        <?php else: ?>
            <a id="basketPaymentButton" href="?path=/payment/" class="btn1">Payer</a>
        <?php endif; ?>
    </div>


<?php else: ?>
    <p id="noItemInBasket">Aucun article dans le panier</p>
<?php endif; ?>
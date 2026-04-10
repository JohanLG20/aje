<?php if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])):  ?>
    <div id="basket">
        <?php foreach ($_SESSION['basket'] as $bask): ?>
            <div class="basketItemCard">
                <img src=<?= $bask['image'] ?> alt=<?= $bask['name'] ?>>
                <div class="basketDescriptionSection">
                    <p class="basketArticleName"><?= $bask['name'] ?></p>
                    <p class="basketArticlePrice"><?= $bask['price'] ?>€</p>
                </div>
                <div class="basketQuantity">
                    <p><?= $bask['quantity'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <a href="index.php?path=/payement/" class="btn1">Payer</a>
    </div>

    
<?php else: ?>
    <p id="noArticleInBasket">Aucun article dans le panier</p>
<?php endif; ?>
<article class="articleCard">
    <img src=<?= $art['image'] ?> alt=<?= $art['article_name'] ?>>
    <div class="articleCardDescription">
        <a href="index.php?path=/article/<?= $art['id'] ?>" class="articleCardLink"><?= $art['article_name'] ?></a>
        <p class="articleCardBrand"><?= $art['brand'] ?></p>
        <div class=price>
            <p class="<?php !is_null($art["promo_price"]) ? 'promotion' : '' ?>"><?= $art["normal_price"] ?>€</p>
            <?php if (isset($art['promo_price'])): ?>
                <p><?= $art['promo_price'] ?>€</p>
            <?php endif; ?>
        </div>
        <div class="articleCardAddBasket">
            <a href="index.php?path=/basket/add/<?= $art['id'] ?>" class="addBasketButton btn1">Ajouter au panier</a>
        </div>
    </div>
</article>
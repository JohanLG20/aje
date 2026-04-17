<article class="articleCard">
    <a href="index.php?path=/article/<?= $art['id'] ?>" class="articleCardLink">
        <div class="articleCardImage">
            <img src="<?= $art['image'] ?>" alt="<?= $art['article_name'] ?>">
        </div>
        <div class="articleCardDescription">
            <p class="articleCardTitle"><?= $art['article_name'] ?></p>
            <p class="articleCardBrand"><em><?= $art['brand'] ?></em></p>
            <div class="price">
                <p class="<?= !is_null($art["promo_price"]) ? 'promotion' : 'normalPrice' ?>"><?= $art["normal_price"] ?>€</p>
                <?php if (isset($art['promo_price'])): ?>
                    <p class="promotionNewPrice"><?= $art['promo_price'] ?>€</p>
                <?php endif; ?>
            </div>
        </div>
    </a>
</article>
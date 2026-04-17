
            <div class="basketItemCard">
                <img src=<?= $art['image'] ?> alt=<?= $art['article_name'] ?>>
                <div class="basketDescriptionSection">
                    <a href="index.php?path=/test/<?= $art['id_article'] ?>" class="basketArticleLink"><?= $art['article_name'] ?></a>
                    <div class=price>
                        <p class="<?php !is_null($art["promo_price"]) ? 'promotion' : '' ?>"><?= $art["normal_price"] ?>€</p>
                        <?php if (isset($art['promo_price'])): ?>
                            <p><?= $art['promo_price'] ?>€</p>
                        <?php endif; ?>
                    </div>
                    <a href="index.php?path/addToBasket/<?= $art['id_article'] ?>"></a>
                </div>

            </div>



<?php require(LAYOUT . "/header.php"); ?>
<main class="container" id="articlePage">
    <article id="<?= $productInfo['id'] ?>" class="product-page" title="<?= $productInfo['article_name'] ?>">

        <section class="product-header">

            <section id="gallery">
                <h1><?= $productInfo['article_name'] ?></h1>

                <img id="mainImage"
                    src="<?= $productInfo['imagesPath'][0] ?>"
                    alt="<?= $productInfo['article_name'] ?>">

                <?php if (count($productInfo['imagesPath']) > 1): ?>
                    <div id="thumbnails">
                        <?php foreach ($productInfo['imagesPath'] as $index => $imagePath): ?>
                            <img src="<?= $imagePath ?>"
                                alt="<?= $productInfo['article_name'] ?>"
                                class="<?= $index === 0 ? 'active' : '' ?>"
                                onclick="changeMainImage(this)">
                        <?php endforeach ?>
                    </div>
                <?php endif; ?>
            </section>

            <section class="product-details">
                <span class="product-brand"><?= $productInfo['brand'] ?></span>
                <div class="price">
                    <p class="<?= !is_null($productInfo['price']["promo_price"]) ? 'promotion' : 'normalPrice' ?>">
                        <?= $productInfo['price']["normal_price"] ?>€
                    </p>
                    <?php if (isset($productInfo['price']['promo_price'])): ?>
                        <p class="promotionNewPrice"><?= $productInfo['price']['promo_price'] ?>€</p>
                    <?php endif; ?>
                </div>
                <p class="deliveryDate">Livré le plus rapidement possible</p>
                <a href="?path=/basket/add/<?= $idArt ?>" class="addBasketButton btn1">
                    Ajouter au panier
                </a>
            </section>
        </section>

        <section class="product-section">
            <h3 class="articleInfos">Description du produit</h3>
            <section class="product-section-content">
                <p><?= $productInfo['description'] ?></p>
            </section>
        </section>

        <section class="product-section">
            <h3 class="articleInfos">Spécifications</h3>
            <section class="product-section-content">

                <?php if (isset($activeVariantLabel)): ?>
                    <div class="modality">
                        <span class="modality-label"><?= $activeVariantLabel ?></span>
                        <span class="modality-value"><?= $activeVariantValue ?></span>
                    </div>
                <?php endif; ?>

                <?php foreach ($commonModalities as $label => $modality): ?>
                    <div class="modality">
                        <span class="modality-label"><?= $label ?></span>

                        <span class="modality-value"><?= $modality['value'] ?></span>

                    </div>
                <?php endforeach; ?>
            </sections>
        </section>

        <?php
        if ($productInfo['hasVariants']): ?>
            <section class="product-section">
                <h3 class="articleInfos">Tous les modèles disponibles</h3>
                <section class="product-section-content">
                    <div id="variantsList">
                        <?php foreach ($variants as $variant): ?>
                            <a href="?path=/article/<?= $variant['id_article'] ?>"
                                class="variant-card <?= ($variant['id_article'] == $activeVariant) ? 'active' : '' ?>">
                                <?php foreach ($variant['modalities'] as $label => $modality): ?>
                                    <span class="modality-value"><?= $modality['value'] ?></span>
                                <?php endforeach; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            </section>
        <?php endif; ?>

        <section class="product-section" id="commentSection">

            <section id="commentSectionHeader" class="articleInfos-header">
                <h3 class="articleInfos">Commentaires</h3>
                <?php if (isset($productInfo['canAddComment']) && $productInfo['canAddComment']): ?>
                    <p id="addComment">Ajouter un commentaire</p>
                <?php endif; ?>
            </section>

            <section class="product-section-content">
                <?php if (isset($_SESSION['commentError'])): ?>
                    <p class="error"><?= $_SESSION['commentError'] ?></p>
                <?php endif; ?>

                <?php if (!empty($productInfo['comments'])): ?>
                    <section id="allComments">
                        <?php foreach ($productInfo['comments'] as $comment): ?>
                            <div id="<?= $comment['idComment'] ?>" class="comment">
                                <div class="commentHeader">
                                    <h4><?= $comment['fullname'] ?></h4>
                                    <div class="commentActions">
                                        <?php if (isset($comment['canEdit']) && $comment['canEdit']): ?>
                                            <button class="editComment">Editer</button>
                                        <?php endif; ?>
                                        <?php if (isset($comment['canDelete']) && $comment['canDelete']): ?>
                                            <form class="deleteForm" action="?path=/comment/delete/<?= $comment['idComment'] ?>" method="post">
                                                <input type="hidden" name="idArticle" value="<?= $productInfo['id'] ?>">
                                                <button type="submit" class="deleteComment">Supprimer</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <p class="commentText"><?= $comment['comment'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    </section>
                <?php else: ?>
                    <p class="noComment">Aucun commentaire sur l'article pour le moment.</p>
                <?php endif; ?>
            </section>
        </section>

    </article>

    <section id="relatedArticles">
        <h2>Produits qui pourraient vous intéresser également</h2>
        <?php if ($relatedArticles): ?>
            <?php foreach ($relatedArticles as $art):  ?>
                <?php require(TEMPLATES . '/articleCard.php'); ?>
            <?php endforeach ?>
        <?php else: ?>
            <p>Aucun article proposé pour le moment.</p>
        <?php endif ?>
    </section>
</main>


<script src="static/js/articleView.js"></script>

<?php require(LAYOUT . "/footer.php"); ?>
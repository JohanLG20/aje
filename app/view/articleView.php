<?php require(LAYOUT . "/header.php"); ?>
<main class="container">
    <div class="product-page">

        <!-- En-tête produit -->
        <div class="product-header">
            <h1><?= $productInfo['article_name'] ?></h1>

            <!-- Galerie d'images -->
            <div id="gallery">
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
            </div>

            <!-- Détails -->
            <div class="product-details">
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
            </div>
        </div>

        <!-- Description -->
        <div class="product-section">
            <h3 class="articleInfos">Description du produit</h3>
            <div class="product-section-content">
                <p><?= $productInfo['description'] ?></p>
            </div>
        </div>

        <!-- Spécifications -->
        <div class="product-section">
            <h3 class="articleInfos">Spécifications</h3>
            <div class="product-section-content">

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
            </div>
        </div>

        <!-- Variantes -->
        <?php 
            if ($productInfo['hasVariants']): ?>
            <div class="product-section">
                <h3 class="articleInfos">Tous les modèles disponibles</h3>
                <div class="product-section-content">
                    <div id="variantsList">
                        <?php foreach ($variants as $variant): ?>
                            <a href="?path=/article/<?= $variant['id_article'] ?>"
                                class="variant-card <?= ($variant['id_article'] == $activeVariant ) ? 'active' : '' ?>">
                                <?php foreach ($variant['modalities'] as $label => $modality): ?>
                                    <span class="modality-value"><?= $modality['value'] ?></span>
                                <?php endforeach; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Commentaires -->
        <div class="product-section" id="commentSection">
            <div id="commentSectionHeader" class="articleInfos-header">
                <h3 class="articleInfos">Commentaires</h3>
                <?php if (isset($productInfo['canAddComment']) && $productInfo['canAddComment']): ?>
                    <p id="addComment">Ajouter un commentaire</p>
                <?php endif; ?>
            </div>

            <div class="product-section-content">
                <?php if (isset($productInfo['commentError'])): ?>
                    <p class="error"><?= $productInfo['commentError'] ?></p>
                <?php endif; ?>

                <?php if (!empty($productInfo['comments'])): ?>
                    <div id="allComments">
                        <?php foreach ($productInfo['comments'] as $comment): ?>
                            <div id="<?= $comment['idComment'] ?>" class="comment">
                                <div class="commentHeader">
                                    <h4><?= $comment['fullname'] ?></h4>
                                    <div class="commentActions">
                                        <?php if (isset($comment['canEdit']) && $comment['canEdit']): ?>
                                            <p class="editComment hidden" >Editer</p>
                                        <?php endif; ?>
                                        <?php if (isset($comment['canDelete']) && $comment['canDelete']): ?>
                                            <a href="?path=/deleteComment/<?= $comment['idComment'] ?>" class="deleteComment">Supprimer</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <p><?= $comment['comment'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="noComment">Aucun commentaire sur l'article pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

<script>
    function changeMainImage(thumbnail) {
        document.getElementById('mainImage').src = thumbnail.src;
        document.getElementById('mainImage').alt = thumbnail.alt;
        document.querySelectorAll('#thumbnails img').forEach(img => img.classList.remove('active'));
        thumbnail.classList.add('active');
    }

    let addCommentButton = document.querySelector("#addComment")
    if (addCommentButton !== null) {
        addCommentButton.addEventListener("click", () => {
            let addSectionComment = document.querySelector('#addCommentSection')
            if (addSectionComment === null) {
                let commentForm = createCommentForm("Ajouter")
                commentSectionHeader.after(commentForm)
            }
        })
    }

    function createCommentForm(action, preloadedDatas = "") {
        let addCommentSection = document.createElement("div")
        addCommentSection.id = "addCommentSection"

        let addCommentForm = document.createElement("form")
        addCommentForm.action = "?path=/addComment/"
        addCommentForm.method = "POST"

        let addCommentFormTitle = document.createElement("h4")
        addCommentFormTitle.id = "addCommentFormTitle"
        addCommentFormTitle.textContent = "Ajouter un commentaire"

        let addCommentFormText = document.createElement("textarea")
        addCommentFormText.name = "comment"

        let addCommentFormSubmit = document.createElement("button")
        addCommentFormSubmit.classList.add('btn1')
        addCommentFormSubmit.type = "submit"
        addCommentFormSubmit.textContent = "Envoyer le commentaire"

        addCommentSection.append(addCommentForm)
        addCommentForm.append(addCommentFormTitle)
        addCommentForm.append(addCommentFormText)
        addCommentForm.append(addCommentFormSubmit)
        return addCommentSection
    }
</script>

<?php require(LAYOUT . "/footer.php"); ?>
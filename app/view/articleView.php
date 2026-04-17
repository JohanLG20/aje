<?php require(LAYOUT . "/header.php"); ?>

<div class="product-page">

    <!-- Informations générales -->
    <div class="product-header">
        <?php foreach ($productInfo['imagesPath'] as $imagePath): ?>
            <img src="<?= $imagePath ?>"
                alt="<?= $productInfo['article_name'] ?>">
        <?php endforeach ?>
        <div class="product-details">
            <span class="product-brand"><?= $productInfo['brand'] ?></span>
            <h1><?= $productInfo['article_name'] ?></h1>
            <p><?= $productInfo['description'] ?></p>
            <span class="product-category"><?= $productInfo['category'] ?></span>
        </div>
    </div>

    <!-- Variantes -->
    <div class="product-variants">

        <?php foreach ($variants as $variant): ?>
            <a href="index.php?path=/article/<?= $variant['id_article'] ?>"
                class="variant-card">

                <!-- Modalités -->
                <div class="variant-modalities">
                    <?php foreach ($variant['modalities'] as $label => $modality): ?>
                        <div class="modality">
                            <span class="modality-label">
                                <?= $label ?>
                            </span>

                            <?php if ($modality['hexa']): ?>
                                <!-- Affichage spécial pour les couleurs -->
                                <span class="modality-color"
                                    style="background-color: <?= $modality['hexa'] ?>"
                                    title="<?= $modality['value'] ?>">
                                </span>
                            <?php else: ?>
                                <span class="modality-value">
                                    <?= $modality['value'] ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            </a>
        <?php endforeach; ?>

    </div>

    <div id="commentSection">
        <?php if (isset($productInfo['commentError'])): ?>
            <p><?= $productInfo['commentError'] ?></p>
        <?php endif; ?>


        <!-- Comments --->

        <div id="commentSectionHeader">
            <h3 id="productInfo">
                Commentaires
            </h3>
            <?php if (isset($productInfo['canAddComment']) && $productInfo['canAddComment']): ?>
                <p id="addComment">Ajouter un commentaire</p>
            <?php endif; ?>
        </div>

        <?php if (!empty($productInfo['comments'])): ?>
            <div id="allComments">
                <?php foreach ($productInfo['comments'] as $comment): ?>
                    <div id="<?= $comment['idComment'] ?>" class="comment">
                        <div class="commentHeader">
                            <h4><?= $comment['fullname'] ?></h4>
                            <?php if (isset($comment['canEdit']) && $comment['canEdit']): 
                            ?>
                                <a href="index.php?path=/editComment/<?= $comment['idComment'] ?>" class="editComment">Editer</a>
                            <?php endif; ?>
                            <?php if (isset($comment['canDelete']) && $comment['canDelete']): ?>
                                <a href="index.php?path=/deleteComment/<?= $comment['idComment'] ?>" class="deleteComment">Supprimer</a>
                            <?php endif; ?>
                        </div>

                        <p><?= $comment['comment'] ?></p>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucun commentaire sur l'article pour le moment.</p>
        <?php endif; ?>
    </div>
</div>


<script>
    let addCommentButton = document.querySelector("#addComment")
    if (addCommentButton !== null) {
        addCommentButton.addEventListener("click", () => {
            let commentSection = document.querySelector("#allComments")
            let addSectionComment = document.querySelector('#addCommentSection')

            //Checking if the section is already openned
            if (addSectionComment === null) {
                let commentForm = createCommentForm("Ajouter")
                //Insert the add comment section just after the header
                commentSectionHeader.after(commentForm)
            }


        })

        let deleteCommentButton = document.querySelector("#deleteComment")
        if (addCommentButton !== null) {

        }
    }


    /**
     * @return [type] Return a div that contains the form to add the comment
     */
    function createCommentForm(action, preloadedDatas = "") {
        let addCommentSection = document.createElement("div")
        addCommentSection.id = "addCommentSection"

        let addCommentForm = document.createElement("form")
        addCommentForm.action = "index.php?path=/addComment/"
        addCommentForm.method = "POST"

        let addCommentFormTitle = document.createElement("h4")
        addCommentFormTitle.id = "addCommentFormTitle"
        addCommentFormTitle.textContent = "Ajouter un commentaire"

        let addCommentFormText = document.createElement("textarea")
        addCommentFormText.name = "comment"

        let addCommentFormSubmit = document.createElement("button")
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
<article class="container">
    <?php //var_dump($articleInfos); 
    ?>

    <div id="productOverview">
        <div>
            <h2><?= $articleInfos['name'] ?></h2>
            <div id="images">
                <?php foreach ($articleInfos['images'] as $img): ?>
                    <img src=<?= $img['path'] ?> alt="<?= $img['alt'] ?>">
                <?php endforeach ?>
            </div>
            <p><?= $articleInfos['brand'] ?></p>
            <div class=price>
                <p class="<?php !is_null($articleInfos['price']["promo_price"]) ? 'promotion' : '' ?>"><?= $articleInfos['price']["normal_price"] ?>€</p>
                <?php if (isset($articleInfos['price']['promo_price'])): ?>
                    <p><?= $articleInfos['price']['promo_price'] ?>€</p>
                <?php endif; ?>
            </div>
            <p>DATE DE LIVRAISON</p>
            <a href="index.php?path=/basket/add/<?= $articleInfos['id'] ?>" class="addBasketButton btn1">Ajouter au panier</a>
        </div>

        <!-- Description -->
        <div>
            <h3 class="articleInfos">
                Description du produit
            </h3>
            <p><?= $articleInfos['description'] ?></p>
        </div>

        <!-- Specifications techniques -->
        <div>
            <h3 class="articleInfos">
                Spécifications
            </h3>
            <?php foreach ($articleInfos['filerInfos'] as $specif): ?>
                <p>

                    <?= $specif['label'] ?> : <?= implode(', ', $specif['values']) ?>
                </p>
            <?php endforeach; ?>
        </div>
        <div id="commentSection">
            <?php if (isset($articleInfos['commentError'])): ?>
                <p><?= $articleInfos['commentError'] ?></p>
            <?php endif; ?>

    </div>


    <div id="relatedArticles">

    </div>
</article>

<script>
    let addCommentButton = document.querySelector("#addComment")
    if (addCommentButton !== null) {
        addCommentButton.addEventListener("click", () => {
            let commentSection = document.querySelector("#allComments")
            let addSectionComment = document.querySelector('#addCommentSection')

            //Checking if the section is already openned
            if (addSectionComment === null) {
                let commentForm = createCommentForm("Ajouter")
                commentSection.prepend(commentForm)
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
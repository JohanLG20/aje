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
            <p><?= $articleInfos['price'] ?>€</p>
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


            <!-- Comments --->

            <div id="commentSectionHeader">
                <h3 id="articleInfos">
                    Commentaires
                </h3>
                <?php if (isset($articleInfos['canAddComment']) && $articleInfos['canAddComment']): ?>
                    <p id="addComment">Ajouter un commentaire</p>
                <?php endif; ?>
            </div>
            <?php if (!empty($articleInfos['comments'])): ?>
                <div id="allComments">
                    <?php foreach ($articleInfos['comments'] as $comment): ?>
                        <div id="<?= $comment['idComment'] ?>" class="comment">
                            <div class="commentHeader">
                                <h4><?= $comment['fullname'] ?></h4>
                                <?php if (isset($comment['canEdit']) && $comment['canEdit'] && false):  //Decomment &&false when the function is done
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
            <?php else:?>
                <p>Aucun commentaire sur l'article pour le moment.</p>                        
            <?php endif; ?>
        </div>
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
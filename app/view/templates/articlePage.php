<div class="container">
    <?php //var_dump($articleInfos); ?>

    <div id="productOverview">
        <div>
            <h2><?= $articleInfos['name'] ?></h2>
            <div id="images">
                <?php foreach($articleInfos['images'] as $img): ?>
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
            <?php foreach($articleInfos['filerInfos'] as $specif): ?>
                <p>
                    
                    <?=  $specif['label'] ?> : <?= implode(', ', $specif['values']) ?>
                </p>
            <?php endforeach; ?>
          </div>
        <?php if(!empty($articleInfos['comments'])): ?>
        <!-- Comments --->
         <div id="commentSection">
            <h3 class="articleInfos">
                Commentaires
            </h3>
            <?php foreach($articleInfos['comments'] as $comment): ?>
                <h4><?= $comment['fullname'] ?></h4>
                <p><?= $comment['comment'] ?></p>

            <?php endforeach; ?>
         </div>
         <?php endif; ?>

    </div>


    <div id="relatedArticles">

    </div>
</div>

<div class="container">
    <?php //var_dump($articleInfos); ?>

    <div id="productOverview">
        <div>
            <h2><?= $articleInfos['name'] ?></h2>

            <p><?= $articleInfos['brand'] ?></p>
            <p><?= $articleInfos['price'] ?>€</p>
            <p>DATE DE LIVRAISON</p>
            <button class="addToBasket btn1" value="<?= $articleInfos['id'] ?>">Ajouter au panier</button>
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
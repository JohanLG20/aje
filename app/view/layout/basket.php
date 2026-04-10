<?php if(isset($_SESSION['basket']) && !empty($_SESSION['basket'])): 
        foreach($_SESSION['basket'] as $bask): ?>
            <div class="basketItemCard">
                <div>
                    <img src=<?= $bask['image']?> alt=<?= $bask['name'] ?>>
                </div>
                <div class="basketDescriptionSection">
                    <p><?= $bask['name'] ?></p>
                    <p><?= $bask['brand'] ?></p>
                    <p><?= $bask['price'] ?>€</p>
                </div>
                <div class="basketQuantity">
                    <p><?= $bask['quantity'] ?></p>
                </div>
            </div>
       <?php  endforeach;?>
       <a href="index.php?path=/payement/" class="btn1">Payer</a>
        <?php else:?>
    <p id="noArticleInBasket">Aucun article dans le panier</p>
    <?php endif; ?>

    
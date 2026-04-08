<?php if(isset($_SESSION['basket']) && !empty($_SESSION['basket'])): 
        var_dump($_SESSION['basket']);
        else:
        ?>
    <p id="noArticleInBasket">Aucun article dans le panier</p>
    <?php endif; ?>
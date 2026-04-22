<?php require(LAYOUT . "/header.php"); ?>

<main class="container">
    <div id="confirmationPage">

        <div id="confirmationCard">

            <!-- Icône succès -->
            <div id="confirmationIcon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <h1>Commande confirmée !</h1>
            <p class="confirmationSubtitle">Merci pour votre achat, <?= ($_SESSION['name']) ?> !</p>


            <!-- Récapitulatif commande -->
            <div id="orderSummary">
                <h2>Récapitulatif</h2>

                <div id="orderItems">
                    <?php foreach ($orderInfos['items'] as $item): ?>
                        <div class="orderItem">
                            <img src="<?= ($item['image']) ?>"
                                alt="<?= ($item['name']) ?>">
                            <div class="orderItemDetails">
                                <p class="orderItemName"><?= ($item['name']) ?></p>
                                <p class="orderItemQuantity">Quantité : <?= $item['quantity'] ?></p>
                            </div>
                            <div class="orderItemPrice price">
                                <?php if (!empty($item['price']['promo_price'])): ?>
                                    <p class="promotion"><?= number_format($item['price']['normal_price'], 2) ?>€</p>
                                    <p class="promotionNewPrice"><?= number_format($item['price']['promo_price'] * $item['quantity'], 2) ?>€</p>
                                <?php else: ?>
                                    <p class="normalPrice"><?= number_format($item['price']['normal_price'] * $item['quantity'], 2) ?>€</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


            <!-- Actions -->
            <div id="confirmationActions">
                <a href="index.php" class="btn1">Retour à l'accueil</a>
                <a href="?path=/search/sport" class="btn2">Continuer mes achats</a>
            </div>

        </div>

    </div>
</main>

<?php require(LAYOUT . "/footer.php"); ?>
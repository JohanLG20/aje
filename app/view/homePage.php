<?php require(LAYOUT . "/header.php"); ?>

<h2>Les nouveautés</h2>
<div class="articleCardSlider">
    <?php foreach ($latestArticles as $art) {
        require(TEMPLATES . "/articleCard.php");
    } ?>
</div>

<h2>Les promotions</h2>
<div class="articleCardSlider">
    <?php foreach ($promotions as $art) {
        require(TEMPLATES . "/articleCard.php");
    } ?>
</div>



<?php require(LAYOUT . "/footer.php"); ?>
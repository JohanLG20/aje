<pre>
   <?php var_dump($articles) ?>
</pre>

<?php if (isset($articles) && !empty($articles) && !array_key_exists('error', $articles)):  ?>

    <div id="researchResults">
        <?php foreach ($articles as $idArticle => $art):
            require(TEMPLATES . "/researchCard.php");
        endforeach; ?>
    </div>


<?php elseif (array_key_exists('error', $articles)): ?>
    <p><?= $articles['error'] ?></p>

<?php else: ?>
    <p>Aucun résultat pour la recherche</p>

<?php endif; ?>
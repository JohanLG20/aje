<?php require(LAYOUT . '/header.php'); ?>

<main class="container">
    <h2><?= $view['operationLabel'] ?></h2>
    <form action="?path=/productmanagement/delete/" method="post" enctype="multipart/form-data">
        <?php if ($view['action'] !== "create"): ?>
            <div class="form-item">
                <label for="idArticle">Selectionnez un article</label>
                <select name="idArticle" required>
                    <?php foreach ($view['articlesList'] as $article): ?>
                        <option
                            value="<?= $article['id'] ?? '' ?>"
                            <?= $article['disabled'] ? 'disabled' : '' ?>>
                            <?= str_repeat('&nbsp;&nbsp;&nbsp;', $article['depth']) ?>
                            <?= $article['depth'] > 0 ? '└ ' : '' ?>
                            <?= $article['label'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <input type="hidden" name="form_submitted">
        <button type="submit" class="btn1">Supprimer</button>

        <?php if (isset($view['operationResult'])) : ?>
            <p><?= $view['operationResult'] ?></p>
        <?php endif; ?>

    </form>
</main>

<?php require(LAYOUT . '/footer.php'); ?>
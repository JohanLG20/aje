<?php require(LAYOUT . "/header.php"); ?>

<main class="container">
    <h2>Créer une nouvelle promotion</h2>

    <form action="?path=/promotion/<?= $view['action'] ?>" method="POST">

        <!-- Sélection de l'article -->

        <div class="form-item">
            <label for="idArticle">Selectionnez un article</label>
            <select name="idArticle">
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
            <?php if (isset($view['errors']["idArticle"])): ?>
                <p class="error"><?= $view['errors']["idArticle"] ?></p>
            <?php endif; ?>
        </div>



        <!-- Date de début -->
        <div class="form-item">
            <label for="startDate">Date de début :</label>
            <input type="date" name="startDate" id="startDate" required>
        </div>
        <?php if (isset($view['errors']["startDate"])): ?>
            <p class="error"><?= $view['errors']["startDate"] ?></p>
        <?php endif; ?>

        <!-- Date de fin -->
        <div class="form-item">
            <label for="endDate">Date de fin :</label>
            <input type="date" name="endDate" id="endDate" required>
        </div>
        <?php if (isset($view['errors']["endDate"])): ?>
            <p class="error"><?= $view['errors']["endDate"] ?></p>
        <?php endif; ?>

        <!-- Prix -->
        <div class="form-item">
            <label for="price">Prix promotionnel :</label>
            <input type="text" name="price" id="price" placeholder="Ex: 19.99" pattern="[0-9]+([\.,][0-9]+)?" required>
        </div>
        <?php if (isset($view['errors']["price"])): ?>
            <p class="error"><?= $view['errors']["price"] ?></p>
        <?php endif; ?>

        <input type="hidden" name="form_submitted">
        <button type="submit" class="btn1">Enregistrer la promotion</button>

    </form>
    <?php if (isset($view['operationResult'])) : ?>
        <p><?= $view['operationResult'] ?></p>
    <?php endif; ?>
</main>

<?php require(LAYOUT . "/footer.php"); ?>
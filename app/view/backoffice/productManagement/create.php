<?php require(LAYOUT . '/header.php'); ?>

<main class="container">
    <h2><?= $view['operationLabel'] ?></h2>
    <form action="?path=/productmanagement/create" method="post" enctype="multipart/form-data">

            <!-- Article name -->
            <div class="form-item">
                <label for="articleName">Nom de l'article</label>
                <input type="text" name="articleName" id="articleName" placeholder="Le nom de l'article"
                    value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['articleName']) ? $values['articleName'] : '' ?>">
                <?php if (isset($view['errors']['articleName'])): ?>
                    <p class="error"><?= $view['errors']['articleName'] ?></p>
                <?php endif; ?>
            </div>


            <!-- Brand -->
            <div class="form-item">
                <label for="idBrand">Marque de l'article</label>
                <select name="idBrand" id="idBrand" value="<?= $values['idBrand'] ?? '' ?>">
                    <option value="-1">Sélectionnez une marque</option>
                    <?php //Creating the options with all the brand in the database
                    foreach ($view['brandList'] as $brand):
                    ?>
                        <option value="<?= $brand['id_brand'] ?>" <?= isset($values['idBrand']) && $values['idBrand'] == $brand['id_brand'] ? 'selected' : ''?>> <?= $brand['brand_label'] ?></option>
                    <?php endforeach ?>
                </select>
                <?php if (isset($view['errors']['idBrand'])): ?>
                    <p class="error"><?= $view['errors']['idBrand'] ?></p>
                <?php endif; ?>
            </div>


            <!-- Description -->
            <div class="form-item">
                <label for="description">Description de l'article</label>
                <textarea name="description" id="description" placeholder="Décrivez l'article, essayez de faire un texte vendeur !"
                    value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['description']) ? $values['description'] : '' ?>" maxlength="255" rows="5"></textarea>
                <?php if (isset($view['errors']['description'])): ?>
                    <p class="error"><?= $view['errors']['description'] ?></p>
                <?php endif; ?>
            </div>


            <!-- Price -->
            <div class="form-item">
                <label for="price">Prix de l'article</label>
                <input type="text" name="price" id="price" placeholder="Le prix de l'article"
                    value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['price']) ? $values['price'] : '' ?>" maxlength="255">
                <?php if (isset($view['errors']['price'])): ?>
                    <p class="error"><?= $view['errors']['price'] ?></p>
                <?php endif; ?>
            </div>



            <!-- Categories -->
            <div class="form-item">
                <label for="idCat">Catégorie de l'article</label>
                <select name="idCat" id="idCat" value="<?= $values['idCat'] ?? '' ?>">
                    <option value="-1">Sélectionnez une catégorie</option>
                    <?php //Creating the options with all the categories in the database
                    foreach ($view['categoriesList'] as $category):
                    ?>
                        <option value="<?= $category['id_category'] ?>">
                            <?= str_repeat('&nbsp;&nbsp;&nbsp;', $category['depth']) ?>
                            <?= $category['depth'] > 0 ? '└ ' : '' ?>
                            <?= $category['cat_label'] ?>
                        </option> <?php endforeach ?>
                </select>
                <?php if (isset($view['errors']["idCat"])): ?>
                    <p class="error"><?= $view['errors']["idCat"] ?></p>
                <?php endif; ?>
            </div>


            <!-- Categories -->
            <div class="form-list">
                <p><b>Liste des filtres</b></p>
                <div id="filterList">

                </div>
            </div>


            <!-- Image section -->
            <div>
                <p><b>Ajouter des images</b></p>
                <div id="images">
                    <?php if (isset($view['errors']["images"])): ?>
                        <p id="imageNeededMessage" class="error"><?= $view['errors']['images'] ?></p>
                    <?php else: ?>
                        <p id="imageNeededMessage">Veuillez insérer au moins une image</p>
                    <?php endif ?>
                </div>
                <i id="addImageButton" class="fa-solid fa-plus miniButton"></i>

            </div>
            <br>
        <input type="hidden" name="form_submitted">
        <button type="submit" class="btn1">Ajouter</button>

        <?php if (isset($view['operationResult'])) : ?>
            <p><?= $view['operationResult'] ?></p>
        <?php endif; ?>
    </form>


</main>


<script src="static/js/addProduct.js"></script>
<?php require(LAYOUT . '/footer.php'); ?>
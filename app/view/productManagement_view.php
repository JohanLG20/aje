<?php require(LAYOUT . '/header.php'); ?>

<main>
    <h2><?= $view['operationLabel'] ?></h2>
    <form action="index.php?path=/productmanagement/<?= $view['action'] ?>" method="post" enctype="multipart/form-data">
        <!-- Article name -->
        <div class="form-item">
            <label for="articleName">Nom de l'article</label>
            <input type="text" name="articleName" id="articleName" placeholder="Le nom de l'article"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['articleName']) ? $values['articleName'] : '' ?>">
        </div>
        <?php if (isset($view['errors']['articleName'])): ?>
            <p class="error"><?= $view['errors']['articleName'] ?></p>
        <?php endif; ?>

        <!-- Brand -->
        <div class="form-item">
            <label for="brand">Marque de l'article</label>
            <input type="text" name="brand" id="brand" placeholder="La marque de l'article"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['brand']) ? $values['brand'] : '' ?>">
        </div>
        <?php if (isset($view['errors']['brand'])): ?>
            <p class="error"><?= $view['errors']['brand'] ?></p>
        <?php endif; ?>

        <!-- Description -->
        <div class="form-item">
            <label for="description">Marque de l'article</label>
            <textarea name="description" id="description" placeholder="Décrivez l'article, essayez de faire un texte vendeur !"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['description']) ? $values['description'] : '' ?>" maxlength="255" rows="5"></textarea>
        </div>
        <?php if (isset($view['errors']['description'])): ?>
            <p class="error"><?= $view['errors']['description'] ?></p>
        <?php endif; ?>

        <div class="form-item">
            <label for="idCat">Catégorie de l'article</label>
            <select name="idCat" id="idCat" value="<?= $values['idCat'] ?? '' ?>">
                <option value="-1">Sélectionnez une catégorie</option>
                <?php //Creating the options with all the categories in the database
                foreach ($view['categoryList'] as $category):
                ?>
                    <option value=<?= $category['id_cat'] ?>> <?= $category['cat_label'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <?php if (isset($view['errors']["idCat"])): ?>
            <p class="error"><?= $view['errors']["idCat"] ?></p>
        <?php endif; ?>
        <div id="addImagesSection">
            <p><b>Ajouter des images</b></p>
        </div>
        <i id="addImage" class="fa-solid fa-plus miniButton"></i>
        <br>
        <input type="hidden" name="form_submitted">
        <button type="submit" class="btn1"><?= explode(" ", $view['operationLabel'])[0] ?></button>

    </form>

    <?php if (isset($view['operationResult'])) : ?>
        <p><?= $view['operationResult'] ?></p>
    <?php endif; ?>
</main>

<script>
    let addImagesSection = document.getElementById("addImagesSection")
    let addImage = document.getElementById("addImage")
    addImage.addEventListener("click", () => {
        //Creating the div and its components
        let newImageDiv = document.createElement("div")
        newImageDiv.classList.add("form-item")
        let newImageInput = document.createElement("input")
        newImageInput.type = "file"
        newImageInput.name = "images[]"
        newImageInput.placeholder = "Uploader une image"
        let removeImageButton = document.createElement("i")
        removeImageButton.classList.add("fa-solid", "fa-minus", "miniButton")

        newImageDiv.appendChild(newImageInput)
        newImageDiv.appendChild(removeImageButton)

        addImagesSection.appendChild(newImageDiv)

        let listener = removeImageButton.addEventListener("click", (e) => {
            addImagesSection.removeChild(e.target.parentNode)
            //Removing the listener as the element doesn't exists anymore
            e.target.removeEventListener("click", listener)

        })

    })
</script>

<?php require(LAYOUT . '/footer.php'); ?>
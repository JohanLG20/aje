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

        <!-- Colors -->
        <div class="form-item">
            <label for="idColor">Couleur de l'article</label>
            <select name="idColor" id="idColor" value="<?= $values['idColor'] ?? '' ?>">
                <option value="-1">Sélectionnez une couleur</option>
                <?php //Creating the options with all the colors in the database
                foreach ($view['colorsList'] as $color):
                ?>
                    <option value=<?= $color['id_choice'] ?>> <?= $color['color_choice_label'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <?php if (isset($view['errors']["idColor"])): ?>
            <p class="error"><?= $view['errors']["idColor"] ?></p>
        <?php endif; ?>

        <!-- Categories -->
        <div class="form-item">
            <label for="idCat">Catégorie de l'article</label>
            <select name="idCat" id="idCat" value="<?= $values['idCat'] ?? '' ?>">
                <option value="-1">Sélectionnez une catégorie</option>
                <?php //Creating the options with all the categories in the database
                foreach ($view['categoriesList'] as $category):
                ?>
                    <option value=<?= $category['id_cat'] ?>> <?= $category['cat_label'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <?php if (isset($view['errors']["idCat"])): ?>
            <p class="error"><?= $view['errors']["idCat"] ?></p>
        <?php endif; ?>

        <!-- Categories -->
        <div id="filterList">

        </div>

        <!-- Image section -->
        <div>
            <p><b>Ajouter des images</b></p>
            <div id="images">
                <p id="imageNeededMessage">Veuillez ajouter au moins une image</p>
            </div>
        </div>
        <i id="addImageButton" class="fa-solid fa-plus miniButton"></i>
        <br>
        <input type="hidden" name="form_submitted">
        <button type="submit" class="btn1"><?= explode(" ", $view['operationLabel'])[0] ?></button>

    </form>

    <?php if (isset($view['operationResult'])) : ?>
        <p><?= $view['operationResult'] ?></p>
    <?php endif; ?>
</main>

<script>
    let images = document.getElementById("images")
    let addImage = document.getElementById("addImageButton")
    addImage.addEventListener("click", () => {

        let imageNeededMessage = document.querySelector("#")
        
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

        images.appendChild(newImageDiv)

        let listener = removeImageButton.addEventListener("click", (e) => {
            images.removeChild(e.target.parentNode)

            if(addImagesSection)
            //Removing the listener as the element doesn't exists anymore
            e.target.removeEventListener("click", listener)

        })

    })

    let categorySelector = document.querySelector("#idCat")
    let filterListDiv = document.querySelector("#filterList")
    //TODO: Verifier la consommation de mémoire pour le innerHTML = ""
    categorySelector.addEventListener("change", () => {
        //Removing all the existing elements of the filter
        filterListDiv.innerHTML = "";

        //Adding the filters only if a category is selected
        if (categorySelector.value != -1) {
            //Adding the title
            let filterListTitle = document.createElement("p")
            let filterListBoldTitle = document.createElement("b")
            filterListBoldTitle.textContent = "Ajouter des valeurs de filtres pour l'article"
            filterListTitle.append(filterListBoldTitle)
            filterListDiv.appendChild(filterListTitle)

            //Adding the filters
            fetch("index.php?path=/filterRequest/getFvForCat/"+categorySelector.value)
            .then(r => {
                console.log(r)
                if(r.ok){
                    return r.json()
                }
                else{
                    throw new Exception("Impossible de charger les filtres")
                }
            })
            .then(filtersTypes =>{
                
                for(let keys in filtersTypes){
                    let filterDiv = createFilterValuesDiv(keys, filtersTypes[keys])
                    filterListDiv.appendChild(filterDiv)
                }
            })
        }


    })

    function createFilterValuesDiv(filterName, filterValues){
        let filterDiv = document.createElement("div")
        filterDiv.classList.add("form-item")

        let filterLabel = document.createElement("p")
        filterLabel.textContent = filterValues.label
        filterDiv.appendChild(filterLabel)

        //Creating the selector
        let filterSelector = document.createElement("select")
        filterSelector.setAttribute("name", filterName+"[]")
        filterSelector.setAttribute("multiple", true)
        filterDiv.appendChild(filterSelector)

        filterValues.values.forEach(val => {
            let option = document.createElement("option")
            option.textContent = val.filter_value 
            option.setAttribute('value', val.id_choice)
            filterSelector.appendChild(option)
        });

        filterDiv.appendChild(filterSelector)

        return filterDiv
    }
</script>

<?php require(LAYOUT . '/footer.php'); ?>
<div class="filter-section">
    <label>Choix des filtres <em>(appuyez sur ctrl pour choisir plusieurs éléments)</em></label>


    <div class="form-item">

        <select name="idFilt[]" id="idFilt" multiple>
            <?php //Creating the options with all the categories in the database
            foreach ($view['filterValueList'] as $filterValue):
            ?>
                <option class="filter-values" name="<?= $filterValue['filter_value'] ?>" value=<?= $filterValue['id_filter_value'] ?>> <?= $filterValue['filter_value'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <?php if (isset($view['errors']["idCat"])): ?>
        <p class="error"><?= $view['errors']["idCat"] ?></p>
    <?php endif; ?>

</div>

<script>
    let selector = document.getElementById("idFilt")
    let filterValues = document.querySelectorAll(".filter-values")
    filterValues.forEach((filt) => filt.addEventListener('mouseup', (e) => {
        let selector = e.target.parentNode

        if (selector.selectedOptions.namedItem(e.target.getAttribute("name"))) {
            console.log("salut")
        } else {
            console.log(selector.selectedOptions)
        }

    }, {
        capture: true,
        passive: true
    }))
</script>
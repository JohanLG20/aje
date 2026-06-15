let images = document.getElementById("images")
let addImage = document.getElementById("addImageButton")
//Listener for adding an image
addImage.addEventListener("click", () => {

    let imageNeededMessage = document.querySelector("#images")

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
    //Listener on the remove button for the file
    let listener = removeImageButton.addEventListener("click", (e) => {
        images.removeChild(e.target.parentNode)

        if (addImagesSection)
            //Removing the listener as the element doesn't exists anymore
            e.target.removeEventListener("click", listener)

    })

})

// ------------------- Updating available fiters if the category changes -------------
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
        fetch("?path=/filterRequest/getFvForCat/" + categorySelector.value)
            .then(r => {
                if (r.ok) {
                    return r.json()
                } else {
                    throw new Exception("Une erreur est survenue, impossible de charger les filtres. Vérifiez votre connexion internet ou le statut de la base de données")
                }
            })
            .then(filtersTypes => {
                for (let keys in filtersTypes) {
                    let filterDiv = createFilterValuesDiv(keys, filtersTypes[keys])
                    filterListDiv.appendChild(filterDiv)
                }
            })
            .catch((e) => {
                let errorMessage = document.createElement("p")
                errorMessage.classList.add("error")
                filterListDiv.appendChild(errorMessage)
            })
    }


})

function createFilterValuesDiv(filterName, filterValues) {
    let filterDiv = document.createElement("div")
    filterDiv.classList.add("form-item")

    let filterLabel = document.createElement("p")
    filterLabel.textContent = filterValues.label
    filterDiv.appendChild(filterLabel)

    //Creating the selector
    let filterSelector = document.createElement("select")
    filterSelector.setAttribute("name", `${filterName}[]`)
    filterSelector.setAttribute("multiple", true)
    filterDiv.appendChild(filterSelector)

    filterValues.values.forEach(val => {
        let option = document.createElement("option")
        option.textContent = val.filter_value
        option.setAttribute('value', val.id_choice_)
        filterSelector.appendChild(option)
    });

    filterDiv.appendChild(filterSelector)

    return filterDiv;
}


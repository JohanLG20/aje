function redirectSearch(event) {
    event.preventDefault()

    //Retrieving the datas
    const data = new FormData(event.target);

    if (data.get('q') !== "") {//Only launching a research if the input is not empty
        const mobileInput = document.getElementById('q-mobile');
        const desktopInput = document.getElementById('q-desktop');
        const query = (desktopInput && desktopInput.offsetParent !== null) ?
            desktopInput.value.trim() :
            mobileInput.value.trim();
        window.location.href = `?path=/search/${encodeURIComponent(query)}`;
    }

}
//This variable will track which top menu is currently openned
let lastOpenedTopMenu = null

//We check if a menu is already openned on the loading of the page
if(document.getElementById('connexionMenu').classList.contains('visible')){
    lastOpenedTopMenu = document.getElementById('connexionMenu')
}
else if(document.getElementById('basket').classList.contains('visible')){
    lastOpenedTopMenu = document.getElementById('basket')
}




//Burger listener
let burger = document.getElementById("burger")
burger.addEventListener("click", () => {
    let navMenu = document.getElementById("navMenu")
    if (navMenu.classList.contains("visible")) {
        lastOpenedTopMenu = null
        navMenu.classList.add('hidden')
        navMenu.classList.remove('visible')

    } else {
        closeLastOpennedTopMenu()
        lastOpenedTopMenu = navMenu
        navMenu.classList.remove('hidden')
        navMenu.classList.add('visible')

    }
})

//Handdling drop down menu
let dropDownTriggers = document.querySelectorAll(".navItem i")
for (let d of dropDownTriggers) {
    d.addEventListener("click", () => {
        //Retrieving the associated drop down menu
        let dropDownMenu = d.parentElement.querySelector(".dropDownMenu")

        if (dropDownMenu.classList.contains('visible')) {

            //Checking the target drop down menu is a mobile menu
            if (d.classList.contains("mobileMenuItem")) {
                //Checking if we clicked the search button or a sub menu item
                if (d.classList.contains('fa-minus')) { //We change the - to a + while closing the sub menu
                    d.classList.remove('fa-minus')
                    d.classList.add('fa-plus')
                } else { //We change the search icon a to a + while we close the menu
                    d.classList.remove('fa-magnifying-glass-minus')
                    d.classList.add('fa-magnifying-glass-plus')
                    lastOpenedTopMenu = null
                }

            } else {
                closeLastOpennedTopMenu()
                lastOpenedTopMenu = dropDownMenu
            }

            //We hide the requiered drop down menu
            dropDownMenu.classList.add('hidden')
            dropDownMenu.classList.remove('visible')

        } else {

            //Checking the target drop down menu is a mobile menu
            if (d.classList.contains("mobileMenuItem")) {
                //Checking if we clicked the search button or a sub menu item
                if (d.classList.contains('fa-plus')) { //We change the - to a + while closing the sub menu
                    d.classList.add('fa-minus')
                    d.classList.remove('fa-plus')
                } else { //We change the search icon a to a + while we close the menu
                    d.classList.add('fa-magnifying-glass-minus')
                    d.classList.remove('fa-magnifying-glass-plus')
                    closeLastOpennedTopMenu()
                    lastOpenedTopMenu = dropDownMenu

                }

            } else {
                closeLastOpennedTopMenu()
                lastOpenedTopMenu = dropDownMenu
            }

            //We display the requiered drop down menu
            dropDownMenu.classList.remove('hidden')
            dropDownMenu.classList.add('visible')
        }
    })
}

function closeLastOpennedTopMenu() {
    if (lastOpenedTopMenu !== null) {
        menuIcon = lastOpenedTopMenu.parentElement.querySelector('i')

        //Check if the last opened top menu is the search bar, if so we change the icon back to a +
        if (menuIcon.classList.contains('fa-magnifying-glass-minus')) {
            menuIcon.classList.remove('fa-magnifying-glass-minus')
            menuIcon.classList.add('fa-magnifying-glass-plus')
        }
        lastOpenedTopMenu.classList.remove('visible')
        lastOpenedTopMenu.classList.add('hidden')
    }

}

//Setting up the map
let map = L.map('map').setView([47.66711, -2.741946], 15);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

let marker = L.marker([47.66711, -2.741946]).addTo(map);
marker.bindPopup("<b>Magasin AJE</b><br><em>3 allée du Général-le-Troadec</em><br><em>56000, Vannes</em><br>Vente d'articles sportifs et de vêtements homme et femme").openPopup();
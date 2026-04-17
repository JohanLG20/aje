<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJE - vente d'équipements sportifs et vêtements</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="static/css/style.css">

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
</head>

<body>
    <header id="banner">
        <div id="baseMenu" class="container">
            <div id="burger" class="menuItem mobileMenuItem">
                <i class="fa-solid fa-bars menuIcon"></i>
            </div>
            <a href="index.php" class="brand">AJE</a>

            <div id="menuIcons" class="menuItem">
                <div class="navItem">
                    <i class="fa-solid fa-magnifying-glass-plus mobileMenuItem"></i>
                    <div class="dropDownMenu hidden topMenuIcon">
                        <form onsubmit="redirectSearch(event)">
                            <div class="searchForm">
                                <input type="search" id="q" name="q">
                                <button id="menuSearchIcon" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="index.php?action=contact" class="desktopMenuItem"><i class="fa-solid fa-circle-question menuIcon"></i></a>

                <div class="navItem">
                    <i class="fa-solid fa-basket-shopping menuIcon"></i>
                    <div class="dropDownMenu hidden topMenuIcon">
                        <?php require(TEMPLATES . '/basket.php') ?>
                    </div>
                </div>

                <div class="navItem">
                    <i class="fa-solid fa-user menuIcon "></i>

                    <?php require(TEMPLATES . '/login-form.php') ?>
                </div>

            </div>

        </div>
        <nav id="navMenu" class="hidden" aria-label="collapse">
            <div class="navItem">
                <a href="index.php?s=sports">Sports</a>
                <i class="fa-solid fa-plus mobileMenuItem"></i>

                <div class="dropDownMenu hidden">
                    <ul class="droppingList">
                        <li><a href="index.php?s=football">Football</a></li>
                        <li><a href="index.php?s=basketball">Basketball</a></li>
                        <li><a href="index.php?s=handball">Handball</a></li>
                        <li><a href="index.php?s=golf">Golf</a></li>
                        <li><a href="index.php?s=surf">Surf</a></li>
                    </ul>
                    <ul class="droppingList">
                        <li><a href="index.php?s=natation">Natation</a></li>
                        <li><a href="index.php?s=plongee">Plongée</a></li>
                        <li><a href="index.php?s=musculation">Musculation</a></li>
                        <li><a href="index.php?s=equitation">Équitation</a></li>
                        <li><a href="index.php?s=skateboard">Skateboard</a></li>
                    </ul>
                </div>

            </div>
            <div class="navItem">
                <a href="index.php?s=homme">Homme</a>
                <i class="fa-solid fa-plus mobileMenuItem"></i>
                <div class="dropDownMenu hidden">
                    <ul class="droppingList">
                        <li><a href="index.php?s=sweat+homme">Sweat</a></li>
                        <li><a href="index.php?s=jogging+homme">Jogging</a></li>
                        <li><a href="index.php?s=tee-shirt+homme">Tee-shirt</a></li>
                        <li><a href="index.php?s=pull+homme">Pull</a></li>
                        <li><a href="index.php?s=chaussures+homme">Chaussures</a></li>
                    </ul>
                </div>
            </div>
            <div class="navItem">
                <a href="index.php?s=femme">Femme</a>
                <i class="fa-solid fa-plus mobileMenuItem"></i>
                <div class="dropDownMenu hidden">
                    <ul class="droppingList">
                        <li><a href="index.php?s=sweat+femme">Sweat</a></li>
                        <li><a href="index.php?s=jogging+femme">Jogging</a></li>
                        <li><a href="index.php?s=tee-shirt+femme">Tee-shirt</a></li>
                        <li><a href="index.php?s=pull+femme">Pull</a></li>
                        <li><a href="index.php?s=chaussures+femme">Chaussures</a></li>
                    </ul>
                </div>
            </div>
            <div class="navItem">
                <a href="index.php?action=about">A&nbsp;Propos</a>
            </div>
            <div class="navItem">
                <a href="index.php?action=contact" class="mobileMenuItem">Contact</a>
            </div>
            <div class="navItem">
                <a href="index.php?action=myaccount" class="mobileMenuItem">Mon compte</a>
            </div>

        </nav>

    </header>

    <script>
        //This function is used to redirect the search towards the router. It correct the path to be compatible with the router taxonomy
        function redirectSearch(event) {
            event.preventDefault();
            console.log("test");
            const query = document.getElementById('q').value.trim();
            window.location.href = `index.php?path=/search/${encodeURIComponent(query)}`;
        }
    </script>

    <script defer>

        console.log(document.getElementById('connexionMenu') )
    //This variable will track which top menu is currently openned
    let lastOpenedTopMenu = document.getElementById('connexionMenu').classList.contains('visible') 
    ? document.getElementById('connexionMenu') : null        


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

    var map = L.map('map').setView([47.66711, -2.741946], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([47.66711, -2.741946]).addTo(map);
    marker.bindPopup("<b>Magasin AJE</b><br><em>3 allée du Général-le-Troadec</em><br><em>56000, Vannes</em><br>Vente d'articles sportifs et de vêtements homme et femme").openPopup();
</script>
<footer id="footer">
    <div id="footerContainer">
        <div id="footerMenu">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?s=sport">Sport</a></li>
                <li><a href="index.php?s=homme">Homme</a></li>
                <li><a href="index.php?s=femme">Femme</a></li>
                <li><a href="index.php?s=about">A Propos</a></li>

            </ul>
        </div>

        <hr class="mobileItem">

        <div id="footerContact">
            <h2>Une question, un soucis avec votre commande ?</h2>
            <a href="index.php?action=contact" class="btn">NOUS CONTACTER</a>
            <div>
                <p>Nos réseaux</p>
                <div id="socials">
                    <a href="https://instagram.com" rel="nofollow"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://x.com" rel="nofollow"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://facebook.com" rel="nofollow"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
        </div>

        <hr class="mobileItem">

        <div id="footerLocalisation">
            <h2>Nous retrouver</h2>
            <p>3 allée du Général-le-Troadec</p>
            <p>56000, Vannes</p>

            <div id="map"></div>
        </div>
    </div>


</footer>

</body>
<script>

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

</html>
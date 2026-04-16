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
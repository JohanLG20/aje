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
    <script src="static/js/slider.js" defer></script>
</head>

<body>
    <header id="banner">
        <div id="baseMenu">

            <div id="burger" class="menuItem mobileMenuItem">
                <i class="fa-solid fa-bars menuIcon"></i>
            </div>
            <a href="index.php" class="brand">AJE</a>
            <nav id="menuIcons">
                <!-- Version mobile : icône + dropdown -->
                <div class="navItem mobileMenuItem">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                    <div class="dropDownMenu hidden topMenuIcon">
                        <form onsubmit="redirectSearch(event)">
                            <div class="searchForm">
                                <input type="search" id="q-mobile" name="q">
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Version desktop : barre de recherche directement visible -->
                <div id="searchDesktop" class="navItem desktopMenuItem">
                    <form onsubmit="redirectSearch(event)">
                        <div class="searchForm">
                            <input type="search" id="q-desktop" name="q">
                            <button id="menuSearchIcon" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <a href="index.php?path=/contact/" class="desktopMenuItem"><i class="fa-solid fa-circle-question menuIcon"></i></a>

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

            </nav>
        </div>


        </div>
        <nav id="navMenu" class="hidden" aria-label="collapse">
            <div class="navItem">
                <a href="index.php?path=/search/sports">Sports</a>
                <i class="fa-solid fa-plus mobileMenuItem"></i>

                <div class="dropDownMenu hidden">
                    <ul class="droppingList">
                        <li><a href="index.php?path=/search/football">Football</a></li>
                        <li><a href="index.php?path=/search/basketball">Basketball</a></li>
                        <li><a href="index.php?path=/search/handball">Handball</a></li>
                        <li><a href="index.php?path=/search/golf">Golf</a></li>
                        <li><a href="index.php?path=/search/surf">Surf</a></li>
                    </ul>
                    <ul class="droppingList">
                        <li><a href="index.php?path=/search/natation">Natation</a></li>
                        <li><a href="index.php?path=/search/plongee">Plongée</a></li>
                        <li><a href="index.php?path=/search/musculation">Musculation</a></li>
                        <li><a href="index.php?path=/search/equitation">Équitation</a></li>
                        <li><a href="index.php?path=/search/skateboard">Skateboard</a></li>
                    </ul>
                </div>

            </div>
            <div class="navItem">
                <a href="index.php?path=/search/homme">Homme</a>
                <i class="fa-solid fa-plus mobileMenuItem"></i>
                <div class="dropDownMenu hidden">
                    <ul class="droppingList">
                        <li><a href="index.php?path=/search/sweat+homme">Sweat</a></li>
                        <li><a href="index.php?path=/search/jogging+homme">Jogging</a></li>
                        <li><a href="index.php?path=/search/tee-shirt+homme">Tee-shirt</a></li>
                        <li><a href="index.php?path=/search/pull+homme">Pull</a></li>
                        <li><a href="index.php?path=/search/chaussures+homme">Chaussures</a></li>
                    </ul>
                </div>
            </div>
            <div class="navItem">
                <a href="index.php?path=/search/femme">Femme</a>
                <i class="fa-solid fa-plus mobileMenuItem"></i>
                <div class="dropDownMenu hidden">
                    <ul class="droppingList">
                        <li><a href="index.php?path=/search/sweat+femme">Sweat</a></li>
                        <li><a href="index.php?path=/search/jogging+femme">Jogging</a></li>
                        <li><a href="index.php?path=/search/tee-shirt+femme">Tee-shirt</a></li>
                        <li><a href="index.php?path=/search/pull+femme">Pull</a></li>
                        <li><a href="index.php?path=/search/chaussures+femme">Chaussures</a></li>
                    </ul>
                </div>
            </div>
            <div class="navItem">
                <a href="index.php?path=/about/">A&nbsp;Propos</a>
            </div>
            <div class="navItem">
                <a href="index.php?path=/contact/" class="mobileMenuItem">Contact</a>
            </div>


        </nav>

    </header>
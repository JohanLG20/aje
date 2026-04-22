<?php require(LAYOUT . "/header.php"); ?>

<main class="container">
    <div id="homePage">

        <!-- Slider -->
        <div class="slider">
            <div id="sliderWrapper">
                <div id="leftButton" class="sliderButton" onclick="previousSlide()">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                </div>
                <div id="rightButton" class="sliderButton" onclick="nextSlide()">
                    <i class="fa-solid fa-circle-arrow-right"></i>
                </div>
                <div id="caption">
                    <p id="captionText">Découvrez notre gamme football</p>
                </div>
                <div id="sliderImages">
                    <div class="sliderImage" caption="Découvrez notre gamme football">
                        <a href="?path=/search/Football">
                            <img src="<?= IMAGE_LINK ?>/slider/slider1.webp" alt="Image de football">
                        </a>
                    </div>
                    <div class="sliderImage" caption="Essayez notre collection de sweat hyper confort">
                        <a href="?path=/search/Sweat">
                            <img src="<?= IMAGE_LINK ?>/slider/slider2.webp" alt="Image de sweat">
                        </a>
                    </div>
                    <div class="sliderImage" caption="Remettez vous au running grâce à nos baskets">
                        <a href="?path=/search/Basket">
                            <video src="static/video/running.webm" loading="lazy" autoplay loop></video>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <h2>Les nouveautés</h2>
        <div class="articleCardSlider">
            <?php foreach ($latestArticles as $art) {
                require(TEMPLATES . "/articleCard.php");
            } ?>
        </div>

        <h2>Les promotions</h2>
        <div class="articleCardSlider">
            <?php foreach ($promotions as $art) {
                require(TEMPLATES . "/articleCard.php");
            } ?>
        </div>
    </div>

</main>

<?php require(LAYOUT . "/footer.php"); ?>
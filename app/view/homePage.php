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
                <div id="captions">
                    <div id="caption1"></div>
                </div>
                <div id="sliderImages">
                    <div class="sliderImage">
                        <img src="<?= IMAGE_LINK ?>/slider/rando.png" alt="Image de randonnée">
                    </div>
                    <div class="sliderImage">
                        <img src="<?= IMAGE_LINK ?>/slider/slider2.png" alt="Image 2">
                    </div>
                    <div class="sliderImage">
                        <video src="static/video/running.webm" loading="lazy" autoplay loop></video>
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
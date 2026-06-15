<?php require(LAYOUT . "/header.php"); ?>

<main class="container">
    <div id="contactConfirmationPage">

        <div id="confirmationCard">

            <!-- Success icon -->
            <div id="confirmationIcon">
                <i class="fa-solid fa-paper-plane"></i>
            </div>

            <h1>Message envoyé !</h1>
            <p class="confirmationSubtitle">
                Merci de nous avoir contactés. Notre équipe vous répondra dans les plus brefs délais.
            </p>

            <!-- Confirmation infos -->
            <div id="confirmationInfos">
                <div class="confirmationInfoItem">
                    <i class="fa-solid fa-clock"></i>
                    <div>
                        <p class="infoLabel">Délai de réponse</p>
                        <p>Sous 48h ouvrées</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div id="confirmationActions">
                <a href="index.php" class="btn1">Retour à l'accueil</a>
                <a href="?path=/search/sport" class="btn2">Continuer mes achats</a>
            </div>

        </div>

    </div>
</main>

<?php require(LAYOUT . "/footer.php"); ?>
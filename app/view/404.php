<?php require(LAYOUT . "/header.php"); ?>

<main class="container">
    <div id="notFoundPage">

        <div id="notFoundCode">404</div>

        <div id="notFoundContent">
            <h1>Page introuvable</h1>
            <p>Oups ! La page que vous recherchez semble avoir disparu du terrain.</p>

            <div id="notFoundActions">
                <a href="index.php" class="btn1">Retour à l'accueil</a>
                <a href="?path=/contact" class="btn2">Nous contacter</a>
            </div>

            <div id="notFoundSuggestions">
                <p>Vous cherchiez peut-être :</p>
                <ul>
                    <li><a href="?path=/search/sport">Nos articles de sport</a></li>
                    <li><a href="?path=/search/homme">Vêtements homme</a></li>
                    <li><a href="?path=/search/femme">Vêtements femme</a></li>
                    <li><a href="?path=/contact/">À propos d'AJE</a></li>
                </ul>
            </div>
        </div>

    </div>
</main>

<?php require(LAYOUT . "/footer.php"); ?>
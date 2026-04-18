<?php require(LAYOUT . "/header.php"); ?>

<main class="container">
    <div id="searchResults">

        <div id="filterBar">
            <button id="filterButton" onclick="toggleFilterModal()">
                Filtrer et trier
            </button>
        </div>

        <div id="filterModal" class="hidden">
            <div id="filterModalContent">
                <button id="closeModal" onclick="toggleFilterModal()">✕</button>
                <h2>Filtrer et trier</h2>
                <form method="GET" action="" id="sortForm">
                    <!-- On conserve les autres paramètres GET déjà présents -->
                    <input type="hidden" name="path" value="/search/<?= htmlspecialchars($query) ?>">

                    <div class="filterSection">
                        <h3>Trier par prix</h3>
                        <label>
                            <input type="radio" name="price" value="ASC"
                                <?= isset($_GET['price']) && $_GET['price'] === 'ASC' ? 'checked' : '' ?>>
                            Prix croissant
                        </label>
                        <label>
                            <input type="radio" name="price" value="DESC"
                                <?= isset($_GET['price']) && $_GET['price'] === 'DESC' ? 'checked' : '' ?>>
                            Prix décroissant
                        </label>
                    </div>

                    <div class="filterSection">
                        <h3>Trier par ordre alphabétique</h3>
                        <label>
                            <input type="radio" name="alpha" value="ASC"
                                <?= isset($_GET['alpha']) && $_GET['alpha'] === 'ASC' ? 'checked' : '' ?>>
                            A → Z
                        </label>
                        <label>
                            <input type="radio" name="alpha" value="DESC"
                                <?= isset($_GET['alpha']) && $_GET['alpha'] === 'DESC' ? 'checked' : '' ?>>
                            Z → A
                        </label>
                    </div>

                    <button type="submit" class="btn1">Appliquer</button>
                </form>
            </div>
        </div>
        <div id="filterOverlay" class="hidden" onclick="toggleFilterModal()"></div>

        <div id="articleList">
            <?php foreach ($articles as $art): ?>
                <?php require(TEMPLATES . "/articleCard.php"); ?>
            <?php endforeach; ?>
        </div>

    </div>
</main>

<script>
    function toggleFilterModal() {
        document.getElementById('filterModal').classList.toggle('hidden');
        document.getElementById('filterModal').classList.toggle('visible');
        document.getElementById('filterOverlay').classList.toggle('hidden');
        document.getElementById('filterOverlay').classList.toggle('visible');
    }

    function applyFilters() {
        toggleFilterModal();
    }
</script>

<?php require(LAYOUT . "/footer.php"); ?>
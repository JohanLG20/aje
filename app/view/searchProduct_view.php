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
                <form method="GET" id="filterForm">
                    <input type="hidden" name="path" value="/search/<?= htmlspecialchars($query) ?>">

                    <!-- Tri par prix -->
                    <div class="filterSection">
                        <h3>Trier par prix</h3>
                        <label>
                            <input type="radio" name="price" value="ASC"
                                <?= isset($_GET['price']) && $_GET['price'] === 'ASC' ? 'checked' : '' ?>>
                            Croissant
                        </label>
                        <label>
                            <input type="radio" name="price" value="DESC"
                                <?= isset($_GET['price']) && $_GET['price'] === 'DESC' ? 'checked' : '' ?>>
                            Décroissant
                        </label>
                    </div>

                    <!-- Tri alphabétique -->
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

                    <!-- Marques -->
                    <?php if (!empty($filters['brands'])): ?>
                        <div class="filterSection">
                            <h3>Marques</h3>
                            <?php foreach ($filters['brands'] as $brand): ?>
                                <label>
                                    <input type="checkbox" name="filters[brand][]" value="<?= htmlspecialchars($brand) ?>"
                                        <?= isset($_GET['filters']['brand']) && in_array($brand, $_GET['filters']['brand']) ? 'checked' : '' ?>>
                                    <?= htmlspecialchars($brand) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Catégories -->
                    <?php if (!empty($filters['categories'])): ?>
                        <div class="filterSection">
                            <h3>Catégories</h3>
                            <?php foreach ($filters['categories'] as $category): ?>
                                <label>
                                    <input type="checkbox" name="filters[category][]" value="<?= htmlspecialchars($category) ?>"
                                        <?= isset($_GET['filters']['category']) && in_array($category, $_GET['filters']['category']) ? 'checked' : '' ?>>
                                    <?= htmlspecialchars($category) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Modalités dynamiques -->
                    <?php if (!empty($filters['modalities'])): ?>
                        <?php foreach ($filters['modalities'] as $label => $modality): ?>
                            <div class="filterSection">
                                <h3><?= htmlspecialchars($label) ?></h3>
                                <?php foreach ($modality as $choice): ?>
                                    <label>
                                        <input type="checkbox"
                                            name="filters[<?= $choice['id_filter_type'] ?>][]"
                                            value="<?= $choice['id_choice'] ?>"
                                            <?= isset($_GET['filters'][$choice['id_filter_type']]) && in_array($choice['id_choice'], $_GET['filters'][$choice['id_filter_type']]) ? 'checked' : '' ?>>
                                        <?php if ($choice['hexa']): ?>
                                            <span style="display:inline-block; width:16px; height:16px; background-color:<?= htmlspecialchars($choice['hexa']) ?>; border-radius:50%;"></span>
                                        <?php endif; ?>
                                        <?= htmlspecialchars($choice['value']) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

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
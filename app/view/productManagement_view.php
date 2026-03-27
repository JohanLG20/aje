<?php require (LAYOUT . '/header.php'); ?>

<main>
    <h2><?= $view['operationLabel'] ?></h2>
    <form action="index.php?action=productmanagement&params=<?= $view['action'] ?>" method="post">
        <input type="text">
    </form>
</main>

<?php require (LAYOUT . '/footer.php'); ?>
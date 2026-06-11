<?php require(LAYOUT . '/header.php') ?>
<main class="container">
    <h2><?= $view['operationLabel'] ?></h2>
    <form action="?path=/usermanagement/<?= $view['action'] ?>" method="post">
        <!-- Last name -->
        <div class="form-item">
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="Votre nom"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['lastname']) ? $values['lastname'] : ($view['action'] == 'update' ? $view['lastname'] : '') ?>">
            <?php if (isset($view['errors']['lastname'])): ?>
                <p class="error"><?= $view['errors']['lastname'] ?></p>
            <?php endif; ?>
        </div>


        <!-- First name -->
        <div class="form-item">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" placeholder="Votre nom"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['firstname']) ? $values['firstname'] : ($view['action'] == 'update' ? $view['firstname'] : '') ?>">
            <?php if (isset($view['errors']['firstname'])): ?>
                <p class="error"><?= $view['errors']['firstname'] ?></p>
            <?php endif; ?>
        </div>


        <!-- Email -->
        <div class="form-item">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Votre mail"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['email']) ? $values['email'] : ($view['action'] == 'update' ? $view['email'] : '') ?>">
            <?php if (isset($view['errors']['email'])): ?>
                <p class="error"><?= $view['errors']['email'] ?></p>
            <?php endif; ?>
        </div>

        <!-- Phone Number -->
        <div class="form-item">
            <label for="phoneNumber">N° de téléphone</label>
            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Votre n° de téléphone"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['phoneNumber']) ? $values['phoneNumber'] : ($view['action'] == 'update' ? $view['phoneNumber'] : '') ?>">
            <?php if (isset($view['errors']['phoneNumber'])): ?>
                <p class="error"><?= $view['errors']['phoneNumber'] ?></p>
            <?php endif; ?>
        </div>

        <?php if ($view['action'] == "update"): //Only displays when trying to update a profil ?>
            <!-- Old password -->
            <div class="form-item">
                <label for="passwd">Votre ancien mot de passe</label>
                <p></p>
                <input type="password" name="oldPasswd" id="oldPasswd" placeholder="Votre mot de passe">
                <?php if (isset($view['errors']['oldPasswd'])): ?>
                    <p class="error"><?= $view['errors']['oldPasswd'] ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Password -->
        <div class="form-item">
            <label for="passwd">Mot de passe</label>
            <p></p>
            <input type="password" name="passwd" id="passwd" placeholder="Votre mot de passe">
            <?php if (isset($view['errors']['passwd'])): ?>
                <p class="error"><?= $view['errors']['passwd'] ?></p>
            <?php endif; ?>
        </div>

        <!-- Password confirmation -->
        <div class="form-item">
            <label for="passwdconf">Confirmation du mot de passe</label>
            <input type="password" name="passwdconf" id="passwdconf" placeholder="Confirmez votre mot de passe">
            <?php if (isset($view['errors']['passwdconf'])): ?>
                <p class="error"><?= $view['errors']['passwdconf'] ?></p>
            <?php endif; ?>
        </div>


        <!-- Ville -->
        <div class="form-item">
            <label for="city">Ville</label>
            <input type="text" name="city" id="city" placeholder="La ville où vous habitez"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['city']) ? $values['city'] : ($view['action'] == 'update' ? $view['city'] : '') ?>">
            <?php if (isset($view['errors']['city'])): ?>
                <p class="error"><?= $view['errors']['city'] ?></p>
            <?php endif; ?>
        </div>


        <!--Code postal -->
        <div class="form-item">
            <label for="postCode">Code postal</label>
            <input type="text" name="postCode" id="postCode" placeholder="Votre code postal"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['postCode']) ? $values['postCode'] : ($view['action'] == 'update' ? $view['postCode'] : '') ?>">
            <?php if (isset($view['errors']['postCode'])): ?>
                <p class="error"><?= $view['errors']['postCode'] ?></p>
            <?php endif; ?>
        </div>


        <!-- Adresse -->
        <div class="form-item">
            <label for="address">Adresse</label>
            <input type="text" name="address" id="address" placeholder="Votre adresse"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['address']) ? $values['address'] : ($view['action'] == 'update' ? $view['address'] : '') ?>">
            <?php if (isset($view['errors']['address'])): ?>
                <p class="error"><?= $view['errors']['address'] ?></p>
            <?php endif; ?>
        </div>



        <input type="hidden" name="form_submitted">
        <button type="submit" class="btn1"><?= explode(" ", $view['operationLabel'])[0] ?></button>

        <?php if (isset($view['operationResult'])) : ?>
            <p><?= $view['operationResult'] ?></p>
        <?php endif; ?>
    </form>

    <?php if ($view['action'] === "update"): ?>
        <button id="deleteButton">Supprimer mon compte</button>
    <?php endif; ?>
</main>

<script src="static/js/userManagement.js"></script>

<?php require(LAYOUT . '/footer.php') ?>
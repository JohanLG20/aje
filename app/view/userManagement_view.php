<?php require(LAYOUT . '/header.php') ?>
<main>
    <h2><?= $view['operationLabel'] ?></h2>
    <form action="index.php?action=signup" method="post">
        <!-- Last name -->
        <div class="form-item">
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="Votre nom"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['lastname']) ? $values['lastname'] : '' ?>">
        </div>
        <?php if (isset($view['errors']['lastname'])): ?>
            <p class="error"><?= $view['errors']['lastname'] ?></p>
        <?php endif; ?>

        <!-- First name -->
        <div class="form-item">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" placeholder="Votre nom"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['firstname']) ? $values['firstname'] : '' ?>">
        </div>
        <?php if (isset($view['errors']['firstname'])): ?>
            <p class="error"><?= $view['errors']['firstname'] ?></p>
        <?php endif; ?>

        <!-- Email -->
        <div class="form-item">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Votre mail"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['email']) ? $values['email'] : '' ?>">
        </div>
        <?php if (isset($view['errors']['email'])): ?>
            <p class="error"><?= $view['errors']['email'] ?></p>
        <?php endif; ?>

        <!-- Password -->
        <div class="form-item">
            <label for="passwd">Mot de passe</label>
            <input type="password" name="passwd" id="passwd" placeholder="Votre mot de passe">
        </div>

        <!-- Password confirmation -->
        <div class="form-item">
            <label for="passwdconf">Confirmation du mot de passe</label>
            <input type="password" name="passwdconf" id="passwdconf" placeholder="Confirmez votre mot de passe">
        </div>
        <?php if (isset($view['errors']['passwdconf'])): ?>
            <p class="error"><?= $view['errors']['passwdconf'] ?></p>
        <?php endif; ?>

        <!-- Ville -->
        <div class="form-item">
            <label for="city">Ville</label>
            <input type="text" name="city" id="city" placeholder="La ville où vous habitez">
        </div>
        <?php if (isset($view['errors']['city'])): ?>
            <p class="error"><?= $view['errors']['city'] ?></p>
        <?php endif; ?>

        <!--Code postal -->
        <div class="form-item">
            <label for="postCode">Code postal</label>
            <input type="text" name="postCode" id="postCode" placeholder="Votre code postal"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['postCode']) ? $values['postCode'] : '' ?>">
        </div>
        <?php if (isset($view['errors']['postCode'])): ?>
            <p class="error"><?= $view['errors']['postCode'] ?></p>
        <?php endif; ?>

        <!-- Adresse -->
        <div class="form-item">
            <label for="address">Adresse</label>
            <input type="text" name="address" id="address" placeholder="Votre adresse"
            value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['address']) ? $values['address'] : '' ?>">
        </div>
        <?php if (isset($view['errors']['address'])): ?>
            <p class="error"><?= $view['errors']['address'] ?></p>
        <?php endif; ?>


        <input type="hidden" name="form_submitted">
        <button type="submit" class="btn1">S'inscrire</button>

    </form>
</main>


<?php require(LAYOUT . '/footer.php') ?>
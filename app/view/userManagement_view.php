<?php require(LAYOUT . '/header.php') ?>
<main class="container">
    <h2><?= $view['operationLabel'] ?></h2>
    <form action="?path=/usermanagement/<?= $view['action'] ?>" method="post">
        <!-- Last name -->
        <div class="form-item">
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="Votre nom"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['lastname']) ? $values['lastname'] : '' ?>">
            <?php if (isset($view['errors']['lastname'])): ?>
                <p class="error"><?= $view['errors']['lastname'] ?></p>
            <?php endif; ?>
        </div>


        <!-- First name -->
        <div class="form-item">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" placeholder="Votre nom"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['firstname']) ? $values['firstname'] : '' ?>">
            <?php if (isset($view['errors']['firstname'])): ?>
                <p class="error"><?= $view['errors']['firstname'] ?></p>
            <?php endif; ?>
        </div>


        <!-- Email -->
        <div class="form-item">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Votre mail"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['email']) ? $values['email'] : '' ?>">
            <?php if (isset($view['errors']['email'])): ?>
                <p class="error"><?= $view['errors']['email'] ?></p>
            <?php endif; ?>
        </div>

        <!-- Phone Number -->
        <div class="form-item">
            <label for="phoneNumber">N° de téléphone</label>
            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Votre n° de téléphone"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['phoneNumber']) ? $values['phoneNumber'] : '' ?>">
            <?php if (isset($view['errors']['phoneNumber'])): ?>
                <p class="error"><?= $view['errors']['phoneNumber'] ?></p>
            <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="form-item">
            <label for="passwd">Mot de passe</label>
            <input type="password" name="passwd" id="passwd" placeholder="Votre mot de passe">
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
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['city']) ? $values['city'] : '' ?>">
            <?php if (isset($view['errors']['city'])): ?>
                <p class="error"><?= $view['errors']['city'] ?></p>
            <?php endif; ?>
        </div>


        <!--Code postal -->
        <div class="form-item">
            <label for="postCode">Code postal</label>
            <input type="text" name="postCode" id="postCode" placeholder="Votre code postal"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['postCode']) ? $values['postCode'] : '' ?>">
            <?php if (isset($view['errors']['postCode'])): ?>
                <p class="error"><?= $view['errors']['postCode'] ?></p>
            <?php endif; ?>
        </div>


        <!-- Adresse -->
        <div class="form-item">
            <label for="address">Adresse</label>
            <input type="text" name="address" id="address" placeholder="Votre adresse"
                value="<?= isset($_POST['form_submitted']) && !isset($view['errors']['address']) ? $values['address'] : '' ?>">
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

<script>
    let deleteButton = document.getElementById("deleteButton")
    if (deleteButton) {
        deleteButton.addEventListener("click", () => {
            if (confirm("Souhaitez vous réelement supprimer votre compte ?")) {
                //We create a form to send the informations    
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '?path=/usermanagement/delete';

                let formSubmitted = document.createElement('input');
                input.type = 'hidden';
                input.name = 'form_submitted';
                let accountDeleted = document.createElement('input');
                input.type = 'hidden';
                input.name = 'account_deleted';

                form.appendChild(formSubmitted);
                form.appendChild(accountDeleted);
                document.body.appendChild(form);
                form.submit();
            }
        })
    }
</script>

<?php require(LAYOUT . '/footer.php') ?>
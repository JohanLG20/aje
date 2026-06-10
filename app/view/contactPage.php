<?php require(LAYOUT . "/header.php") ?>
<main class="container">
    <div id="contactPage">
        <h1>Nous contacter</h1>
        <p>Une question ? Un problème avec votre commande ? N'hésitez pas à nous contacter !</p>

        <form method="POST" action="?path=/contact/send" id="contactForm">

            <div class="formRow">
                <div class="formGroup">
                    <label for="first_name">Prénom</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Votre prénom" required>
                </div>
                <div class="formGroup">
                    <label for="last_name">Nom</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Votre nom" required>
                </div>
            </div>

            <div class="formRow">
                <div class="formGroup">
                    <label for="mail">Adresse mail</label>
                    <input type="email" id="mail" name="mail" placeholder="Votre adresse mail" required>
                </div>
                <div class="formGroup">
                    <label for="phone">Numéro de téléphone</label>
                    <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone">
                </div>
            </div>

            <div class="formGroup">
                <label for="subject">Sujet</label>
                <select id="subject" name="subject" required>
                    <option value="" disabled selected>Veuillez sélectionner un sujet pour votre message</option>
                    <option value="order">Suivi de commande</option>
                    <option value="return">Retour ou échange</option>
                    <option value="refund">Remboursement</option>
                    <option value="product">Question sur un produit</option>
                    <option value="delivery">Problème de livraison</option>
                    <option value="payment">Problème de paiement</option>
                    <option value="account">Mon compte</option>
                    <option value="other">Autre</option>
                </select>
            </div>

            <div class="formGroup">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Écrivez votre message ici..." rows="6" required></textarea>
            </div>

            <div class="formGroup" id="gdprGroup">
                <label id="gdprLabel">
                    <input type="checkbox" id="gdpr" name="gdpr" onchange="toggleSubmit(this)">
                    J'accepte que mes données soient collectées à des fins d'évaluation de qualité
                </label>
            </div>

            <button type="submit" id="submitButton" class="btn1" disabled>Envoyer</button>

        </form>
    </div>
</main>

<script src="static/js/contact.js">

</script>

<?php require(LAYOUT . "/footer.php") ?>

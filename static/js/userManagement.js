let deleteButton = document.getElementById("deleteButtonUser")
if (deleteButton) {
    deleteButton.addEventListener("click", () => {
        if (confirm("Souhaitez vous réelement supprimer votre compte ?")) {
            //We create a form to send the informations    
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '?path=/usermanagement/delete';

            let formSubmitted = document.createElement('input');
            formSubmitted.type = 'hidden';
            formSubmitted.name = 'form_submitted';

            let accountDeleted = document.createElement('input');
            accountDeleted.type = 'hidden';
            accountDeleted.name = 'account_deleted';

            form.appendChild(formSubmitted);
            form.appendChild(accountDeleted);
            document.body.appendChild(form);
            form.submit();
        }
    })
}
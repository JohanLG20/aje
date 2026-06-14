function changeMainImage(thumbnail) {
    document.getElementById('mainImage').src = thumbnail.src;
    document.getElementById('mainImage').alt = thumbnail.alt;
    document.querySelectorAll('#thumbnails img').forEach(img => img.classList.remove('active'));
    thumbnail.classList.add('active');
}

//Creating the action to add the comment
let addCommentButton = document.querySelector("#addComment")
if (addCommentButton !== null) {
    addCommentButton.addEventListener("click", () => {
        let addSectionComment = document.querySelector('#addCommentSection')
        if (addSectionComment === null) {
            let commentForm = createAddCommentForm()
            commentSectionHeader.after(commentForm)
        }
    })
}

let modifyComment = document.querySelector('.editComment') //Retrieving all the comments


if (modifyComment !== null) {
    modifyComment.addEventListener("click", (e) => {
        let addSectionComment = document.querySelector('#addCommentSection')
        if (addSectionComment === null) {
            //Retrieving the id of the comment to modify.
            let commentId = e.currentTarget.parentNode.parentNode.parentNode.id
            //Retrieving the current comment to preload the form
            let currentComment = e.currentTarget.parentNode.parentNode.parentNode.querySelector('.commentText').textContent
            let commentForm = createModifyCommentForm(commentId, currentComment)
            commentSectionHeader.after(commentForm)
        }
    })
}


/*
Creates the form that allow an user to add comment on the article
*/
function createAddCommentForm() {
    let addCommentSection = document.createElement("div")
    addCommentSection.id = "addCommentSection"

    let addCommentForm = document.createElement("form")
    addCommentForm.action = "?path=/comment/add"
    addCommentForm.method = "POST"

    let addCommentFormTitle = document.createElement("h4")
    addCommentFormTitle.id = "addCommentFormTitle"
    addCommentFormTitle.textContent = "Ajouter un commentaire"

    let addCommentFormText = document.createElement("textarea")
    addCommentFormText.name = "comment"

    let addCommentFormSubmit = document.createElement("button")
    addCommentFormSubmit.classList.add('btn1')
    addCommentFormSubmit.type = "submit"
    addCommentFormSubmit.textContent = "Envoyer le commentaire"

    addCommentSection.append(addCommentForm)
    addCommentForm.append(addCommentFormTitle)
    addCommentForm.append(addCommentFormText)
    addCommentForm.append(addCommentFormSubmit)
    return addCommentSection
}

function createModifyCommentForm(idComment, currentComment) {

    let addCommentSection = document.createElement("section")
    addCommentSection.id = "addCommentSection"

    let addCommentForm = document.createElement("form")
    addCommentForm.action = "?path=/comment/modify/" + idComment
    addCommentForm.method = "POST"

    let addCommentFormTitle = document.createElement("h4")
    addCommentFormTitle.id = "addCommentFormTitle"
    addCommentFormTitle.textContent = "Modifier un commentaire"

    let addCommentFormText = document.createElement("textarea")
    addCommentFormText.name = "comment"
    addCommentFormText.textContent = currentComment

    let addCommentFormSubmit = document.createElement("button")
    addCommentFormSubmit.classList.add('btn1')
    addCommentFormSubmit.type = "submit"
    addCommentFormSubmit.textContent = "Envoyer le commentaire"

    let idArticle = document.createElement("input")
    idArticle.name = "idArticle"
    idArticle.type = "hidden"
    idArticle.value = 80

    addCommentSection.append(addCommentForm)
    addCommentForm.append(addCommentFormTitle)
    addCommentForm.append(addCommentFormText)
    addCommentForm.append(addCommentFormSubmit)
    addCommentForm.append(idArticle)
    return addCommentSection
}
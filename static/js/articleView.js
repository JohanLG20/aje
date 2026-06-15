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
    let commentSection = document.createElement("div")
    commentSection.id = "commentSection"

    let commentForm = document.createElement("form")
    commentForm.action = "?path=/comment/add"
    commentForm.method = "POST"

    let commentFormTitle = document.createElement("h4")
    commentFormTitle.id = "commentFormTitle"
    commentFormTitle.textContent = "Ajouter un commentaire"

    let commentFormText = document.createElement("textarea")
    commentFormText.name = "comment"

    let commentFormSubmit = document.createElement("button")
    commentFormSubmit.classList.add('btn1')
    commentFormSubmit.type = "submit"
    commentFormSubmit.textContent = "Envoyer le commentaire"

    let idArticle = document.createElement("input")
    idArticle.name = "idArticle"
    idArticle.type = "hidden"
    idArticle.value = document.querySelector(".product-page").id //Retrieving the id of the article

    commentSection.append(commentForm)
    commentForm.append(commentFormTitle)
    commentForm.append(commentFormText)
    commentForm.append(commentFormSubmit)
    commentForm.append(idArticle)
    return commentSection
}

function createModifyCommentForm(idComment, currentComment) {

    let commentSection = document.createElement("div")
    commentSection.id = "commentSection"

    let commentForm = document.createElement("form")
    commentForm.action = "?path=/comment/modify/" + idComment
    commentForm.method = "POST"

    let commentFormTitle = document.createElement("h4")
    commentFormTitle.id = "commentFormTitle"
    commentFormTitle.textContent = "Modifier un commentaire"

    let commentFormText = document.createElement("textarea")
    commentFormText.name = "comment"
    commentFormText.value = currentComment

    let commentFormSubmit = document.createElement("button")
    commentFormSubmit.classList.add('btn1')
    commentFormSubmit.type = "submit"
    commentFormSubmit.textContent = "Envoyer le commentaire"

    let idArticle = document.createElement("input")
    idArticle.name = "idArticle"
    idArticle.type = "hidden"
    idArticle.value = document.querySelector(".product-page").id //Retrieving the id of the article

    commentSection.append(commentForm)
    commentForm.append(commentFormTitle)
    commentForm.append(commentFormText)
    commentForm.append(commentFormSubmit)
    commentForm.append(idArticle)
    return commentSection
}
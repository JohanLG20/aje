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
            let commentForm = createCommentForm("Ajouter")
            commentSectionHeader.after(commentForm)
        }
    })
}

let modifyComment = document.querySelector('.editComment') //Retrieving all the comments

function createCommentForm(action, preloadedDatas = "") {
    let addCommentSection = document.createElement("div")
    addCommentSection.id = "addCommentSection"

    let addCommentForm = document.createElement("form")
    addCommentForm.action = "?path=/addComment/"
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
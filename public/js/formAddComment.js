function eventAddComment() {
    let parentId = this.parentNode.getAttribute('id');
    let myId = this.getAttribute('id');
    createForm(parentId, myId);
    this.style.display = "none";
}

function createForm (divFormElt, buttonAddElt) {
    let formElt = document.createElement("form");
    formElt.id = "addCommentForm";
    divFormElt.appendChild(formElt)
    let fieldset = document.createElement("fieldset");
    formElt.appendChild(fieldset);
    let contentElt = document.createElement("input");
    contentElt.type = "textarea";
    contentElt.placeholder = "Votre commentaire";
    fieldset.appendChild(contentElt);
    let buttonConfirm = document.createElement("input");
    buttonConfirm.type = "submit";
    buttonConfirm.id = "buttonConfirm";
    buttonConfirm.value = "Confirmer l'envois du commentaire";
    fieldset.appendChild(buttonConfirm);
    buttonConfirm.addEventListener("click", function eventConfirmCommentSubmission() {
        buttonAddElt.style.display = "block";
        formElt.style.display = "none";
    });
}
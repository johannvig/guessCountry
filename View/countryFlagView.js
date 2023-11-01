function showSuccessPopup() {
    const modal = document.getElementById("successPopup");
    modal.style.display = "block";
}


function closeSuccessPopup() {
    const modal = document.getElementById("successPopup");
    modal.style.display = "none";
}

function showFailPopup() {
    alert("Bonne réponse ! Passons au pays suivant.");
}
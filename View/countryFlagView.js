// Lorsque l'utilisateur clique sur le bouton d'indice
document.getElementById('showIndiceButton').addEventListener('click', function() {
    // Afficher les informations
    document.querySelector('.result-text').style.display = 'block';
    // Soumettre le formulaire pour décrémenter le nombre d'indices disponibles
    document.getElementById('indiceForm').submit();
});


function showSuccessPopup() {
    updateRightAnswer();
    const modal = document.getElementById("successPopup");
    modal.style.display = "block";
}

window.onclick = function(event) {
    const modal = document.getElementById("successPopup");
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

function showLoosePopup() {
    const modal = document.getElementById("LoosePopup");
    modal.style.display = "block";
}

function closePopup(element) {
    const modal = document.getElementById(element);
    modal.style.display = "none";
}
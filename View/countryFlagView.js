let rightAnswer = 0;
let life=5;

function updateRightAnswer() {
    rightAnswer++;
    document.getElementById("rightAnswerSpan").textContent = rightAnswer;
}

function LooseAHeart(){
    life--;
}

function showSuccessPopup() {
    updateRightAnswer();
    const modal = document.getElementById("successPopup");
    modal.style.display = "block";
}

function showLoosePopup() {
    const modal = document.getElementById("LoosePopup");
    modal.style.display = "block";
}

function closePopup(element) {
    const modal = document.getElementById(element);
    modal.style.display = "none";
}
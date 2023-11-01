
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">  
    <link rel="stylesheet" href="Style\level.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CountryCatcher</title>
</head>
<body>
    <main>
        <div id="hompage">
            
            <p>Number of right answer: <span id="rightAnswerSpan"></span></p>
            <h1>Which country is it ?</h1>
            <img src="<?php echo $flagImageUrl; ?>">

            <form action="" method="post">
                <label for="answer">Entrez quelque chose :</label>
                <input type="text" id="answer" name="answer">
                <input type="submit" value="Soumettre">
            </form>

            <div id="successPopup" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closePopup(successPopup)">&times;</span>
                Bonne réponse ! Passons au pays suivant.
            </div>

            <div id="LoosePopup" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closePopup(LoosePopup)">&times;</span>
                Pas de chance ! Vous n'avez plus de vie.
            </div>
    </div>
        </div>
        
    </main>

</body>
</html>

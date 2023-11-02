<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['indice'])) {
    $_SESSION['indice'] = 5; // valeur initiale
}
$indice = $_SESSION['indice'];

$showHint = false;

if (isset($_POST['showIndice'])) {
    $_SESSION['indice']--;
    $indice = $_SESSION['indice']; 
    $showHint = true; // Ajouté
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">  
    <link rel="stylesheet" href="Style\countryFlag.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CountryCatcher</title>
</head>
<body>
    <main>
        <div id="hompage">
    
            <?php
            echo "<p>Number of right answer: <span id='rightAnswerSpan'>" . $rightAnswer . "</span></p>";
            ?>
            <h1>Which country is it ?</h1>
            <img src="<?php echo $flagImageUrl; ?>">

            <form action="" method="post">
                <label for="answer">Entrez quelque chose :</label>
                <input type="text" id="answer" name="answer">
                <input type="submit" value="Soumettre">
            </form>

            <?php if ($indice > 0): ?>
            <form id="indiceForm" action="" method="post" style="display: none;">
                <input type="hidden" name="showIndice" value="1">
            </form>
            <button id="showIndiceButton">Montrer un indice</button>
            <?php else: ?>
                <p>Vous n'avez plus d'indices disponibles.</p>
            <?php endif; ?>



            <p class="result-text" style="display: <?= $showHint ? 'block' : 'none'; ?>;">
                Ce pays se trouve en
                <span class="result-continent"><?= $randomCountry->region ?></span> et a pour capitale
                <span class="result-capital"><?= $randomCountry->capital[0] ?></span>. 
            </p>



            <div id="successPopup" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closePopup()">&times;</span>
                    Bonne réponse ! Passons au pays suivant.
                </div>
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

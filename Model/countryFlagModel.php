<?php

function getRandomCountry($countries) {
    $randomIndex = rand(0, count($countries) - 1);
    return $countries[$randomIndex];
}

// Démarrage de la session si elle n'est pas déjà démarrée
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Récupérez la liste des pays
$url = "https://restcountries.com/v3.1/all";
$response = file_get_contents($url);
$countries = json_decode($response);

if (!isset($_SESSION['randomCountry'])) {
    $_SESSION['randomCountry'] = getRandomCountry($countries);
}

$randomCountry = $_SESSION['randomCountry'];


$life = isset($_SESSION['life']) ? $_SESSION['life'] : 5;
$rightAnswer = isset($_SESSION['rightAnswer']) ? $_SESSION['rightAnswer'] : 0;



if(isset($_POST['answer'])) {

    if($life > 0) {
        function removeAccents($string) {
            return iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        }
        
        // Convertir les chaînes en minuscules, supprimer les espaces et les accents
        if (isset($randomCountry->name->nativeName->fra)) {
            $cleanedCountryName = strtolower(str_replace(' ', '', removeAccents($randomCountry->name->nativeName->fra->common)));
        } else {
            $cleanedCountryName = strtolower(str_replace(' ', '', removeAccents($randomCountry->name->common)));
        }
        
        $cleanedAnswer = strtolower(str_replace(' ', '', removeAccents($_POST['answer'])));
        
        if($cleanedCountryName === $cleanedAnswer) {
            echo "bonne réponse chacal";
            $rightAnswer++;
            
        } else { 
            echo "".$cleanedCountryName;
            echo "".$cleanedAnswer;
            $life--;
            echo "mauvaise réponse chacal";
            echo '<script>showLoosePopup();</script>';
            
        }
    } else {
        echo "loose réponse chacal";
        echo '<script>LooseAHeart();</script>';
    }

    unset($_SESSION['showHint']);

    // Enregistrez la valeur mise à jour de $rightAnswer dans la session
    $_SESSION['rightAnswer'] = $rightAnswer;

    // Générer un nouveau pays après avoir vérifié la réponse
    $_SESSION['randomCountry'] = getRandomCountry($countries);
    $randomCountry = $_SESSION['randomCountry'];
}

try {
    $countryUrl = "https://restcountries.com/v3.1/name/". urlencode($randomCountry->name->common);
    $countryResponse = json_decode(file_get_contents($countryUrl));

    if (isset($countryResponse[0]) && isset($countryResponse[0]->flags)) {
        $flagImageUrl = $countryResponse[0]->flags->png;}
} catch (Exception $e) {

    // Générer un nouveau pays en cas d'erreur
    $_SESSION['randomCountry'] = getRandomCountry($countries);
    $randomCountry = $_SESSION['randomCountry'];

    // Actualisez la page pour obtenir le nouveau drapeau
    header("Refresh:0");
}

?>




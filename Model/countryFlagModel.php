<?php
$url = "https://restcountries.com/v3.1/all";
$response = file_get_contents($url);
$countries = json_decode($response);

// 2. Sélectionner un pays aléatoire
$randomIndex = rand(0, count($countries) - 1);
$randomCountry = $countries[$randomIndex];

// 3. Afficher les détails du pays sélectionné
echo "Pays : " . $randomCountry->name->common . "<br>";

function checkanswer() {
    global $randomCountry;  // Utilisez le mot-clé global pour accéder à la variable en dehors de la fonction

    if(isset($_POST['answer'])) {  // Vérifiez si le formulaire a été soumis
        if($randomCountry->name->common === $_POST['answer']){
            if(life > 0) {
                echo '<script>showSuccessPopup();</script>';
                // Redirigez vers la même page pour obtenir un nouveau pays
                header("Refresh:0; url= /guesscountry/index?action=guess_country_flag.php");  // Remplacez 'your_current_page.php' par le nom de votre page actuelle
                exit();
            } else {
                echo '<script>showLoosePopup();</script>';
            }
        }
        else{
            echo '<script>LooseAHeart();</script>';
        }
    }
}

// 4. Obtenez une image du drapeau 
$countryUrl = "https://restcountries.com/v3.1/name/{$randomCountry->name->common}";
$countryResponse = json_decode(file_get_contents($countryUrl));

if (isset($countryResponse[0]) && isset($countryResponse[0]->flags)) {
    $flagImageUrl = $countryResponse[0]->flags->png;; 
} else {
    // Gérer l'erreur si le drapeau n'est pas trouvé
    echo "Erreur lors de la récupération du drapeau";
    exit();
}


?>



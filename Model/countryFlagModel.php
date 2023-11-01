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
    if($randomCountry->name->common===$_POST['answer']){
        echo '<script>showSuccessPopup();</script>';
    }
    else{
        echo '<script>showFailPopup();</script>';
    }
}
?>
<?php


// Démarrage de la session si elle n'est pas déjà démarrée
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}




function getTotalProducts() {
    $conn = new mysqli("localhost", "root", "", "base_de_donnee_bioclipse");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query_count = "SELECT COUNT(*) as total_products FROM PRODUIT WHERE Id_compte = ?";
    $stmt_count = $conn->prepare($query_count);
    $stmt_count->bind_param("i", $_SESSION["Id_compte"]);  // Assuming Id_compte is stored in session
    $stmt_count->execute();

    $result = $stmt_count->get_result();
    $row = $result->fetch_assoc();
    return $row['total_products'];
}

function getCurrentPage() {
    return isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
}

function getTotalPages($perPage = 13) {
    $conn = new mysqli("localhost", "root", "", "base_de_donnee_bioclipse");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $totalProducts = getTotalProducts();
    return max(1, ceil($totalProducts / $perPage));
}


function getProductsByPage($page = 1, $perPage = 13) {

    ob_start(); // Commencer la sortie tampon
    $conn = new mysqli("localhost", "root", "", "base_de_donnee_bioclipse");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_POST['sort'])) {
        $sortOrder = ($_POST['sort'] === 'cheapest') ? 'ASC' : 'DESC';
    } else {
        $sortOrder = 'DESC'; // Default order
    }
    $offset = ($page - 1) * $perPage;
    $query = "SELECT * FROM PRODUIT WHERE Id_compte = ? ORDER BY Prix_produit $sortOrder LIMIT $perPage OFFSET $offset";
    $stmt = $conn->prepare($query);  // Notez le $ ajouté devant conn
    $stmt->bind_param('i', $_SESSION["Id_compte"]);
    if ($stmt->execute()) {
        ob_end_flush(); // Termine et envoie le tampon de sortie
        $result = $stmt->get_result();
        return $result;
        header("Refresh:0");  
    } else {
        echo "Erreur: " . $stmt->error;
    }
}

function getProductsByPageByName($productName, $page = 1, $perPage = 13) {
    ob_start(); // Commencer la sortie tampon
    
    $conn = new mysqli("localhost", "root", "", "base_de_donnee_bioclipse");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['product_name'])) {
        if (isset($_POST['sort'])) {
            $sortOrder = ($_POST['sort'] === 'cheapest') ? 'ASC' : 'DESC';
        } else {
            $sortOrder = 'ASC'; // Default order
        }        
        $productName = "%" . $_POST['product_name'] . "%";
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM PRODUIT WHERE Id_compte = ? AND Nom_produit LIKE ? ORDER BY Prix_produit $sortOrder LIMIT $perPage OFFSET $offset";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('is', $_SESSION["Id_compte"], $productName); 
        
        if ($stmt->execute()) {
            ob_end_flush(); // Termine et envoie le tampon de sortie
            $result = $stmt->get_result();
            return $result;
            header("Refresh:0");  
        } else {
            echo "Erreur: " . $stmt->error;
        }

        
    }
}



?>
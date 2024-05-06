<?php
// Détails de la connexion à la base de données
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pfe";

// Connexion à la base de données
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification de l'ID du fichier à supprimer
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $file_id = $_GET['id'];
    
    // Suppression du fichier de la base de données
    $sql = "DELETE FROM files WHERE id = $file_id";
    if ($conn->query($sql) === TRUE) {
        // Suppression réussie, vous pouvez également supprimer le fichier du système de fichiers ici si nécessaire
        header("Location: download-file.php"); // Redirection vers la page principale après la suppression
        exit();
    } else {
        echo "Erreur lors de la suppression du fichier: " . $conn->error;
    }
} else {
    echo "ID de fichier non spécifié.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
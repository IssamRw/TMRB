<?php
// Inclusion du fichier de fonctions
require '../configuration/function.php';

// Vérification et récupération de l'ID passé en paramètre dans l'URL
$paraRestultId = checkParamId('id');

// Vérifie si l'ID récupéré est un nombre
if(is_numeric($paraRestultId)) {
    // Validation de l'ID
    $categorieId = validate($paraRestultId);
    
    // Récupération des informations de la catégorie par son ID
    $categorie = getById('categorie', $categorieId);

    // Vérifie le statut de la catégorie
    if($categorie['status'] == 200){
        // Suppression de la catégorie
        $response = delete('categorie', $categorieId);

        // Vérification si la suppression a réussi
        if($response){
            // Redirection avec un message de succès
            redirect('categorie.php', 'Suppression du projet réussie');
        } else {
            // Redirection avec un message d'erreur
            redirect('categorie.php', 'Quelque chose s\'est mal passé lors de la suppression');
        }
    } else {
        // Redirection avec un message d'erreur
        redirect('categorie.php', $categorie['message']);
    }
} else {
    // Redirection avec un message d'erreur
    redirect('categorie.php', 'Quelque chose s\'est mal passé lors de la récupération de l\'identifiant');
}
?>

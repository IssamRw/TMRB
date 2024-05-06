<?php
require '../configuration/function.php';

// Vérification et récupération de l'ID passé en paramètre
$paraRestultId = checkParamId('id');

// Vérifie si l'ID récupéré est un nombre
if(is_numeric($paraRestultId)) {
    $adminId = validate($paraRestultId); // Validation de l'ID
    $admin = getById('admins', $adminId); // Récupération des informations de l'administrateur par son ID

    // Vérifie le statut de l'administrateur
    if($admin['status'] == 200){

        // Suppression de l'administrateur
        $adminDeleteRes = delete('admins', $adminId);

        // Vérification si la suppression a réussi
        if($adminDeleteRes){
            redirect('admins.php', 'Suppression de l\'administrateur réussie'); // Redirection avec un message de succès
        } else {
            redirect('admins.php', 'Quelque chose s\'est mal passé lors de la suppression'); // Redirection avec un message d'erreur
        }
    } else {
        redirect('admins.php', $admin['message']); // Redirection avec un message d'erreur
    }
} else {
    redirect('admins.php', 'Quelque chose s\'est mal passé lors de la récupération de l\'identifiant'); // Redirection avec un message d'erreur
}
?>

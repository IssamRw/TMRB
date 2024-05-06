<?php
// Vérifie si une session est active
if(isset($_SESSION['loggedIn']))
{
    // Récupère et valide l'email de l'utilisateur connecté
    $email = validate($_SESSION['loggedInUser']['email']);

    // Requête pour récupérer les données de l'administrateur connecté
    $query = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    // Vérifie s'il y a des résultats correspondants à l'email de l'utilisateur
    if(mysqli_num_rows($result) == 0){
        // Si aucun résultat n'est trouvé, déconnecte l'utilisateur et le redirige vers la page de connexion avec un message d'accès refusé
        logoutSession();
        redirect('../login_register.php','Accès refusé');
    }
    else{
        // Récupère les données de l'administrateur
        $row = mysqli_fetch_assoc($result);

        // Vérifie si le compte de l'administrateur est banni
        if($row['is_ban'] == 1){
            // Si le compte est banni, déconnecte l'utilisateur et le redirige vers la page de connexion avec un message approprié
            logoutSession();
            redirect('../login_register.php','Votre compte a été banni ! Veuillez contacter l\'administrateur');
        }
    }
}
else{
    // Si aucune session n'est active, redirige l'utilisateur vers la page de connexion avec un message invitant à se connecter
    redirect('../login_register.php','Connectez-vous pour continuer...');
}
?>

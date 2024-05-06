<?php
 if(isset($_SESSION['loggedIn']))
{
$email = validate($_SESSION['loggedInUser']['email']);
$query= "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 0){
    logoutSession();
    redirect('../login_register.php','Accès refusé');

}
else{
    $row = mysqli_fetch_assoc($result);
    if($row['is_ban'] == 1){
        logoutSession();
        redirect('../login_register.php','Votre compte a été banni ! Veuillez contacter l"administrateur ');
    }
}

}else{
 redirect('../login_register.php','Connectez-vous pour continuer...');

}
?>
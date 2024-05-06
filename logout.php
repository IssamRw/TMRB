<?php
require'configuration/function.php';

if(isset($_SESSION['loggedIn'])){
logoutSession();
redirect('login_register.php','Déconnexion réussie');

}



?>
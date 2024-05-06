<?php

require 'configuration/function.php';

if (isset($_POST['loginbtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email != '' && $password != '') {

        // Authenticate user
        $query = "SELECT * FROM admins WHERE email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            // Verify password
            if (!password_verify($password, $hashedPassword)) {
                redirect('login_register.php', 'Mot de passe invalide');
            }

            // Check if the account is banned
            if ($row['is_ban'] == 1) {
                redirect('login_register.php', 'Votre compte a été banni. Contactez le support');
            }

            // Set session variables for user
            $_SESSION['loggedIn'] = true;
            if ($row['usertype'] == 'admin') {
                $_SESSION['auth_role'] = 'admin';
            } else {
                $_SESSION['auth_role'] = 'user';
            }
            $_SESSION['loggedInUser'] = [
                'user_id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
            ];

            // Redirect based on role
            if ($_SESSION['auth_role'] == 'admin') {
                redirect('admin/index.php', 'Connexion réussie en tant qu"administrateur');
            } else {
                redirect('user/index.php', 'Connexion réussie en tant que responsable');
            }
        } else {
            // If no user found
            redirect('login_register.php', 'Adresse e-mail ou mot de passe invalide');
        }
    } else {
        redirect('login_register.php', 'Tous les champs sont obligatoires');
    }
}
?>

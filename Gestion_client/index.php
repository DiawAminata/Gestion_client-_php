<?php
require_once 'config/database.php';

session_start();

$message = '';

// Gestion des connexions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification pour les super administrateurs
    $tableSuperAdmin = "SELECT * FROM superAdmin WHERE email = :email";
    $requete = $db->prepare($tableSuperAdmin);
    $requete->bindParam(':email', $email);
    $requete->execute();
    $superAdmin = $requete->fetch();

    if ($superAdmin) {
        if ($superAdmin['mot_de_passe'] === $password) {
            $_SESSION['id_superAdmin'] = $superAdmin['id'];
            $_SESSION['email'] = $superAdmin['email'];
            header('Location: app/views/homeSuperAdmin.php');
            exit;
        } else {
            $message = "Mot de passe incorrect pour le super administrateur.";
        }
    } else {
        // Vérification pour les administrateurs
        $tableAdmin = "SELECT * FROM admin WHERE email = :email";
        $requete = $db->prepare($tableAdmin);
        $requete->bindParam(':email', $email);
        $requete->execute();
        $admin = $requete->fetch();

        if ($admin) {
            if ($admin['mot_de_passe'] === $password) {
                $_SESSION['id_admin'] = $admin['id'];
                $_SESSION['email'] = $admin['email'];
                header('Location: app/views/homeAdmin.php');
                exit;
            } else {
                $message = "Mot de passe incorrect pour l'administrateur.";
            }
        } else {
            $message = "Adresse e-mail ou mot de passe incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Bienvenue!</h1>
        <p><b>Veuillez entrer vos identifiants pour accéder aux fonctionnalités de l'application</b></p>
        <form action="" method="POST">
            <input type="hidden" name="action" value="login">
            <label for="email">Adresse e-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>
        
        <?php if ($message) : ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>
    </div>
</body>
</html>


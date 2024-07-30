<?php
require_once '../controllers/AdminController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $controller = new AdminController();
    $controller->ajouterAdmin($nom, $email, $mot_de_passe);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer un nouveau admin</title>
    <link rel="stylesheet" href="../../public/css/create.css">
</head>
<body>
    <div class="arriere-plan">
        <img src="../../public/images/create.jpg" alt="Image">
    </div>

    <div class="formulaire-container">
        <h1>Créer un nouveau admin</h1>
        <form  method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>

            <input type="submit" value="Créer">
        </form>
    </div>
    <script src="../../public/js/script.js"></script>
</body>
</html>

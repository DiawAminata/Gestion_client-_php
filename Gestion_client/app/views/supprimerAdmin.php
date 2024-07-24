<?php
require_once '../controllers/adminController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $controller = new AdminController();
    $controller->supprimerAdmin($id);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer Administrateur</title>
</head>
<body>
    <h1>Supprimer un Administrateur</h1>
    <form method="get">
        <label for="id">ID de l'Administrateur :</label>
        <input type="number" id="id" name="id" required><br>
        <input type="submit" value="Supprimer">
    </form>
</body>
</html>

<?php
require_once '../controllers/AdminController.php';

$controller = new AdminController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $controller->modifierAdmin($id, $nom, $email, $mot_de_passe);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $admin = $controller->getAdminById($id);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Administrateur</title>
    <link rel="stylesheet" href="../../public/css/showadmin.css">
</head>
<body>
    <h1>Modifier un Administrateur</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($admin['id']); ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($admin['nom']); ?>" required><br>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required><br>
        <label for="mot_de_passe">Mot de Passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>
        <input type="submit" value="Modifier">
    </form>
</body>
</html>

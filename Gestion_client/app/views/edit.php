<?php
require_once('../controllers/ClientController.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $controller = new ClientController();
    $client = $controller->get($id);
} else {
    die("ID du client non spécifié.");
}

if (!$client) {
    die("Client non trouvé.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $sexe = $_POST['sexe'];
    $statut = $_POST['statut'];

    $controller->updateClient($id, $nom, $adresse, $telephone, $email, $sexe, $statut);
    header("Location: show.php?id=$id");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier le client</title>
    <link rel="stylesheet" href="../../public/css/edit.css">
</head>
<body>
    <h1 class="client-heading">Modifier le client</h1>
    <div class="formulaire">
        <form method="post">
            <label>Nom:</label>
            <input type="text" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>"><br>
            <label>Adresse:</label>
            <input type="text" name="adresse" value="<?php echo htmlspecialchars($client['adresse']); ?>"><br>
            <label>Téléphone:</label>
            <input type="text" name="telephone" value="<?php echo htmlspecialchars($client['telephone']); ?>"><br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>"><br>
            <label>Sexe:</label>
            <input type="text" name="sexe" value="<?php echo htmlspecialchars($client['sexe']); ?>"><br>
            <label>Statut:</label>
            <input type="text" name="statut" value="<?php echo htmlspecialchars($client['statut']); ?>"><br>
            <input type="submit" value="Modifier">
        </form>
        <a href="../views/homeAdmin.php?id=<?php echo $id; ?>">Annuler</a>
    </div>
   
</body>
</html>

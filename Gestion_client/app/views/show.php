<?php
require_once('../controllers/ClientController.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new ClientController();
    $client = $controller->get($id);
} else {
    die("ID du client non spécifié.");
}

if (!$client) {
    die("Client non trouvé.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du client</title>
    <link rel="stylesheet" href="../../public/css/show.css">
</head>
<body>
    <div class="background"></div>
    <div class="client-details-container">
        <h1>Détails du client</h1>
        <div class="detail-item">
            <span class="label">ID :</span>
            <span class="value">5</span>
        </div>
        <div class="detail-item">
            <span class="label">Nom :</span>
            <span class="value">dsfghj</span>
        </div>
        <div class="detail-item">
            <span class="label">Adresse :</span>
            <span class="value">mermoz</span>
        </div>
        <div class="detail-item">
            <span class="label">Téléphone :</span>
            <span class="value">+221 0777326129</span>
        </div>
        <div class="detail-item">
            <span class="label">Email :</span>
            <span class="value">daboaminata26@gmail.com</span>
        </div>
        <div class="detail-item">
            <span class="label">Sexe :</span>
            <span class="value"></span>
        </div>
        <div class="detail-item">
            <span class="label">Statut :</span>
            <span class="value">actif</span>
        </div>
        <a class="back-link" href="../views/homeAdmin.php">Retour à la liste</a>
    </div>
</body>
</html>


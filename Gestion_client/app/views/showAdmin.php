<?php
require_once '../controllers/AdminController.php';

$controller = new AdminController();
$admins = $controller->getAllAdmins();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Administrateurs</title>
    <link rel="stylesheet" href="../../public/css/styleadmin.css">
    
</head>
<body>
    <h1>Liste des Administrateurs</h1>
    <a href="ajouterAdmin.php" class="button add">Ajouter un Administrateur</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?php echo htmlspecialchars($admin['id']); ?></td>
                    <td><?php echo htmlspecialchars($admin['nom']); ?></td>
                    <td><?php echo htmlspecialchars($admin['email']); ?></td>
                    <td>
                        <a href="modifierAdmin.php?id=<?php echo htmlspecialchars($admin['id']); ?>" class="button edit">Modifier</a>
                        <a href="supprimerAdmin.php?id=<?php echo htmlspecialchars($admin['id']); ?>" class="button delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php


require_once '../../config/database.php';
require_once '../../app/controllers/ClientController.php';

// Instancier le contrôleur ClientController
$clientController = new ClientController();

// Vérifier les paramètres de l'URL pour appeler les actions appropriées
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire de création de client
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $sexe = $_POST['sexe'];
        $statut = $_POST['statut'];

        // Appeler la méthode createClient() du contrôleur pour ajouter le client
        $clientController->createClient($nom, $adresse, $telephone, $email, $sexe, $statut);

        header("location: traitement.php");
        exit();

    } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire de modification de client
        $id = $_GET['id'];
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $sexe = $_POST['sexe'];
        $statut = $_POST['statut'];

        // Appeler la méthode updateClient() du contrôleur pour mettre à jour le client
        $clientController->updateClient($id, $nom, $adresse, $telephone, $email, $sexe, $statut);

        header("location: traitement.php");
        exit();

    } elseif ($action === 'edit' && isset($_GET['id'])) {
        // Récupérer l'ID du client à afficher
        $id = $_GET['id'];
            
        // Appeler la méthode get() du contrôleur pour obtenir le client par son ID
        $client = $clientController->get($id);
        require_once 'edit.php';

    } elseif ($action === 'delete' && isset($_GET['id'])) {
        // Récupérer l'ID du client à supprimer
        $id = $_GET['id'];

        // Appeler la méthode deleteClient() du contrôleur pour supprimer le client
        $clientController->deleteClient($id);
        header("location: traitement.php");
        exit();

    } elseif ($action === 'show' && isset($_GET['id'])) {
        // Récupérer l'ID du client à afficher
        $id = $_GET['id'];
    
        // Appeler la méthode get() du contrôleur pour obtenir le client par son ID
        $client = $clientController->get($id);
    
        if ($client) {
            // Rediriger vers show.php avec l'ID du client
            require_once 'show.php';
        } else {
            echo "Client non trouvé";
            require_once 'homeAdmin.php';
        }

    } elseif ($action === 'print') {
        // Appeler la méthode printList() du contrôleur pour imprimer la liste des clients
        $clientController->printList();
        exit();

    } elseif ($action === 'export_csv') {
        // Appeler la méthode exportCSV() du contrôleur pour exporter la liste des clients au format CSV
        $clientController->exportCSV();
        exit();

    } elseif ($action === 'export_pdf') {
        // Appeler la méthode exportPDF() du contrôleur pour exporter la liste des clients au format PDF
        $clientController->exportPDF();
        exit();

    } elseif ($action === 'report') {
        // Appeler la méthode generateReport() du contrôleur pour générer le rapport sur les clients
        $clientController->generateReport();
        exit();

    } elseif ($action === 'filter' && isset($_GET['params'])) {
        // Récupérer les paramètres de filtrage (par exemple, le nom ou l'adresse)
        $params = $_GET['params'];

        // Appeler la méthode filterClients() du contrôleur pour filtrer les clients
        $clients = $clientController->filterClients($params);
        require_once 'homeAdmin.php';

    } elseif ($action === 'sort' && isset($_GET['field']) && isset($_GET['order'])) {
        // Récupérer le champ de tri et l'ordre (ascendant ou descendant)
        $field = $_GET['field'];
        $order = $_GET['order'];

        // Appeler la méthode sortClients() du contrôleur pour trier les clients
        $sortedClients = $clientController->sortClients($field, $order);
        $clients = $sortedClients;
        require_once 'homeAdmin.php';

    } else {
        // Afficher la liste des clients par défaut
        $clients = $clientController->getAllClients();
        require_once 'homeAdmin.php';
    }
} else {
    // Afficher la liste des clients par défaut
    $clients = $clientController->getAllClients();
    require_once 'homeAdmin.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/list.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>


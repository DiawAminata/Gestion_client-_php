<?php
require_once('../models/Client.php');

$controller = new ClientController();
$clients = $controller->getAllClients();


class ClientController
{
    // Méthode pour récupérer un client par son ID depuis la base de données
    public function get($id)
    {
        global $db;
        try {
            $query = $db->prepare("SELECT * FROM clients WHERE id = ?");
            $query->execute([$id]);
            $clientData = $query->fetch(PDO::FETCH_ASSOC);
    
            if (!$clientData) {
                echo "Aucun client trouvé avec l'ID $id.";
            }
    
            return $clientData;
        } catch (PDOException $e) {
            die("Erreur lors de la récupération du client : " . $e->getMessage());
        }
    }
    

    // Méthode pour afficher la liste des clients dans une version imprimable
    public function printList()
    {
        // Récupérer tous les clients
        $clients = $this->getAllClients();

        // Ajouter le lien vers le fichier CSS pour "printList"
        echo '<link rel="stylesheet" type="text/css" href="../../public/css/style_printlist.css">';

        // Afficher l'en-tête pour l'impression
        echo '<h1>Liste des clients</h1>';
        echo '<h3>Cliquez sur la touche Ctrl+p de votre clavier pour imprimer la liste de tous les clients</h3>';

        // Afficher la liste des clients avec un div pour chaque client
        echo '<div class="client-list">';
        foreach ($clients as $client) {
            echo '<div class="client-info">';
            echo "<p>ID: {$client->id}</p>";
            echo "<p>Nom: {$client->nom}</p>";
            echo "<p>Adresse: {$client->adresse}</p>";
            echo "<p>Téléphone: {$client->telephone}</p>";
            echo "<p>Email: {$client->email}</p>";
            echo "<p>Sexe: {$client->sexe}</p>";
            echo "<p>Statut: {$client->statut}</p>";
            echo '</div>';
        }
        echo '</div>';
    }

    // Méthode pour mettre à jour un client existant dans la base de données
    public function updateClient($id, $nom, $adresse, $telephone, $email, $sexe, $statut)
    {
        global $db;

        try {
            // Préparer la requête SQL de mise à jour
            $query = $db->prepare("UPDATE clients SET nom=?, adresse=?, telephone=?, email=?, sexe=?, statut=? WHERE id=?");

            // Exécuter la requête avec les valeurs des paramètres
            $query->execute([$nom, $adresse, $telephone, $email, $sexe, $statut, $id]);
        } catch (PDOException $e) {
            // En cas d'erreur lors de la mise à jour, afficher le message d'erreur
            die("Erreur lors de la mise à jour du client : " . $e->getMessage());
        }
    }

    // Méthode pour créer un nouveau client dans la base de données
    public function createClient($nom, $adresse, $telephone, $email, $sexe, $statut)
    {
        global $db;

        try {
            // Préparer la requête SQL d'insertion
            $query = $db->prepare("INSERT INTO clients(nom, adresse, telephone, email, sexe, statut) VALUES (?, ?, ?, ?, ?, ?)");

            // Exécuter la requête avec les valeurs des paramètres
            $query->execute([$nom, $adresse, $telephone, $email, $sexe, $statut]);
        } catch (PDOException $e) {
            // En cas d'erreur lors de l'insertion, afficher le message d'erreur
            die("Erreur lors de la création du client : " . $e->getMessage());
        }
    }

    // Méthode pour récupérer tous les clients depuis la base de données
    public function getAllClients()
{
    global $db;

    try {
        $query = "SELECT * FROM clients";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $clients = $stmt->fetchAll(PDO::FETCH_CLASS, 'Client');
        
        if (empty($clients)) {
            echo 'Aucun client trouvé.';
        }

        return $clients;
    } catch (PDOException $e) {
        die("Erreur lors de la récupération des clients : " . $e->getMessage());
    }
}

    // Méthode pour supprimer un client par son ID dans la base de données
    public function deleteClient($id)
    {
        global $db;
        echo $id;
        try {
            // Préparer la requête SQL de suppression
            $query = $db->prepare("DELETE FROM clients WHERE id=?");

            // Exécuter la requête avec l'ID du client à supprimer
            $query->execute([$id]);
        } catch (PDOException $e) {
            // En cas d'erreur lors de la suppression, afficher le message d'erreur
            die("Erreur lors de la suppression du client : " . $e->getMessage());
        }
    }

    // Méthode pour filtrer les clients en fonction des paramètres (par exemple, par nom ou adresse)
    public function filterClients($params)
    {
        global $db;

        try {
            // Préparer la requête SQL de filtrage
            $query = $db->prepare("SELECT * FROM clients WHERE nom LIKE ? OR adresse LIKE ?");
            $params = "%{$params}%"; // Ajouter des jokers pour rechercher des correspondances partielles
            // Exécuter la requête avec les valeurs des paramètres
            $query->execute([$params, $params]);
            // Récupérer les résultats dans un tableau d'objets Client
            $filteredClients = $query->fetchAll(PDO::FETCH_CLASS, 'Client');

            return $filteredClients;
        } catch (PDOException $e) {
            // En cas d'erreur lors du filtrage, afficher le message d'erreur
            die("Erreur lors du filtrage des clients : " . $e->getMessage());
        }
    }

    // Méthode pour trier les clients en fonction du champ et de l'ordre dans la base de données
    public function sortClients($field, $order)
    {
        global $db;

        try {
            // Vérifier si le champ de tri est valide pour éviter les attaques par injection SQL
            $validFields = array('id', 'nom', 'adresse', 'telephone', 'email', 'sexe', 'statut');
            if (!in_array($field, $validFields)) {
                die("Champ de tri non valide");
            }

            // Préparer la requête SQL de tri
            $query = $db->prepare("SELECT * FROM clients ORDER BY $field $order");

            // Exécuter la requête
            $query->execute();

            // Récupérer les résultats dans un tableau d'objets Client
            $sortedClients = $query->fetchAll(PDO::FETCH_CLASS, 'Client');

            return $sortedClients;
        } catch (PDOException $e) {
            // En cas d'erreur lors du tri, afficher le message d'erreur
            die("Erreur lors du tri des clients : " . $e->getMessage());
        }
    }

    // Méthode pour exporter la liste des clients au format CSV
    public function exportCSV()
    {
        global $db;

        try {
            ob_clean();
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=clients.csv');
            $output = fopen('php://output', 'w');
            fputcsv($output, array('ID', 'Nom', 'Adresse', 'Téléphone', 'Email', 'Sexe', 'Statut'));

            // Exécuter la requête SQL pour récupérer tous les clients
            $query = $db->query("SELECT * FROM clients");

            // Récupérer les résultats dans un tableau associatif
            $clients = $query->fetchAll(PDO::FETCH_ASSOC);

            // Écrire les données dans le fichier CSV
            foreach ($clients as $client) {
                fputcsv($output, $client);
            }
            fclose($output);
            exit;
        } catch (PDOException $e) {
            // En cas d'erreur lors de l'exportation, afficher le message d'erreur
            die("Erreur lors de l'exportation des clients au format CSV : " . $e->getMessage());
        }
    }

    // Méthode pour exporter la liste des clients au format PDF
    public function exportPDF()
    {
        require_once __DIR__ . '../../../vendor/autoload.php'; // Assurez-vous que le chemin est correct
    
        global $db;
    
        // Initialiser mPDF
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetTitle('Liste des clients');
    
        // Commencer la construction du contenu HTML pour le PDF
        $html = '<h1>Liste des clients</h1>';
        $html .= '<table border="1" cellpadding="5">';
        $html .= '<tr><th>ID</th><th>Nom</th><th>Adresse</th><th>Téléphone</th><th>Email</th><th>Sexe</th><th>Statut</th></tr>';
    
        try {
            // Exécuter la requête SQL pour récupérer tous les clients
            $query = $db->query("SELECT * FROM clients");
    
            // Récupérer les résultats dans un tableau associatif
            $clients = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // Ajouter les données dans le contenu HTML du PDF
            foreach ($clients as $client) {
                $html .= '<tr>';
                $html .= '<td>' . htmlspecialchars($client['id']) . '</td>';
                $html .= '<td>' . htmlspecialchars($client['nom']) . '</td>';
                $html .= '<td>' . htmlspecialchars($client['adresse']) . '</td>';
                $html .= '<td>' . htmlspecialchars($client['telephone']) . '</td>';
                $html .= '<td>' . htmlspecialchars($client['email']) . '</td>';
                $html .= '<td>' . htmlspecialchars($client['sexe']) . '</td>';
                $html .= '<td>' . htmlspecialchars($client['statut']) . '</td>';
                $html .= '</tr>';
            }
    
            $html .= '</table>';
    
            // Ajouter le contenu HTML à mPDF
            $mpdf->WriteHTML($html);
    
            // Générer et envoyer le PDF au navigateur
            $mpdf->Output('clients.pdf', 'D'); // 'D' pour forcer le téléchargement
            exit;
        } catch (PDOException $e) {
            // En cas d'erreur lors de l'exportation au format PDF, afficher le message d'erreur
            die("Erreur lors de l'exportation au format PDF : " . $e->getMessage());
        }
    }
    

    // Méthode pour générer le rapport sur les clients
    public function generateReport()
{
    global $db;

    try {
        // Exécuter la requête SQL pour compter le nombre de clients actifs et inactifs
        $query = $db->query("SELECT statut, COUNT(*) AS total FROM clients GROUP BY statut");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        // Ajouter le lien vers le fichier CSS pour "generateReport"
        echo '<link rel="stylesheet" type="text/css" href="./../public/css/generatereport.css">';
        // Générer le rapport HTML avec un div pour chaque statistique
        $report = '<div class="report">';
        $report .= '<h1>Rapport sur les clients</h1>';
        $report .= '<div class="statistic">';
        $report .= '<p>Nombre total de clients actifs : ' . $results[0]['total'] . '</p>';
        $report .= '</div>';
        $report .= '<div class="statistic">';
        $report .= '<p>Nombre total de clients inactifs : ' . $results[1]['total'] . '</p>';
        $report .= '</div>';
        $report .= '</div>';

        // Enregistrer le rapport dans un fichier (rapport.html) dans le dossier "reports"
        $reportFilePath = '../../reports/reports.html';
        file_put_contents($reportFilePath, $report);


        // Afficher un message de succès
        header("location: " . $reportFilePath);
    } catch (PDOException $e) {
        // En cas d'erreur lors de la génération du rapport, afficher le message d'erreur
        die("Erreur lors de la génération du rapport : " . $e->getMessage());
    }
}
}

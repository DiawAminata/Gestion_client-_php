<?php
require_once('../../config/database.php');
class Client
{
    // Méthode pour récupérer un client par son ID depuis la base de données
    public static function get($id)
    {
        global $db;

        try {
            // Préparer la requête SQL pour récupérer un client par son ID
            $query = $db->prepare("SELECT * FROM clients WHERE id = ?");

            // Exécuter la requête avec l'ID du client à récupérer
            $query->execute([$id]);

            // Récupérer le résultat sous forme de tableau associatif
            $client = $query->fetch(PDO::FETCH_ASSOC);

            // Retourner le client s'il existe, sinon retourner null
            return $client ? $client : null;
        } catch (PDOException $e) {
            // En cas d'erreur lors de la récupération du client, afficher le message d'erreur
            die("Erreur lors de la récupération du client : " . $e->getMessage());
        }
    }
    public static function getAllClients()
    {
        global $db;
        try {
            // Requête SQL pour récupérer tous les clients
            $query = "SELECT * FROM clients";

            // Préparation de la requête
            $stmt = $db->prepare($query);

            // Exécution de la requête
            $stmt->execute();

            // Récupération des résultats sous forme de tableau associatif
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Retourne le tableau des clients
            return $clients;
        } catch (PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur ou gérez l'erreur selon vos besoins
            die("Erreur lors de la récupération des clients : " . $e->getMessage());
        }
    }

    public $id;
    public $nom;
    public $adresse;
    public $telephone;
    public $email;
    public $sexe;
    public $statut;
    

    public function __construct()
    {
        
    }


    // Méthode pour convertir l'objet client en tableau
    public function toArray()
    {
        return array(
            'ID' => $this->id,
            'Nom' => $this->nom,
            'Adresse' => $this->adresse,
            'Téléphone' => $this->telephone,
            'Email' => $this->email,
            'Sexe' => $this->sexe,
            'Statut' => $this->statut,
        );  
    }
}

<?php
require_once '../../config/database.php'; // Inclure le fichier de connexion à la base de données

class AdminModel {
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct() {
        global $db;
        $this->db = $db;
    }

    // Ajouter un administrateur
    public function ajouterAdmin($nom, $email, $mot_de_passe) {
        try {
            $query = "INSERT INTO admin (nom, email, mot_de_passe) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$nom,  $email, password_hash($mot_de_passe, PASSWORD_BCRYPT)]);
            return true;
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout de l'administrateur : " . $e->getMessage());
        }
    }

    // Supprimer un administrateur
    public function supprimerAdmin($id) {
        try {
            $query = "DELETE FROM admin WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            die("Erreur lors de la suppression de l'administrateur : " . $e->getMessage());
        }
    }

    // Modifier un administrateur
    public function modifierAdmin($id, $nom, $email, $mot_de_passe) {
        try {
            $query = "UPDATE admin SET nom = ?, email = ?, mot_de_passe = ? WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$nom, $email, password_hash($mot_de_passe, PASSWORD_BCRYPT), $id]);
            return true;
        } catch (PDOException $e) {
            die("Erreur lors de la modification de l'administrateur : " . $e->getMessage());
        }
    }

    // Obtenir un administrateur par ID
    public function getAdminById($id) {
        try {
            $query = "SELECT * FROM admin WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération de l'administrateur : " . $e->getMessage());
        }
    }

    // Obtenir tous les administrateurs
    public function getAllAdmins() {
        try {
            $query = "SELECT * FROM admin";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des administrateurs : " . $e->getMessage());
        }
    }
}
?>

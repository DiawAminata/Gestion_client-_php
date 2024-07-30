<?php
require_once '../models/Admin.php';

class AdminController {
    private $model;

    public function __construct() {
        $this->model = new AdminModel();
    }

    // Ajouter un administrateur
    public function ajouterAdmin($nom, $email, $mot_de_passe) {
        if ($this->model->ajouterAdmin($nom, $email, $mot_de_passe)) {
            echo 'Administrateur ajouté avec succès.';
        }
    }

    // Supprimer un administrateur
    public function supprimerAdmin($id) {
        if ($this->model->supprimerAdmin($id)) {
            echo 'Administrateur supprimé avec succès.';
        }
    }

    // Modifier un administrateur
    public function modifierAdmin($id, $nom, $email, $mot_de_passe) {
        if ($this->model->modifierAdmin($id, $nom, $email, $mot_de_passe)) {
            echo 'Administrateur modifié avec succès.';
        }
    }

    // Obtenir un administrateur par ID
    public function getAdminById($id) {
        return $this->model->getAdminById($id);
    }

    // Obtenir tous les administrateurs
    public function getAllAdmins() {
        return $this->model->getAllAdmins();
    }
}
?>

<?php

require_once '../../app/controllers/ClientController.php';

session_start(); // Démarrer la session


?>
<!DOCTYPE html>
<html>

<head>
    <title> Super Administrateur</title>
    <link rel="stylesheet" href="../../public/css/list.css">
</head>

<body>
   

<header>
  <div class="topnav">
    <p class="header-links">
      <a href="report.php">Générer un rapport</a>
      <a href="traitement.php?action=print">Imprimer la liste</a> 
      <a href="traitement.php?action=export_csv">Exporter au format CSV</a> 
      <a href="traitement.php?action=export_pdf">Exporter au format PDF</a> 
      <a href="create.php">Ajouter un nouveau client</a>
      <a href="showAdmin.php">Gestion des Admins</a> 
      <a href="deconnexion.php">deconnexion</a> 

      
    </p>
  </div>
</header>

<div class="client-list">
  <img src="../../public/images/gestion.png" alt="Image">
</div>

<div class="welcome-message">
    
    <p  class="welcome-text">Bienvenue dans votre <br>application de <br>Gestion clientèle</p>
  </div>

 


<div class="client-filter fade-in">
    
<div class="client-heading">
  <h1>Consulter la liste des clients</h1>
    </div>
   
<h2>Filtrer les clients</h2>
    <form action="traitement.php" method="get">
        <input type="text" name="params" placeholder="Nom ou adresse du client">
        <input type="text" name="action" value="filter" hidden>
        <input type="submit" value="Filtrer">
    </form>
</div>

<div class="icone-tri">
  <img src="../../public/images/tri.png" alt="Image">
</div>

    <h2 class="trier-client">Ici vous pouvez trier les clients par ordre croissant ou décroissant</h2>

    <form action="traitement.php" method="get" >
        <input type="hidden" name="action" value="sort">
        <select id="sort-options" name="field">
            <option value="">Sélectionner un champ de tri</option>
            <option value="nom">Nom</option>
            <option value="adresse">Adresse</option>
            <option value="telephone">Téléphone</option>
            <option value="statut">Statut</option>
        </select>
        <input type="radio" name="order" value="asc" id="asc">
        <label for="asc">Ascendant</label>
        <input type="radio" name="order" value="desc" id="desc">
        <label for="desc">Descendant</label>
        <input type="submit" value="Trier">
    </form>


    <div class="animated-table">
  <div class="row column-header">
    <div>ID</div>
    <div>Nom</div>
    <div>Adresse</div>
    <div>Téléphone</div>
    <div>Email</div>
    <div>Sexe</div>
    <div>Statut</div>
    <div>Actions</div>
  </div>

  <!-- Ligne de données -->
  <?php foreach ($clients as $client) : ?>
    <div class="row">
      <div class="cell"><?php echo $client->id; ?></div>
      <div class="cell"><?php echo $client->nom; ?></div>
      <div class="cell"><?php echo $client->adresse; ?></div>
      <div class="cell"><?php echo $client->telephone; ?></div>
      <div class="cell"><?php echo $client->email; ?></div>
      <div class="cell"><?php echo $client->sexe; ?></div>
      <div class="cell"><?php echo $client->statut; ?></div>
      <div class="cell">
                <td>
                    <a href="show.php?id=<?php echo $client->id; ?>">Détails</a> |
                    <a href="edit.php?id=<?php echo $client->id; ?>">Modifier</a> |
                    <a href="traitement.php?action=delete&id=<?php echo $client->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</a>
                </td>
        </div>
    </div>
        <?php endforeach; ?>
  </div>
    <script src="./public/js/list.js"></script>
</body>

</html>
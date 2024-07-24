<!DOCTYPE html>
<html>

<head>
    <title>Créer un nouveau client</title>
    <link rel="stylesheet" href="../../public/css/create.css">
</head>

<body>
    <div class="arriere-plan">
        <img src="../../public/images/create.jpg" alt="Image">

    </div>

    <div class="formulaire-container">
        <h1>Créer un nouveau client</h1>
        <form action="traitement.php?action=create" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required>

            <label for="telephone">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe" required>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="autre">Autre</option>
            </select>

            <label for="statut">Statut :</label>
            <input type="radio" id="actif" name="statut" value="actif" required>
            <label for="actif">Actif</label>
            <input type="radio" id="inactif" name="statut" value="inactif" required>
            <label for="inactif">Inactif</label>

            <input type="submit" value="Créer">
        </form>
    </div>
    <script src="./public/js/script.js"></script>
</body>

</html>
$(document).ready(function () {
  // Gestionnaire d'événement pour le formulaire de filtrage
  $("#filterForm").submit(function (event) {
    event.preventDefault();

    const params = $("#filterParams").val();
    // Vous pouvez effectuer une requête AJAX pour filtrer les clients en fonction des paramètres saisis
    console.log("Filtrage des clients par:", params);
  });

  // Gestionnaire d'événement pour les boutons de tri
  $(".sort-button").click(function () {
    const field = $(this).attr("data-field");
    const order = $(this).attr("data-order");
    // Vous pouvez effectuer une requête AJAX pour trier la liste des clients
    console.log("Tri des clients par:", field, "ordre:", order);
  });

  // Gestionnaire d'événement pour le bouton "Supprimer" dans la liste des clients
  $(".delete-button").click(function () {
    const clientId = $(this).attr("data-client-id");
    // Vous pouvez effectuer une requête AJAX pour supprimer le client avec l'ID clientId
    console.log("Suppression du client avec l'ID:", clientId);
  });

  // Gestionnaire d'événement pour le formulaire de création/édition de client
  $("#clientForm").submit(function (event) {
    event.preventDefault();

    const form = $(this);
    const formData = form.serialize();
    const url = form.attr("action");
    const method = form.attr("method");

    // Vous pouvez effectuer une requête AJAX pour créer ou mettre à jour le client
    console.log("Envoi des données du formulaire pour:", method, formData);

    // Simuler une opération réussie avec un message de succès
    // Ici, vous pouvez remplacer cette partie par une requête AJAX réelle avec succès.
    setTimeout(function () {
      $(".success-message").text("Opération réussie !");
    }, 1000);
  });

  // Gestionnaire d'événement pour le bouton "Annuler" dans le formulaire de création/édition de client
  $("#cancelButton").click(function () {
    // Vous pouvez effectuer ici des opérations supplémentaires lorsque le bouton "Annuler" est cliqué
    console.log("Opération annulée !");
  });
});j
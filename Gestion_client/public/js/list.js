// Fonction appelée lorsque le formulaire de tri est soumis
function onSortOptionChange() {
    const sortOptions = document.getElementById('sort-options');
    const sortField = sortOptions.value; // Champ de tri sélectionné dans la liste déroulante
    const ascRadio = document.getElementById('asc');
    const descRadio = document.getElementById('desc');
    let sortOrder = '';

    // Vérifier l'ordre de tri sélectionné (ascendant ou descendant)
    if (ascRadio.checked) {
        sortOrder = 'asc';
    } else if (descRadio.checked) {
        sortOrder = 'desc';
    }

    // Vérifier si un champ de tri a été sélectionné
    if (sortField === '') {
        alert('Veuillez sélectionner un champ de tri.');
        return false; // Empêcher l'envoi du formulaire si aucun champ de tri n'est sélectionné
    }

    // Rediriger vers la page de tri avec les paramètres appropriés
    window.location.href = `/GestionClients/index.php?action=sort&field=${sortField}&order=${sortOrder}`;

    return false; // Empêcher l'envoi du formulaire par défaut
}







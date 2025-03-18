document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.ms6-form-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const ms6Statut = this.value;
            const ms6CommandeId = this.getAttribute('data-commande-id');
            const ms6Form = this.closest('form');

            // Créer un objet FormData pour soumettre les données du formulaire
            const ms6FormData = new FormData(ms6Form);
            ms6FormData.append('statut', ms6Statut); // Ajouter le statut sélectionné

            // Effectuer la requête AJAX
            fetch(ms6Form.action, {
                method: 'POST',
                body: ms6FormData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Afficher un message de succès si la mise à jour a réussi
                        alert('Statut mis à jour avec succès!');
                        // Actualiser la page pour refléter la mise à jour
                        location.reload();
                    } else {
                        alert('Erreur lors de la mise à jour du statut.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur s\'est produite.');
                });
        });
    });
});

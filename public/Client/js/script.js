// Gestion du panier
let panier = [];
let total = 0;

function ajouterAuPanier(nom, prix) {
    const item = {
        id: Date.now(),
        nom: nom,
        prix: prix,
        quantite: 1
    };

    // Vérifier si l'article existe déjà
    const existingItem = panier.find(i => i.nom === nom);
    if (existingItem) {
        existingItem.quantite++;
    } else {
        panier.push(item);
    }

    updatePanierUI();
    updatePanierBadge();

    // Afficher une notification
    const toast = new bootstrap.Toast(document.createElement('div'));
    toast.show();
}

function updatePanierUI() {
    const panierItems = document.getElementById('panier-items');
    const panierTotal = document.getElementById('panier-total');

    panierItems.innerHTML = '';
    total = 0;

    panier.forEach(item => {
        total += item.prix * item.quantite;

        const itemElement = document.createElement('div');
        itemElement.className = 'panier-item d-flex justify-content-between align-items-center mb-3';
        itemElement.innerHTML = `
            <div>
                <h6 class="mb-0">${item.nom}</h6>
                <small class="text-muted">Prix: ${item.prix.toFixed(2)} €</small>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-2" onclick="modifierQuantite(${item.id}, -1)">-</button>
                <span>${item.quantite}</span>
                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="modifierQuantite(${item.id}, 1)">+</button>
                <button class="btn btn-sm btn-danger ms-3" onclick="supprimerDuPanier(${item.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        panierItems.appendChild(itemElement);
    });

    panierTotal.textContent = `${total.toFixed(2)} €`;
}

function updatePanierBadge() {
    const badge = document.querySelector('.badge');
    const quantiteTotal = panier.reduce((acc, item) => acc + item.quantite, 0);
    badge.textContent = quantiteTotal;
}

function modifierQuantite(id, delta) {
    const item = panier.find(i => i.id === id);
    if (item) {
        item.quantite += delta;
        if (item.quantite <= 0) {
            supprimerDuPanier(id);
        } else {
            updatePanierUI();
            updatePanierBadge();
        }
    }
}

function supprimerDuPanier(id) {
    panier = panier.filter(item => item.id !== id);
    updatePanierUI();
    updatePanierBadge();
}

function validerCommande() {
    if (panier.length === 0) {
        alert('Votre panier est vide !');
        return;
    }

    // Ici, vous pouvez ajouter la logique pour envoyer la commande au serveur
    const commande = {
        items: panier,
        total: total,
        date: new Date(),
        status: 'en attente'
    };

    // Simuler l'envoi de la commande
    console.log('Commande envoyée:', commande);

    // Vider le panier
    panier = [];
    updatePanierUI();
    updatePanierBadge();

    // Fermer le modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('panierModal'));
    modal.hide();

    // Afficher un message de confirmation
    alert('Votre commande a été envoyée avec succès !');
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    // Initialiser les tooltips Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Gestionnaire de clic pour le bouton du panier
    document.querySelector('a[href="#panier"]').addEventListener('click', (e) => {
        e.preventDefault();
        const panierModal = new bootstrap.Modal(document.getElementById('panierModal'));
        panierModal.show();
    });
});

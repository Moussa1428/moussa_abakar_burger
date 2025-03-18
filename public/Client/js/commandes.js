// Données de démonstration pour les commandes
const commandes = [
    {
        id: 12345,
        date: '2024-03-15',
        status: 'livree',
        items: [
            { nom: 'Burger Gourmet', quantite: 1, prix: 15.90 },
            { nom: 'Tiramisu', quantite: 2, prix: 6.90 }
        ],
        total: 29.70
    },
    {
        id: 12346,
        date: '2024-03-18',
        status: 'en_cours',
        items: [
            { nom: 'Salade César', quantite: 1, prix: 8.50 },
            { nom: 'Pâtes aux Fruits de Mer', quantite: 1, prix: 17.50 }
        ],
        total: 26.00,
        progression: 75
    }
];

// Charger les commandes au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    // Ajouter les écouteurs d'événements pour les filtres
    document.getElementById('filterStatus').addEventListener('change', filtrerCommandes);
    document.getElementById('filterDate').addEventListener('change', filtrerCommandes);
    document.getElementById('sortBy').addEventListener('change', filtrerCommandes);
});

// Fonction pour filtrer et trier les commandes
function filtrerCommandes() {
    const status = document.getElementById('filterStatus').value;
    const date = document.getElementById('filterDate').value;
    const tri = document.getElementById('sortBy').value;

    let commandesFiltrees = [...commandes];

    // Filtrer par statut
    if (status) {
        commandesFiltrees = commandesFiltrees.filter(c => c.status === status);
    }

    // Filtrer par date
    if (date) {
        const aujourd'hui = new Date();
        const debutPeriode = new Date();

        switch (date) {
            case 'today':
                commandesFiltrees = commandesFiltrees.filter(c =>
                    new Date(c.date).toDateString() === aujourd'hui.toDateString()
            );
                break;
            case 'week':
                debutPeriode.setDate(aujourd'hui.getDate() - 7);
                commandesFiltrees = commandesFiltrees.filter(c =>
                    new Date(c.date) >= debutPeriode
                );
                break;
            case 'month':
                debutPeriode.setMonth(aujourd'hui.getMonth() - 1);
                commandesFiltrees = commandesFiltrees.filter(c =>
                    new Date(c.date) >= debutPeriode
                );
                break;
        }
    }

    // Trier les commandes
    commandesFiltrees.sort((a, b) => {
        switch (tri) {
            case 'date_desc':
                return new Date(b.date) - new Date(a.date);
            case 'date_asc':
                return new Date(a.date) - new Date(b.date);
            case 'total_desc':
                return b.total - a.total;
            case 'total_asc':
                return a.total - b.total;
            default:
                return 0;
        }
    });

    // Mettre à jour l'affichage
    afficherCommandes(commandesFiltrees);
}

// Fonction pour afficher les commandes
function afficherCommandes(commandes) {
    const container = document.getElementById('commandesList');
    container.innerHTML = '';

    commandes.forEach(commande => {
        const card = document.createElement('div');
        card.className = 'card shadow mb-3';

        const statusBadgeClass = {
            'en_cours': 'bg-warning text-dark',
            'livree': 'bg-success',
            'annulee': 'bg-danger'
        }[commande.status];

        const statusText = {
            'en_cours': 'En cours',
            'livree': 'Livrée',
            'annulee': 'Annulée'
        }[commande.status];

        card.innerHTML = `
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Commande #${commande.id}</h5>
                    <small class="text-muted">Passée le ${formatDate(commande.date)}</small>
                </div>
                <span class="badge ${statusBadgeClass}">${statusText}</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h6>Articles</h6>
                        <ul class="list-unstyled">
                            ${commande.items.map(item => `
                                <li>${item.quantite}x ${item.nom} - ${(item.prix * item.quantite).toFixed(2)} €</li>
                            `).join('')}
                        </ul>
                        ${commande.status === 'en_cours' ? `
                            <div class="mt-3">
                                <h6>Suivi de commande</h6>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         role="progressbar"
                                         style="width: ${commande.progression}%"
                                         aria-valuenow="${commande.progression}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">En cours de livraison</small>
                            </div>
                        ` : ''}
                    </div>
                    <div class="col-md-4 text-end">
                        <h6>Total</h6>
                        <p class="h4 text-primary">${commande.total.toFixed(2)} €</p>
                        ${commande.status === 'en_cours' ? `
                            <button class="btn btn-outline-danger btn-sm mt-2" onclick="annulerCommande(${commande.id})">
                                <i class="fas fa-times me-1"></i>Annuler
                            </button>
                        ` : `
                            <button class="btn btn-outline-primary btn-sm mt-2" onclick="showFacture(${commande.id})">
                                <i class="fas fa-file-invoice me-1"></i>Voir la facture
                            </button>
                        `}
                    </div>
                </div>
            </div>
        `;

        container.appendChild(card);
    });
}

// Fonction pour formater la date
function formatDate(dateStr) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateStr).toLocaleDateString('fr-FR', options);
}

// Fonction pour annuler une commande
function annulerCommande(id) {
    if (confirm('Êtes-vous sûr de vouloir annuler cette commande ?')) {
        // Simuler l'annulation
        const commande = commandes.find(c => c.id === id);
        if (commande) {
            commande.status = 'annulee';
            filtrerCommandes();
        }
    }
}

// Fonction pour afficher la facture
function showFacture(id) {
    const commande = commandes.find(c => c.id === id);
    if (!commande) return;

    document.getElementById('factureNumero').textContent = commande.id;

    const factureContent = document.getElementById('factureContent');
    factureContent.innerHTML = `
        <div class="container">
            <div class="row mb-4">
                <div class="col-6">
                    <h4>Mon Restaurant</h4>
                    <p>123 Rue de la Gastronomie<br>75000 Paris</p>
                </div>
                <div class="col-6 text-end">
                    <h4>Facture #${commande.id}</h4>
                    <p>Date: ${formatDate(commande.date)}</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th class="text-center">Quantité</th>
                                <th class="text-end">Prix unitaire</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${commande.items.map(item => `
                                <tr>
                                    <td>${item.nom}</td>
                                    <td class="text-center">${item.quantite}</td>
                                    <td class="text-end">${item.prix.toFixed(2)} €</td>
                                    <td class="text-end">${(item.prix * item.quantite).toFixed(2)} €</td>
                                </tr>
                            `).join('')}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total</strong></td>
                                <td class="text-end"><strong>${commande.total.toFixed(2)} €</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    `;

    const modal = new bootstrap.Modal(document.getElementById('factureModal'));
    modal.show();
}

// Fonction pour imprimer la facture
function imprimerFacture() {
    const contenuFacture = document.getElementById('factureContent').innerHTML;
    const fenetrePrint = window.open('', '', 'height=600,width=800');

    fenetrePrint.document.write(`
        <html>
            <head>
                <title>Facture</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            </head>
            <body>
                ${contenuFacture}
            </body>
        </html>
    `);
    fenetrePrint.document.close();
    fenetrePrint.focus();

    // Imprimer après le chargement des styles
    setTimeout(() => {
        fenetrePrint.print();
        fenetrePrint.close();
    }, 250);
}

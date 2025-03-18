// Données de démonstration pour les factures
const factures = [
    {
        numero: 'FACT-2024-001',
        date: '2024-03-18',
        commande: 'CMD-12346',
        montant: 26.00,
        statut: 'payee',
        details: {
            client: {
                nom: 'Dupont',
                prenom: 'Jean',
                adresse: '123 rue de la Paix, 75000 Paris',
                email: 'jean.dupont@email.com'
            },
            articles: [
                { nom: 'Burger Gourmet', quantite: 1, prix: 15.90 },
                { nom: 'Tiramisu', quantite: 2, prix: 6.90 }
            ],
            sousTotal: 29.70,
            fraisLivraison: 2.50,
            total: 32.20
        }
    },
    {
        numero: 'FACT-2024-002',
        date: '2024-03-19',
        commande: 'CMD-12347',
        montant: 42.50,
        statut: 'en_attente',
        details: {
            client: {
                nom: 'Martin',
                prenom: 'Sophie',
                adresse: '456 avenue des Fleurs, 75001 Paris',
                email: 'sophie.martin@email.com'
            },
            articles: [
                { nom: 'Pizza Margherita', quantite: 2, prix: 12.90 },
                { nom: 'Salade César', quantite: 1, prix: 8.50 },
                { nom: 'Tiramisu', quantite: 1, prix: 6.90 }
            ],
            sousTotal: 41.20,
            fraisLivraison: 2.50,
            total: 43.70
        }
    }
];

let currentFacture = null;

// Charger les factures au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    // Initialiser les écouteurs d'événements pour les filtres
    document.getElementById('filterPeriode').addEventListener('change', filtrerFactures);
    document.getElementById('filterMontant').addEventListener('change', filtrerFactures);
    document.getElementById('sortBy').addEventListener('change', filtrerFactures);

    // Charger les factures initiales
    filtrerFactures();
});

// Fonction pour filtrer et trier les factures
function filtrerFactures() {
    const periode = document.getElementById('filterPeriode').value;
    const montant = document.getElementById('filterMontant').value;
    const tri = document.getElementById('sortBy').value;

    let facturesFiltrees = [...factures];

    // Filtrer par période
    if (periode) {
        const maintenant = new Date();
        const debutPeriode = new Date();

        switch(periode) {
            case 'mois_courant':
                debutPeriode.setMonth(maintenant.getMonth(), 1);
                break;
            case '3_mois':
                debutPeriode.setMonth(maintenant.getMonth() - 3);
                break;
            case '6_mois':
                debutPeriode.setMonth(maintenant.getMonth() - 6);
                break;
            case 'annee':
                debutPeriode.setFullYear(maintenant.getFullYear(), 0, 1);
                break;
        }

        facturesFiltrees = facturesFiltrees.filter(f => new Date(f.date) >= debutPeriode);
    }

    // Filtrer par montant
    if (montant) {
        const [min, max] = montant.split('_').map(v => v === 'plus' ? Infinity : Number(v));
        facturesFiltrees = facturesFiltrees.filter(f => f.montant >= min && f.montant < max);
    }

    // Trier les factures
    facturesFiltrees.sort((a, b) => {
        switch(tri) {
            case 'date_desc':
                return new Date(b.date) - new Date(a.date);
            case 'date_asc':
                return new Date(a.date) - new Date(b.date);
            case 'montant_desc':
                return b.montant - a.montant;
            case 'montant_asc':
                return a.montant - b.montant;
            default:
                return 0;
        }
    });

    afficherFactures(facturesFiltrees);
}

// Fonction pour afficher les factures dans le tableau
function afficherFactures(facturesFiltrees) {
    const tbody = document.getElementById('facturesList');
    tbody.innerHTML = '';

    facturesFiltrees.forEach(facture => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${facture.numero}</td>
            <td>${formatDate(facture.date)}</td>
            <td>${facture.commande}</td>
            <td>${facture.montant.toFixed(2)} €</td>
            <td><span class="badge ${facture.statut === 'payee' ? 'bg-success' : 'bg-warning text-dark'}">${facture.statut === 'payee' ? 'Payée' : 'En attente'}</span></td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-1" onclick="voirFacture('${facture.numero}')">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn btn-sm btn-outline-secondary me-1" onclick="telechargerFacture('${facture.numero}')">
                    <i class="fas fa-download"></i>
                </button>
                <button class="btn btn-sm btn-outline-info" onclick="envoyerParEmail('${facture.numero}')">
                    <i class="fas fa-envelope"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// Fonction pour formater la date
function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

// Fonction pour voir les détails d'une facture
function voirFacture(numero) {
    currentFacture = factures.find(f => f.numero === numero);
    if (!currentFacture) return;

    document.getElementById('factureNumero').textContent = currentFacture.numero;

    const content = document.getElementById('factureContent');
    content.innerHTML = `
        <div class="mb-4">
            <h6 class="mb-3">Informations client</h6>
            <p class="mb-1">${currentFacture.details.client.prenom} ${currentFacture.details.client.nom}</p>
            <p class="mb-1">${currentFacture.details.client.adresse}</p>
            <p class="mb-1">${currentFacture.details.client.email}</p>
        </div>
        <div class="mb-4">
            <h6 class="mb-3">Articles</h6>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    ${currentFacture.details.articles.map(article => `
                        <tr>
                            <td>${article.nom}</td>
                            <td>${article.quantite}</td>
                            <td>${article.prix.toFixed(2)} €</td>
                            <td>${(article.quantite * article.prix).toFixed(2)} €</td>
                        </tr>
                    `).join('')}
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end">Sous-total</td>
                        <td>${currentFacture.details.sousTotal.toFixed(2)} €</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end">Frais de livraison</td>
                        <td>${currentFacture.details.fraisLivraison.toFixed(2)} €</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total</strong></td>
                        <td><strong>${currentFacture.details.total.toFixed(2)} €</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    `;

    const modal = new bootstrap.Modal(document.getElementById('factureModal'));
    modal.show();
}

// Fonction pour télécharger une facture
function telechargerFacture(numero) {
    // Simulation du téléchargement
    alert(`Téléchargement de la facture ${numero} en cours...`);
}

// Fonction pour envoyer une facture par email
function envoyerParEmail(numero) {
    const facture = factures.find(f => f.numero === numero);
    if (!facture) return;

    // Simulation de l'envoi par email
    alert(`La facture ${numero} a été envoyée à ${facture.details.client.email}`);
}

// Base de données des produits (à terme, cela devrait venir d'une API)
const produits = {
    entrees: [
        { id: 1, nom: 'Salade César', prix: 8.90, image: 'salade-cesar.jpg', description: 'Laitue, poulet grillé, parmesan, croûtons', categorie: 'entrees' },
        { id: 2, nom: 'Soupe à l\'oignon', prix: 7.50, image: 'soupe-oignon.jpg', description: 'Oignons caramélisés, croûtons, fromage gratiné', categorie: 'entrees' },
        { id: 3, nom: 'Carpaccio de bœuf', prix: 11.90, image: 'carpaccio.jpg', description: 'Fines tranches de bœuf, parmesan, roquette', categorie: 'entrees' }
    ],
    plats: [
        { id: 4, nom: 'Steak Frites', prix: 18.90, image: 'steak-frites.jpg', description: 'Steak de bœuf, frites maison, sauce au choix', categorie: 'plats' },
        { id: 5, nom: 'Poulet Rôti', prix: 16.50, image: 'poulet-roti.jpg', description: 'Poulet fermier, légumes de saison', categorie: 'plats' },
        { id: 6, nom: 'Saumon Grillé', prix: 19.90, image: 'saumon-grille.jpg', description: 'Saumon frais, riz basmati, sauce citronnée', categorie: 'plats' }
    ],
    pizzas: [
        { id: 7, nom: 'Margherita', prix: 12.90, image: 'pizza-margherita.jpg', description: 'Sauce tomate, mozzarella, basilic frais', categorie: 'pizzas' },
        { id: 8, nom: 'Quatre Fromages', prix: 14.90, image: 'pizza-4-fromages.jpg', description: 'Mozzarella, gorgonzola, chèvre, parmesan', categorie: 'pizzas' },
        { id: 9, nom: 'Pepperoni', prix: 13.90, image: 'pizza-pepperoni.jpg', description: 'Sauce tomate, mozzarella, pepperoni', categorie: 'pizzas' }
    ],
    desserts: [
        { id: 10, nom: 'Tiramisu', prix: 6.90, image: 'tiramisu.jpg', description: 'Mascarpone, café, cacao', categorie: 'desserts' },
        { id: 11, nom: 'Crème Brûlée', prix: 6.50, image: 'creme-brulee.jpg', description: 'Crème vanillée, caramel croustillant', categorie: 'desserts' },
        { id: 12, nom: 'Fondant au Chocolat', prix: 7.90, image: 'fondant-chocolat.jpg', description: 'Chocolat noir, cœur coulant', categorie: 'desserts' }
    ],
    boissons: [
        { id: 13, nom: 'Coca-Cola', prix: 3.50, image: 'coca.jpg', description: '33cl', categorie: 'boissons' },
        { id: 14, nom: 'Vin Rouge', prix: 4.90, image: 'vin-rouge.jpg', description: 'Verre 15cl', categorie: 'boissons' },
        { id: 15, nom: 'Eau Minérale', prix: 2.50, image: 'eau.jpg', description: '50cl', categorie: 'boissons' }
    ]
};

// Charger le panier au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    chargerPanier();
    // Ajouter le sélecteur de nombre de produits
    ajouterSelecteurNombreProduits();
    chargerProduitsDisponibles(5); // Par défaut, afficher 5 produits

    // Ajouter les écouteurs d'événements pour le filtrage
    document.getElementById('categorie-filter').addEventListener('change', filtrerProduits);
    document.getElementById('recherche-produit').addEventListener('input', filtrerProduits);
    // Ajouter l'écouteur pour le changement de nombre de produits
    document.getElementById('nombre-produits').addEventListener('change', (e) => {
        chargerProduitsDisponibles(parseInt(e.target.value));
    });
});

// Fonction pour charger le panier
function chargerPanier() {
    const panierItems = document.getElementById('panier-items');
    const panier = JSON.parse(localStorage.getItem('panier')) || [];
    let sousTotal = 0;

    panierItems.innerHTML = '';

    panier.forEach((item, index) => {
        const total = item.prix * item.quantite;
        sousTotal += total;

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <div class="d-flex align-items-center">
                    <img src="images/${item.image}" class="rounded me-3"
                         alt="${item.nom}" style="width: 50px; height: 50px; object-fit: cover;">
                    <div>
                        <h6 class="mb-0">${item.nom}</h6>
                        <small class="text-muted">${item.description}</small>
                    </div>
                </div>
            </td>
            <td>${item.prix.toFixed(2)} €</td>
            <td style="width: 150px;">
                <div class="input-group input-group-sm">
                    <button class="btn btn-outline-secondary" type="button"
                            onclick="modifierQuantite(${index}, -1)">-</button>
                    <input type="number" class="form-control text-center" value="${item.quantite}"
                           min="1" onchange="updateQuantite(${index}, this.value)">
                    <button class="btn btn-outline-secondary" type="button"
                            onclick="modifierQuantite(${index}, 1)">+</button>
                </div>
            </td>
            <td>${total.toFixed(2)} €</td>
            <td>
                <button class="btn btn-outline-danger btn-sm" onclick="supprimerItem(${index})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        panierItems.appendChild(tr);
    });

    // Mettre à jour les totaux
    document.getElementById('sous-total').textContent = `${sousTotal.toFixed(2)} €`;
    const fraisLivraison = 2.50;
    const total = sousTotal + fraisLivraison;
    document.getElementById('total').textContent = `${total.toFixed(2)} €`;

    // Mettre à jour le compteur du panier
    mettreAJourCompteurPanier();
}

// Fonction pour ajouter le sélecteur de nombre de produits
function ajouterSelecteurNombreProduits() {
    const container = document.getElementById('produits-controls');
    const selecteur = document.createElement('div');
    selecteur.className = 'mb-3';
    selecteur.innerHTML = `
        <label for="nombre-produits" class="form-label">Nombre de produits à afficher</label>
        <select class="form-select" id="nombre-produits">
            <option value="2">2 produits</option>
            <option value="3">3 produits</option>
            <option value="4">4 produits</option>
            <option value="5" selected>5 produits</option>
            <option value="6">6 produits</option>
            <option value="7">7 produits</option>
            <option value="8">8 produits</option>
            <option value="9">9 produits</option>
            <option value="10">10 produits</option>
        </select>
    `;
    container.appendChild(selecteur);
}

// Fonction pour charger les produits disponibles
function chargerProduitsDisponibles(nombreProduits = 5) {
    const produitsContainer = document.getElementById('produits-disponibles');
    produitsContainer.innerHTML = '';

    // Fusionner tous les produits en une seule liste
    const tousLesProduits = [
        ...produits.entrees,
        ...produits.plats,
        ...produits.pizzas,
        ...produits.desserts,
        ...produits.boissons
    ];

    // Limiter le nombre de produits affichés
    const produitsAffichés = tousLesProduits.slice(0, nombreProduits);

    produitsAffichés.forEach(produit => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <div class="d-flex align-items-center">
                    <img src="images/${produit.image}" class="rounded me-3"
                         alt="${produit.nom}" style="width: 50px; height: 50px; object-fit: cover;">
                    <strong>${produit.nom}</strong>
                </div>
            </td>
            <td>${produit.categorie.charAt(0).toUpperCase() + produit.categorie.slice(1)}</td>
            <td>${produit.description}</td>
            <td>${produit.prix.toFixed(2)} €</td>
            <td style="width: 150px;">
                <div class="input-group input-group-sm">
                    <button class="btn btn-outline-secondary" type="button"
                            onclick="modifierQuantite(${produit.id}, -1)">-</button>
                    <input type="number" class="form-control text-center" value="1"
                           min="1" onchange="updateQuantite(${produit.id}, this.value)">
                    <button class="btn btn-outline-secondary" type="button"
                            onclick="modifierQuantite(${produit.id}, 1)">+</button>
                </div>
            </td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="ajouterAuPanierDepuisListe(${produit.id})">
                    <i class="fas fa-plus me-1"></i>Ajouter
                </button>
            </td>
        `;
        produitsContainer.appendChild(tr);
    });
}

// Fonction pour filtrer les produits
function filtrerProduits() {
    const categorie = document.getElementById('categorie-filter').value;
    const recherche = document.getElementById('recherche-produit').value.toLowerCase();
    const rows = document.getElementById('produits-disponibles').getElementsByTagName('tr');

    Array.from(rows).forEach(row => {
        const nomProduit = row.querySelector('strong').textContent.toLowerCase();
        const categorieProduit = row.getElementsByTagName('td')[1].textContent.toLowerCase();
        const description = row.getElementsByTagName('td')[2].textContent.toLowerCase();

        const matchCategorie = categorie === 'tous' || categorieProduit.includes(categorie.toLowerCase());
        const matchRecherche = nomProduit.includes(recherche) ||
            description.includes(recherche) ||
            categorieProduit.includes(recherche);

        row.style.display = (matchCategorie && matchRecherche) ? '' : 'none';
    });
}

// Fonction pour ajouter un produit au panier depuis la liste
function ajouterAuPanierDepuisListe(produitId) {
    const quantite = parseInt(document.getElementById(`quantite-temp-${produitId}`).value);
    if (quantite < 1) return;

    // Trouver le produit dans la base de données
    const tousLesProduits = [
        ...produits.entrees,
        ...produits.plats,
        ...produits.pizzas,
        ...produits.desserts,
        ...produits.boissons
    ];
    const produit = tousLesProduits.find(p => p.id === produitId);
    if (!produit) return;

    // Ajouter au panier
    const panier = JSON.parse(localStorage.getItem('panier')) || [];
    const produitExistant = panier.findIndex(item => item.id === produitId);

    if (produitExistant !== -1) {
        panier[produitExistant].quantite += quantite;
    } else {
        panier.push({
            ...produit,
            quantite: quantite
        });
    }

    localStorage.setItem('panier', JSON.stringify(panier));

    // Réinitialiser la quantité
    document.getElementById(`quantite-temp-${produitId}`).value = 1;

    // Mettre à jour l'affichage
    chargerPanier();

    // Afficher une notification
    afficherNotification(`${quantite}x ${produit.nom} ajouté au panier`);
}

// Fonctions pour gérer le panier
function modifierQuantite(index, delta) {
    const panier = JSON.parse(localStorage.getItem('panier')) || [];
    if (panier[index]) {
        panier[index].quantite = Math.max(1, panier[index].quantite + delta);
        localStorage.setItem('panier', JSON.stringify(panier));
        chargerPanier();
    }
}

function updateQuantite(index, value) {
    const quantite = parseInt(value);
    if (quantite > 0) {
        const panier = JSON.parse(localStorage.getItem('panier')) || [];
        if (panier[index]) {
            panier[index].quantite = quantite;
            localStorage.setItem('panier', JSON.stringify(panier));
            chargerPanier();
        }
    }
}

function supprimerItem(index) {
    if (confirm('Voulez-vous vraiment supprimer cet article ?')) {
        const panier = JSON.parse(localStorage.getItem('panier')) || [];
        panier.splice(index, 1);
        localStorage.setItem('panier', JSON.stringify(panier));
        chargerPanier();
    }
}

// Fonction pour mettre à jour le compteur du panier
function mettreAJourCompteurPanier() {
    const panier = JSON.parse(localStorage.getItem('panier')) || [];
    const nombreArticles = panier.reduce((total, item) => total + item.quantite, 0);
    document.getElementById('panier-count').textContent = nombreArticles;
}

// Fonction pour afficher une notification
function afficherNotification(message) {
    const toast = document.createElement('div');
    toast.className = 'toast show';
    toast.innerHTML = `
        <div class="toast-header">
            <i class="fas fa-check-circle text-success me-2"></i>
            <strong class="me-auto">Panier mis à jour</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
    `;

    document.querySelector('.toast-container').appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Fonctions pour la validation de la commande
function validerCommande() {
    const panier = JSON.parse(localStorage.getItem('panier')) || [];
    if (panier.length === 0) {
        alert('Votre panier est vide !');
        return;
    }

    // Afficher le récapitulatif
    const recapCommande = document.getElementById('recap-commande');
    let sousTotal = 0;

    recapCommande.innerHTML = `
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                ${panier.map(item => {
        const total = item.prix * item.quantite;
        sousTotal += total;
        return `
                        <tr>
                            <td>${item.nom}</td>
                            <td>${item.quantite}</td>
                            <td>${item.prix.toFixed(2)} €</td>
                            <td>${total.toFixed(2)} €</td>
                        </tr>
                    `;
    }).join('')}
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                    <td><strong>${sousTotal.toFixed(2)} €</strong></td>
                </tr>
            </tfoot>
        </table>
    `;

    // Afficher la modal
    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    modal.show();
}

function confirmerCommande() {
    const panier = JSON.parse(localStorage.getItem('panier')) || [];

    // Créer la commande
    const commande = {
        numero: Math.floor(Math.random() * 90000) + 10000,
        date: new Date().toISOString(),
        articles: panier,
        total: document.getElementById('total').textContent
    };

    // Sauvegarder la commande dans l'historique
    const commandes = JSON.parse(localStorage.getItem('commandes')) || [];
    commandes.push(commande);
    localStorage.setItem('commandes', JSON.stringify(commandes));

    // Vider le panier
    localStorage.setItem('panier', '[]');

    // Rediriger vers la page des commandes
    window.location.href = 'commandes.html';
}

function annulerCommande() {
    if (confirm('Voulez-vous vraiment annuler votre commande ?')) {
        localStorage.setItem('panier', '[]');
        window.location.reload();
    }
}

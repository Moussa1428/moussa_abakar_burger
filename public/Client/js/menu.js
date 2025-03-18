// Base de données des produits (importée depuis panier.js)
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

// Au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    // Charger tous les produits par défaut
    afficherProduits('tous');

    // Ajouter l'écouteur pour le filtre de catégorie
    document.getElementById('categorie-filter').addEventListener('change', (e) => {
        afficherProduits(e.target.value);
    });

    // Charger le compteur du panier
    mettreAJourCompteurPanier();
});

// Fonction pour afficher les produits
function afficherProduits(categorie) {
    const menuGrid = document.getElementById('menu-grid');
    menuGrid.innerHTML = '';

    // Obtenir tous les produits
    let produitsAAfficher = [];
    if (categorie === 'tous') {
        Object.values(produits).forEach(categorieProduits => {
            produitsAAfficher = produitsAAfficher.concat(categorieProduits);
        });
    } else {
        produitsAAfficher = produits[categorie] || [];
    }

    // Créer les cartes de produits
    produitsAAfficher.forEach(produit => {
        const colDiv = document.createElement('div');
        colDiv.className = 'col-md-3'; // 4 produits par ligne
        colDiv.innerHTML = `
            <div class="card h-100">
                <img src="images/${produit.image}" class="card-img-top"
                     alt="${produit.nom}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">${produit.nom}</h5>
                    <p class="card-text">${produit.description}</p>
                    <p class="card-text"><strong>${produit.prix.toFixed(2)} €</strong></p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="input-group input-group-sm" style="width: 120px;">
                            <button class="btn btn-outline-secondary" type="button"
                                    onclick="ajusterQuantite(${produit.id}, -1)">-</button>
                            <input type="number" class="form-control text-center" id="quantite-${produit.id}"
                                   value="1" min="1">
                            <button class="btn btn-outline-secondary" type="button"
                                    onclick="ajusterQuantite(${produit.id}, 1)">+</button>
                        </div>
                        <button class="btn btn-primary btn-sm" onclick="ajouterAuPanier(${produit.id})">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        menuGrid.appendChild(colDiv);
    });
}

// Fonction pour ajuster la quantité
function ajusterQuantite(produitId, delta) {
    const input = document.getElementById(`quantite-${produitId}`);
    const newValue = Math.max(1, parseInt(input.value) + delta);
    input.value = newValue;
}

// Fonction pour ajouter au panier
function ajouterAuPanier(produitId) {
    const quantite = parseInt(document.getElementById(`quantite-${produitId}`).value);
    if (quantite < 1) return;

    // Trouver le produit
    let produitSelectionne = null;
    Object.values(produits).forEach(categorie => {
        const trouve = categorie.find(p => p.id === produitId);
        if (trouve) produitSelectionne = trouve;
    });

    if (!produitSelectionne) return;

    // Ajouter au panier
    const panier = JSON.parse(localStorage.getItem('panier')) || [];
    const produitExistant = panier.findIndex(item => item.id === produitId);

    if (produitExistant !== -1) {
        panier[produitExistant].quantite += quantite;
    } else {
        panier.push({
            ...produitSelectionne,
            quantite: quantite
        });
    }

    localStorage.setItem('panier', JSON.stringify(panier));

    // Réinitialiser la quantité
    document.getElementById(`quantite-${produitId}`).value = 1;

    // Mettre à jour le compteur
    mettreAJourCompteurPanier();

    // Afficher une notification
    afficherNotification(`${quantite}x ${produitSelectionne.nom} ajouté au panier`);
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

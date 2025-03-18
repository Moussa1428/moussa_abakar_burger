// Initialisation du slider Swiper
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser le slider About
    const aboutSwiper = new Swiper('.about-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    // Charger le panier depuis le localStorage
    chargerPanier();

    // Animation de la section À Propos
    const slides = document.querySelectorAll('.about-slide');
    let currentSlide = 0;

    function showSlide(index) {
        // Cacher toutes les slides
        slides.forEach(slide => {
            slide.classList.remove('active');
            slide.classList.remove('next');
        });

        // Calculer l'index de la prochaine slide
        const nextIndex = (index + 1) % slides.length;

        // Afficher la slide actuelle
        slides[index].classList.add('active');

        // Préparer la prochaine slide
        slides[nextIndex].classList.add('next');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    // Initialiser la première slide
    showSlide(0);

    // Démarrer l'animation automatique
    setInterval(nextSlide, 3000);
});

// Fonction pour ajouter un produit au panier
function ajouterAuPanier(productId) {
    let panier = JSON.parse(localStorage.getItem('panier')) || [];
    const produits = {
        'salade-med': {
            nom: 'Salade Méditerranéenne',
            prix: 15.90,
            image: 'images/plat-nouveau-1.jpg'
        },
        'burger-gourmet': {
            nom: 'Burger Gourmet',
            prix: 18.90,
            image: 'images/plat-nouveau-2.jpg'
        },
        'pizza-truffe': {
            nom: 'Pizza Truffe',
            prix: 22.90,
            image: 'images/plat-nouveau-3.jpg'
        },
        'dessert-exotique': {
            nom: 'Dessert Exotique',
            prix: 9.90,
            image: 'images/plat-nouveau-4.jpg'
        },
        'pates-carbonara': {
            nom: 'Pâtes Carbonara',
            prix: 16.90,
            image: 'images/plat-populaire-1.jpg'
        },
        'sushi-mix': {
            nom: 'Sushi Mix',
            prix: 24.90,
            image: 'images/plat-populaire-2.jpg'
        },
        'steak-grille': {
            nom: 'Steak Grillé',
            prix: 28.90,
            image: 'images/plat-populaire-3.jpg'
        },
        'tiramisu': {
            nom: 'Tiramisu',
            prix: 8.90,
            image: 'images/plat-populaire-4.jpg'
        }
    };

    const produit = produits[productId];
    if (!produit) return;

    // Vérifier si le produit existe déjà dans le panier
    const produitExistant = panier.find(item => item.id === productId);
    if (produitExistant) {
        produitExistant.quantite++;
    } else {
        panier.push({
            id: productId,
            nom: produit.nom,
            prix: produit.prix,
            image: produit.image,
            quantite: 1
        });
    }

    // Sauvegarder le panier
    localStorage.setItem('panier', JSON.stringify(panier));

    // Mettre à jour l'affichage du panier
    mettreAJourCompteurPanier();

    // Afficher une notification
    afficherNotification(`${produit.nom} ajouté au panier`);
}

// Fonction pour mettre à jour le compteur du panier
function mettreAJourCompteurPanier() {
    const panier = JSON.parse(localStorage.getItem('panier')) || [];
    const total = panier.reduce((sum, item) => sum + item.quantite, 0);
    document.getElementById('panier-count').textContent = total;
}

// Fonction pour afficher une notification
function afficherNotification(message) {
    // Créer l'élément de notification
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.innerHTML = `
        <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    // Ajouter la notification au document
    document.body.appendChild(notification);

    // Supprimer la notification après 3 secondes
    setTimeout(() => {
        notification.querySelector('.alert').classList.remove('show');
        setTimeout(() => notification.remove(), 150);
    }, 3000);
}

// Charger le panier au chargement de la page
function chargerPanier() {
    mettreAJourCompteurPanier();
}

// Animation au scroll
window.addEventListener('scroll', function() {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        const cardTop = card.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;
        if (cardTop < windowHeight * 0.75) {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }
    });
});

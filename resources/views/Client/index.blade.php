@extends('layouts.client.master')
@section('main')
    <!-- Hero Banner -->
    <section class="hero-section position-relative">
        <div class="hero-overlay"></div>
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center text-white">
                    <h1 class="display-4 fw-bold mb-4">Bienvenue chez Notre Restaurant</h1>
                    <p class="lead mb-4">Découvrez une expérience culinaire unique</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Nouveautés -->
    <section class="new-products py-5">
        <div class="container">
            <h2 class="text-center mb-5">Nos Nouveautés</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-badge position-absolute top-0 start-0 bg-danger text-white m-3 px-2 py-1 rounded">Nouveau</div>
                        <img src="images/plat-nouveau-1.jpg" class="card-img-top" alt="Nouveau plat 1">
                        <div class="card-body">
                            <h5 class="card-title">Salade Méditerranéenne</h5>
                            <p class="card-text">Une salade fraîche aux saveurs méditerranéennes</p>
                            <p class="card-price">15.90 €</p>
                            <button class="btn btn-primary w-100" onclick="ajouterAuPanier('salade-med')">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-badge position-absolute top-0 start-0 bg-danger text-white m-3 px-2 py-1 rounded">Nouveau</div>
                        <img src="images/plat-nouveau-2.jpg" class="card-img-top" alt="Nouveau plat 2">
                        <div class="card-body">
                            <h5 class="card-title">Burger Gourmet</h5>
                            <p class="card-text">Un burger premium avec des ingrédients de qualité</p>
                            <p class="card-price">18.90 €</p>
                            <button class="btn btn-primary w-100" onclick="ajouterAuPanier('burger-gourmet')">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-badge position-absolute top-0 start-0 bg-danger text-white m-3 px-2 py-1 rounded">Nouveau</div>
                        <img src="images/plat-nouveau-3.jpg" class="card-img-top" alt="Nouveau plat 3">
                        <div class="card-body">
                            <h5 class="card-title">Pizza Truffe</h5>
                            <p class="card-text">Une pizza raffinée à la truffe noire</p>
                            <p class="card-price">22.90 €</p>
                            <button class="btn btn-primary w-100" onclick="ajouterAuPanier('pizza-truffe')">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-badge position-absolute top-0 start-0 bg-danger text-white m-3 px-2 py-1 rounded">Nouveau</div>
                        <img src="images/plat-nouveau-4.jpg" class="card-img-top" alt="Nouveau plat 4">
                        <div class="card-body">
                            <h5 class="card-title">Dessert Exotique</h5>
                            <p class="card-text">Un dessert aux fruits exotiques et chocolat</p>
                            <p class="card-price">9.90 €</p>
                            <button class="btn btn-primary w-100" onclick="ajouterAuPanier('dessert-exotique')">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Produits Populaires -->
    <section class="popular-products py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Nos Produits Populaires</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="images/plat-populaire-1.jpg" class="card-img-top" alt="Plat populaire 1">
                        <div class="card-body">
                            <h5 class="card-title">Pâtes Carbonara</h5>
                            <p class="card-text">Pâtes fraîches à la carbonara traditionnelle</p>
                            <p class="card-price">16.90 €</p>
                            <button class="btn btn-primary w-100" onclick="ajouterAuPanier('pates-carbonara')">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="images/plat-populaire-2.jpg" class="card-img-top" alt="Plat populaire 2">
                        <div class="card-body">
                            <h5 class="card-title">Sushi Mix</h5>
                            <p class="card-text">Assortiment de sushis frais</p>
                            <p class="card-price">24.90 €</p>
                            <button class="btn btn-primary w-100" onclick="ajouterAuPanier('sushi-mix')">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="images/plat-populaire-3.jpg" class="card-img-top" alt="Plat populaire 3">
                        <div class="card-body">
                            <h5 class="card-title">Steak Grillé</h5>
                            <p class="card-text">Steak de bœuf grillé et ses légumes</p>
                            <p class="card-price">28.90 €</p>
                            <button class="btn btn-primary w-100" onclick="ajouterAuPanier('steak-grille')">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <img src="images/plat-populaire-4.jpg" class="card-img-top" alt="Plat populaire 4">
                        <div class="card-body">
                            <h5 class="card-title">Tiramisu</h5>
                            <p class="card-text">Tiramisu traditionnel italien</p>
                            <p class="card-price">8.90 €</p>
                            <button class="btn btn-primary w-100" onclick="ajouterAuPanier('tiramisu')">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="menu.html" class="btn btn-lg btn-primary">
                    <i class="fas fa-book-open me-2"></i>Voir notre menu complet
                </a>
            </div>
        </div>
    </section>
    <!-- About Section avec Slider -->
    <section class="about-section">
        <div class="container">
            <h2 class="text-center mb-5">À Propos de Nous</h2>
            <div class="about-slider">
                <div class="about-slide active">
                    <div class="row">
                        <div class="col-md-6 image-container">
                            <img src="images/restaurant-1.jpg" alt="Notre Restaurant">
                        </div>
                        <div class="col-md-6">
                            <div class="about-content">
                                <h4>Notre Restaurant</h4>
                                <p>Un cadre chaleureux et moderne pour votre confort. Nous vous accueillons dans une ambiance conviviale et raffinée, parfaite pour tous vos moments de dégustation. Notre espace a été conçu pour vous offrir une expérience unique, mêlant confort et élégance.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-slide">
                    <div class="row">
                        <div class="col-md-6 image-container">
                            <img src="images/cuisine-2.jpg" alt="Notre Cuisine">
                        </div>
                        <div class="col-md-6">
                            <div class="about-content">
                                <h4>Notre Cuisine</h4>
                                <p>Une cuisine ouverte et professionnelle où nos chefs passionnés préparent des plats d'exception. Chaque plat est élaboré avec des ingrédients frais et de saison, sélectionnés avec soin pour vous garantir une qualité optimale.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-slide">
                    <div class="row">
                        <div class="col-md-6 image-container">
                            <img src="images/equipe-3.jpg" alt="Notre Équipe">
                        </div>
                        <div class="col-md-6">
                            <div class="about-content">
                                <h4>Notre Équipe</h4>
                                <p>Une équipe passionnée et professionnelle, dédiée à vous offrir une expérience gastronomique inoubliable. Notre personnel qualifié met tout son savoir-faire et son enthousiasme à votre service pour faire de chaque visite un moment d'exception.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
@endsection

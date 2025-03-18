@extends('layouts.client.master')
@section('main')
    <!-- En-tête du menu -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Notre Menu</h1>

        <!-- Section des produits -->
        <section class="menu-section py-5">
            <div class="container">
                <!-- Navigation des catégories -->
                <ul class="nav nav-pills mb-4 justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tous">Tous</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#entrees">Entrées</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#plats">Plats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pizzas">Pizzas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#desserts">Desserts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#boissons">Boissons</a>
                    </li>
                </ul>

                <!-- Grille des produits -->
                <div class="row">
                    <!-- Exemple de carte produit -->
                    <div class="col-md-3">
                        <div class="card">
                            <img src="images/products/product1.jpg" class="card-img-top" alt="Nom du produit">
                            <div class="card-body">
                                <h5 class="card-title">Nom du produit</h5>
                                <p class="card-text">Description courte du produit qui peut tenir sur deux lignes maximum.</p>
                                <div class="card-price">12.99 €</div>
                                <button class="btn btn-primary">Ajouter au panier</button>
                            </div>
                        </div>
                    </div>
                    <!-- Répéter pour d'autres produits -->
                </div>
            </div>
        </section>

        <!-- Section Entrées -->
        <section id="entrees" class="menu-section mb-5">
            <h2 class="text-center mb-4">Entrées</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/salade-cesar.jpg" class="card-img-top" alt="Salade César">
                        <div class="card-body">
                            <h5 class="card-title">Salade César</h5>
                            <p class="card-text">Laitue, poulet grillé, parmesan, croûtons</p>
                            <div class="card-price">8.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(1)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/soupe-oignon.jpg" class="card-img-top" alt="Soupe à l'oignon">
                        <div class="card-body">
                            <h5 class="card-title">Soupe à l'oignon</h5>
                            <p class="card-text">Oignons caramélisés, croûtons, fromage gratiné</p>
                            <div class="card-price">7.50 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(2)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/carpaccio.jpg" class="card-img-top" alt="Carpaccio de bœuf">
                        <div class="card-body">
                            <h5 class="card-title">Carpaccio de bœuf</h5>
                            <p class="card-text">Fines tranches de bœuf, parmesan, roquette</p>
                            <div class="card-price">11.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(3)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Plats -->
        <section id="plats" class="menu-section mb-5">
            <h2 class="text-center mb-4">Plats Principaux</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/steak-frites.jpg" class="card-img-top" alt="Steak Frites">
                        <div class="card-body">
                            <h5 class="card-title">Steak Frites</h5>
                            <p class="card-text">Steak de bœuf, frites maison, sauce au choix</p>
                            <div class="card-price">18.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(4)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/poulet-roti.jpg" class="card-img-top" alt="Poulet Rôti">
                        <div class="card-body">
                            <h5 class="card-title">Poulet Rôti</h5>
                            <p class="card-text">Poulet fermier, légumes de saison</p>
                            <div class="card-price">16.50 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(5)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/saumon-grille.jpg" class="card-img-top" alt="Saumon Grillé">
                        <div class="card-body">
                            <h5 class="card-title">Saumon Grillé</h5>
                            <p class="card-text">Saumon frais, riz basmati, sauce citronnée</p>
                            <div class="card-price">19.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(6)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Pizzas -->
        <section id="pizzas" class="menu-section mb-5">
            <h2 class="text-center mb-4">Pizzas</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/pizza-margherita.jpg" class="card-img-top" alt="Pizza Margherita">
                        <div class="card-body">
                            <h5 class="card-title">Margherita</h5>
                            <p class="card-text">Sauce tomate, mozzarella, basilic frais</p>
                            <div class="card-price">12.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(7)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/pizza-4-fromages.jpg" class="card-img-top" alt="Pizza 4 Fromages">
                        <div class="card-body">
                            <h5 class="card-title">Quatre Fromages</h5>
                            <p class="card-text">Mozzarella, gorgonzola, chèvre, parmesan</p>
                            <div class="card-price">14.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(8)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/pizza-pepperoni.jpg" class="card-img-top" alt="Pizza Pepperoni">
                        <div class="card-body">
                            <h5 class="card-title">Pepperoni</h5>
                            <p class="card-text">Sauce tomate, mozzarella, pepperoni</p>
                            <div class="card-price">13.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(9)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Desserts -->
        <section id="desserts" class="menu-section mb-5">
            <h2 class="text-center mb-4">Desserts</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/tiramisu.jpg" class="card-img-top" alt="Tiramisu">
                        <div class="card-body">
                            <h5 class="card-title">Tiramisu</h5>
                            <p class="card-text">Mascarpone, café, cacao</p>
                            <div class="card-price">6.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(10)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/creme-brulee.jpg" class="card-img-top" alt="Crème Brûlée">
                        <div class="card-body">
                            <h5 class="card-title">Crème Brûlée</h5>
                            <p class="card-text">Crème vanillée, caramel croustillant</p>
                            <div class="card-price">6.50 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(11)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/fondant-chocolat.jpg" class="card-img-top" alt="Fondant au Chocolat">
                        <div class="card-body">
                            <h5 class="card-title">Fondant au Chocolat</h5>
                            <p class="card-text">Chocolat noir, cœur coulant</p>
                            <div class="card-price">7.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(12)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Boissons -->
        <section id="boissons" class="menu-section mb-5">
            <h2 class="text-center mb-4">Boissons</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/coca.jpg" class="card-img-top" alt="Coca-Cola">
                        <div class="card-body">
                            <h5 class="card-title">Coca-Cola</h5>
                            <p class="card-text">33cl</p>
                            <div class="card-price">3.50 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(13)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/vin-rouge.jpg" class="card-img-top" alt="Vin Rouge">
                        <div class="card-body">
                            <h5 class="card-title">Vin Rouge</h5>
                            <p class="card-text">Verre 15cl</p>
                            <div class="card-price">4.90 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(14)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="images/eau.jpg" class="card-img-top" alt="Eau Minérale">
                        <div class="card-body">
                            <h5 class="card-title">Eau Minérale</h5>
                            <p class="card-text">50cl</p>
                            <div class="card-price">2.50 €</div>
                            <button class="btn btn-primary" onclick="ajouterAuPanier(15)">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('Client/js/menu.js') }}"></script>
@endsection

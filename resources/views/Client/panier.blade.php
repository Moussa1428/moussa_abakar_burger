@extends('layouts.client.master')
@section('main')
    <div class="container my-5">
        <h1 class="mb-4">Mon Panier</h1>

        <!-- Tableau du panier -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Articles sélectionnés</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>Produit</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="panier-items">
                        <!-- Les articles du panier seront ajoutés ici -->
                        </tbody>
                        <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end"><strong>Sous-total</strong></td>
                            <td><strong id="sous-total">0.00 €</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end">Frais de livraison</td>
                            <td id="frais-livraison">2.50 €</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                            <td><strong id="total" class="text-primary">0.00 €</strong></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Section pour ajouter d'autres produits -->
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Ajouter d'autres produits</h5>
                <div class="d-flex gap-2">
                    <select class="form-select" id="categorie-filter" style="width: auto;">
                        <option value="tous">Toutes les catégories</option>
                        <option value="entrees">Entrées</option>
                        <option value="plats">Plats principaux</option>
                        <option value="pizzas">Pizzas</option>
                        <option value="desserts">Desserts</option>
                        <option value="boissons">Boissons</option>
                    </select>
                    <input type="text" class="form-control" id="recherche-produit"
                           placeholder="Rechercher un produit..." style="width: 200px;">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="produits-disponibles">
                        <!-- Les produits disponibles seront ajoutés ici -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="d-flex justify-content-between mt-4">
            <a href="menu.html" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Continuer les achats
            </a>
            <button class="btn btn-primary" onclick="validerCommande()">
                <i class="fas fa-check me-2"></i>Valider la commande
            </button>
        </div>
    </div>

    <!-- Modal de confirmation -->
    <div class="modal fade" id="confirmationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="recap-commande"></div>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Vérifiez votre commande avant de confirmer.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Modifier</button>
                    <button type="button" class="btn btn-danger" onclick="annulerCommande()">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="confirmerCommande()">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast pour les notifications -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <script src="{{ asset('Client/js/panier.js') }}"></script>
@endsection

@extends('layouts.client.master')
@section('main')
    <div class="container py-5">
        <h2 class="mb-4">Mes Commandes</h2>

        <!-- Filtres -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Statut</label>
                        <select class="form-select" id="filterStatus">
                            <option value="">Tous</option>
                            <option value="en_cours">En cours</option>
                            <option value="livree">Livrée</option>
                            <option value="annulee">Annulée</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date</label>
                        <select class="form-select" id="filterDate">
                            <option value="">Toutes les dates</option>
                            <option value="today">Aujourd'hui</option>
                            <option value="week">Cette semaine</option>
                            <option value="month">Ce mois</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Trier par</label>
                        <select class="form-select" id="sortBy">
                            <option value="date_desc">Date (plus récent)</option>
                            <option value="date_asc">Date (plus ancien)</option>
                            <option value="total_desc">Montant (décroissant)</option>
                            <option value="total_asc">Montant (croissant)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des commandes -->
        <div id="commandesList">
            <!-- Exemple de commande -->
            <div class="card shadow mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Commande #12345</h5>
                        <small class="text-muted">Passée le 15 mars 2024</small>
                    </div>
                    <span class="badge bg-success">Livrée</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Articles</h6>
                            <ul class="list-unstyled">
                                <li>1x Burger Gourmet - 15.90 €</li>
                                <li>2x Tiramisu - 13.80 €</li>
                            </ul>
                        </div>
                        <div class="col-md-4 text-end">
                            <h6>Total</h6>
                            <p class="h4 text-primary">29.70 €</p>
                            <button class="btn btn-outline-primary btn-sm mt-2" onclick="showFacture(12345)">
                                <i class="fas fa-file-invoice me-1"></i>Voir la facture
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exemple de commande en cours -->
            <div class="card shadow mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Commande #12346</h5>
                        <small class="text-muted">Passée le 18 mars 2024</small>
                    </div>
                    <span class="badge bg-warning text-dark">En cours</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Articles</h6>
                            <ul class="list-unstyled">
                                <li>1x Salade César - 8.50 €</li>
                                <li>1x Pâtes aux Fruits de Mer - 17.50 €</li>
                            </ul>
                            <div class="mt-3">
                                <h6>Suivi de commande</h6>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         role="progressbar"
                                         style="width: 75%"
                                         aria-valuenow="75"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">En cours de livraison</small>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <h6>Total</h6>
                            <p class="h4 text-primary">26.00 €</p>
                            <button class="btn btn-outline-danger btn-sm mt-2" onclick="annulerCommande(12346)">
                                <i class="fas fa-times me-1"></i>Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Navigation des commandes" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Précédent</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Modal Facture -->
    <div class="modal fade" id="factureModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Facture #<span id="factureNumero"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="factureContent">
                    <!-- Le contenu de la facture sera chargé dynamiquement -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="imprimerFacture()">
                        <i class="fas fa-print me-1"></i>Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('Client/js/commandes.js') }}"></script>
@endsection
